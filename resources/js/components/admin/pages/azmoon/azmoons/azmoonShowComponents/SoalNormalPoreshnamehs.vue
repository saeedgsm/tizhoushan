<template>
  <div
    class="modal fade normal-poreshnameh-soal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="normal-poreshnameh-soal"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mt-0" id="normal-poreshnameh-soal">
            پاسخنامه
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
            </div>
          </div>

          <button class="btn btn-success" @click="storeSoal()">
            ثبت اطلاعات
          </button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</template>

<script>
import Vue from "vue";
//Vue.component()
export default {
  props: ["azmoonId", "soalCount"],

  data() {
    return {
      soal: {},

      poreshnameh: new Map(),
      soal_loop_count: [],
      soal_radio_count: [],
      radio_checked: new Map(),
      count:0
    };
  },

  methods: {
    fetchSoalPoresh() {
      Vue.http
        .get("api/admin/soal-normal-poreshnameh/" + this.azmoonId)
        .then((response) => {
          this.soal = response.body.soal;
          let correct_key = response.body.soals.correct_key;
          let ss = correct_key.split(",");
          ss.map((item) => {
            let fd = item.split(":");
            this.poreshnameh.set(fd[0],fd[1]);
          })
         // console.log(this.poreshnameh.get('5'));
          // this.poreshnameh = response.body.soals;
          // console.log(response.body.soals);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    matchValue(a, b) {
      return a + "_" + b;
    },

    checkedSoal(a, b) {
      this.radio_checked.set(a, b);
    },

    storeSoal() {
      let str = "";
      let loop = 0;
      for (let [key, value] of this.radio_checked) {
        ++loop;
        if (loop == this.soalCount) {
          str += key + ":" + value;
        } else {
          str += key + ":" + value + ",";
        }
      }
      const form = {
        azmoon_id: this.azmoonId,
        correct_key: str,
        number_of_question: this.soalCount,
      };
      Vue.http
        .post("api/admin/normal-porseshnameh-store", form)
        .then((response) => {
          Toast.fire({
            icon: response.body.code,
            title: response.body.message,
            showConfirmButton: true,
          });
          console.log(response.body.error_info);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    check_correct_key() {
   //     console.log(this.poreshnameh);


     /*    let s_ = soal_number.toString()
      console.log(this.poreshnameh.get('3'));
      if (soal_number == 1) {
            if (radio == 2) {

                return true;

            }else {
                return false
            }
 */
          //console.log('checked');
      //  }
       // console.log( this.count);
      /* this.poreshnameh.map((item) => {
        //console.log(item[0]==soal_number);
        if (soal_number == item[0]) {
            if (radio == item[1]) {
                 console.log('true');
                return true;

            }else {
                return false
            }

          //console.log('checked');
        }
      }); */
    },
  },

  computed: {
    soalCountf() {
      for (let index = 1; index <= this.soalCount; index++) {
        this.soal_loop_count.push(index);
      }
    },
  },

  created() {
    this.fetchSoalPoresh();
    for (let index = 1; index <= 4; index++) {
      this.soal_radio_count.push(index);
    }
    //   console.log(this.poreshnameh);
  },

  updated() {
      this.check_correct_key();
  },
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
