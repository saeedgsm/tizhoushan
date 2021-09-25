<template>
  <div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-4">
            <h4 class="page-title mb-1">آزمون</h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active">فرم ویرایش آزمون</li>
            </ol>
          </div>
          <div class="col-md-8">
            <div class="float-right">
              <router-link
                :to="{
                  name: 'AzmoonShow',
                  params: { id: this.$route.params.id },
                }"
                class="btn btn-light btn-rounded btn-sm"
              >
                <i class="dripicons-arrow-left mr-1"></i>
                <strong>برگشت</strong>
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h4 class="header-title">فرم ویرایش آزمون</h4>

                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row justify-content-center">
                    <div class="row col-lg-12 p-5">
                      <div class="col-lg-2 mb-3">
                        <h5 class="font-size-14">نوع آزمون</h5>
                        <div
                          class="
                            custom-control custom-radio custom-control-inline
                          "
                        >
                          <input
                            type="radio"
                            id="azmoon_type2"
                            name="azmoon_type"
                            value="normal"
                            autocomplete="off"
                            class="custom-control-input"
                            autofocus
                            v-model="azmoonData.azmoon_type"
                          />
                          <label class="custom-control-label" for="azmoon_type2"
                            >عادی</label
                          >
                        </div>
                        <div
                          class="
                            custom-control custom-radio custom-control-inline
                          "
                        >
                          <input
                            type="radio"
                            id="azmoon_type3"
                            name="azmoon_type"
                            value="advanced"
                            class="custom-control-input"
                            v-model="azmoonData.azmoon_type"
                          />
                          <label class="custom-control-label" for="azmoon_type3"
                            >پیشرفته</label
                          >
                        </div>
                      </div>
                      <div class="col-lg-2 mb-3">
                        <h5 class="font-size-14">نوع سوال</h5>
                        <div
                          class="
                            custom-control custom-radio custom-control-inline
                          "
                        >
                          <input
                            type="radio"
                            id="type2"
                            name="type"
                            value="porseshnameh"
                            class="custom-control-input"
                            v-model="soal.soal_type"
                          />
                          <label class="custom-control-label" for="type2"
                            >پرسش نامه
                          </label>
                        </div>
                        <div
                          class="
                            custom-control custom-radio custom-control-inline
                          "
                        >
                          <input
                            type="radio"
                            id="type3"
                            name="type"
                            value="soal_b_soal"
                            class="custom-control-input"
                            v-model="soal.soal_type"
                          />
                          <label class="custom-control-label" for="type3"
                            >سوال به سوال</label
                          >
                        </div>
                      </div>
                      <div class="col-lg-3 mb-3">
                        <div>
                          <h5 class="font-size-14 mb-3">
                            همگام سازی زمان آزمون
                          </h5>
                          <div class="form-check mb-2">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              name="azmoon_sync"
                              value="1"
                              id="azmoon_sync"
                              v-model="azmoonData.azmoon_sync"
                            />
                            <label class="form-check-label" for="azmoon_sync">
                              ثبت تاخیر دانش آموز
                            </label>
                          </div>
                        </div>
                      </div>
                      <div
                        class="col-lg-3 mb-3"
                        v-show="azmoonData.azmoon_sync"
                      >
                        <label for="azmoon_sync_time"
                          >مدت زمان تاخیر به دقیقه</label
                        >
                        <input
                          type="text"
                          class="form-control"
                          autocomplete="off"
                          name="azmoon_sync_time"
                          value=""
                          id="azmoon_sync_time"
                          placeholder="مدت زمان تاخیر را وارد کنید"
                          v-model="azmoonData.azmoon_sync_time"
                        />
                      </div>
                    </div>

                    <div class="row col-lg-12 p-3">
                      <div class="col-lg-3 mb-3">
                        <label for="azmoon_title">نام آزمون</label>
                        <input
                          type="text"
                          class="form-control"
                          name="azmoon_title"
                          autocomplete="off"
                          id="azmoon_title"
                          placeholder="نام آزمون را وارد کنید"
                          v-model="azmoonData.azmoon_title"
                        />
                      </div>
                      <div class="col-lg-3 mb-3">
                        <label for="azmoon_code">کد آزمون</label>
                        <input
                          type="text"
                          title="در صورت خالی بودن کد به صورت رندم ایجاد می شود!"
                          class="form-control"
                          name="azmoon_code"
                          autocomplete="off"
                          value=""
                          id="azmoon_code"
                          placeholder="کد آزمون را وارد کنید"
                          v-model="azmoonData.azmoon_code"
                        />
                      </div>

                      <div class="col-lg-3 mb-3">
                        <h5 class="font-size-14">نوع هزینه</h5>
                        <div
                          class="
                            custom-control custom-radio custom-control-inline
                          "
                        >
                          <input
                            type="radio"
                            id="type_payment1"
                            name="type_payment"
                            value="free"
                            class="custom-control-input"
                            v-model="azmoonData.type_payment"
                          />
                          <label
                            class="custom-control-label"
                            for="type_payment1"
                            >رایگان</label
                          >
                        </div>
                        <div
                          class="
                            custom-control custom-radio custom-control-inline
                          "
                        >
                          <input
                            type="radio"
                            id="type_payment2"
                            name="type_payment"
                            value="cash"
                            class="custom-control-input"
                            v-model="azmoonData.type_payment"
                          />
                          <label
                            class="custom-control-label"
                            for="type_payment2"
                            >پولی</label
                          >
                        </div>
                      </div>
                      <div
                        class="col-lg-3 mb-3"
                        v-show="azmoonData.type_payment === 'cash'"
                      >
                        <label for="price">هزینه آزمون تومان</label>
                        <input
                          type="text"
                          title="هزینه آزمون به تومان وارد کنید!"
                          class="form-control"
                          name="price"
                          autocomplete="off"
                          id="price"
                          placeholder="هزینه آزمون را وارد کنید"
                          v-model="azmoonData.price"
                        />
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="row p-5">
                        <div class="col-lg-4 mb-3">
                          <label for="soal_count">تعداد سوال</label>
                          <input
                            type="text"
                            autocomplete="off"
                            class="form-control"
                            name="soal_count"
                            id="soal_count"
                            placeholder="تعداد سوال را وارد کنید"
                            v-model="soal.soal_count"
                          />
                        </div>
                        <div class="col-lg-4 mb-3">
                          <label for="answer_type">نوع نمایش گزینه ها</label>
                          <select
                            autofocus
                            class="form-control"
                            name="answer_type"
                            id="answer_type"
                            v-model="soal.answer_type"
                          >
                            <option selected disabled>لطفا انتخاب کنید!</option>
                            <option value="numeric">عددی</option>
                            <option value="alphabet">حروف الفبا</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 mt-4">
                    <button
                      type="submit"
                      @click.prevent="azmoonUpdate(azmoonData.id)"
                      class="btn btn-primary waves-effect waves-light"
                    >
                      ثبت اطلاعات
                    </button>
                  </div>
                </form>
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
  name: "AzmoonEdit",
  data() {
    return {
      azmoonData: {
        azmoon_type: "normal",
        type: "porseshnameh",
        type_payment: "free",
        soal_count: 5,
        azmoon_time: 1,
      },
      soal: {
        soal_type: "",
        soal_count: "",
        answer_type: "",
      },
    };
  },

  methods: {
    fetchAzmoon(azmoonId) {
      Vue.http
        .get("api/admin/azmoon-edit/" + azmoonId)
        .then((response) => {
          this.azmoonData = response.body.azmoon;
          this.soal = response.body.soal;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    azmoonUpdate(azmoonId) {
      console.log(this.azmoonData, this.soal);
      const form = {
        azmoon: this.azmoonData,
        soal: this.soal,
      };
      Vue.http
        .post("api/admin/azmoon-update", form)
        .then((response) => {
          Toast.fire({
            icon: "success",
            title: "اطلاعات با موفقیت آپدیت شد!",
          });
          this.$router.push({
            name: "AzmoonShow",
            params: { id: azmoonId },
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  created() {
    this.fetchAzmoon(this.$route.params.id);
  },
};
</script>
