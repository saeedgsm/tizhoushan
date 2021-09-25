<template>
  <div>
    <div
      class="modal fade edit-student-result"
      tabindex="-1"
      role="dialog"
      aria-labelledby="edit-student-result-selected"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title mt-0" id="edit-student-result-selected">
              فرم ویرایش نتایج آزمون دانش آموز
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="">
              <span>نتایج: </span>
              <strong>{{ res.result === null ? 'خالی' : azmoonInfo.result.result }}</strong>
            </div>
            <div class="row justify-content-center">
              {{ soalCountf }}
              <div class="p-4" dir="ltr">
                <div class="">
                  <div class="form-group">
                    <label for="" class="col-number" style="float: left"
                      >سوال</label
                    >
                    <label for=""> گزینه </label>
                  </div>
                </div>
                <div v-for="soal_number in soal_loop_count" :key="soal_number">
                  <div class="form-group">
                    <label for="" class="col-number">{{ soal_number }}</label>
                    <input
                      type="radio"
                      :name="soal_number"
                      :value="matchValue(soal_number, radio)"
                      class="radio-th"
                      v-for="radio in soal_radio_count"
                      :key="radio"
                      @click="checkedSoal(soal_number, radio)"
                    />
                  </div>
                </div>
                <button class="btn btn-success" @click="updateAnswers()">
                  ثبت اطلاعات
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    azmoonInfo: {

    },
  },

  data() {
    return {
      result: {},
      soal: {},
      soal_loop_count: [],
      soal_radio_count: [],
      radio_checked: new Map(),
      res : this.azmoonInfo
    };
  },

  methods: {
    matchValue(a, b) {
      return a + "_" + b;
    },

    checkedSoal(a, b) {
      this.radio_checked.set(a, b);
    },

    updateAnswers() {
      let str = "";
      let loop = 0;
      const sorted = new Map([...this.radio_checked.entries()].sort());
      for (let [key, value] of sorted) {
        loop++;
        if (loop === this.radio_checked.size) {
          str += key + ":" + value;
        } else {
          str += key + ":" + value + ",";
        }
      }
      const form = {
        user_id: this.azmoonInfo.result.actions,
        azmoon_id: this.azmoonInfo.azmoon_id,
        result: str,
      };
      Vue.http
        .post("api/admin/azmoon/update-student-result", form)
        .then((response) => {
            const process = {
                'azmoon_start':response.body.result.azmoon_start,
                'percent':response.body.result.percent,
                'correct':response.body.result.correct_count,
                'incorrect':response.body.result.wrong_count,
                'not_answer':response.body.result.not_answer_count,
                'azmoon_status':'تموم شده',
                'index':this.azmoonInfo.index
            }
            this.$emit("updateStudentResult",process);
          Swal.fire({
            title: response.body.title,
            text: response.body.text,
            icon: response.body.icon,
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  computed: {
    soalCountf() {
      for (let index = 1; index <= this.azmoonInfo.soalCount; index++) {
        this.soal_loop_count.push(index);
      }
    },

    showResult() {
      const res = this.azmoonInfo;
      if (res.result === null) {
        this.result = "نزده";
      } else {
        this.result = res.result.result;
      }
    },
  },

  created() {
    for (let index = 1; index <= 4; index++) {
      this.soal_radio_count.push(index);
    }
  },

  beforeUpdate() {
    this.showResult;
  },

  updated() {},
};
</script>

<style scoped>
.radio-th {
  margin: 10px;
}

.col-number {
  width: 40px;
  border: 1px solid;
  border-radius: 5px;
  padding: 5px;
  text-align: center;
}
</style>
