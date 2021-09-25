<template>
  <div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-4">
            <h4 class="page-title mb-1">آزمون</h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active">فرم افزودن آزمون جدید</li>
            </ol>
          </div>
          <div class="col-md-8">
            <div class="float-right">
              <router-link
                :to="{
                  name: 'Azmoons',
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
                <h4 class="header-title">فرم افزودن آزمون</h4>

                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row justify-content-center">
                    <div class="col-lg-8 p-2">
                      <div
                        class="alert alert-info alert-dismissible fade show"
                        role="alert"
                      >
                        <button
                          type="button"
                          class="close"
                          data-dismiss="alert"
                          aria-label="Close"
                        >
                          <span aria-hidden="true">×</span>
                        </button>
                        <strong> توجه! </strong>کد آزمون در صورت خالی وارد کردن
                        به صورت رندوم ایجاد خواهد شد!
                        <hr />
                        <strong> توجه! </strong>لطفا در انتخاب کردن کتاب نسبت به
                        نوع آزمون دقت کنید!
                      </div>
                    </div>

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
                        <h5 class="font-size-14">جهت استفاده</h5>
                        <div
                          class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            id="azmoon_for1"
                            name="azmoon_for"
                            value="exam"
                            autocomplete="off"
                            class="custom-control-input"
                            v-model="azmoonData.azmoon_for"
                          />
                          <label class="custom-control-label" for="azmoon_for1">امتحان</label>
                        </div>
                        <div
                          class="custom-control custom-radio custom-control-inline">
                          <input
                            type="radio"
                            id="azmoon_for2"
                            name="azmoon_for"
                            value="survey"
                            class="custom-control-input"
                            v-model="azmoonData.azmoon_for"
                          />
                          <label class="custom-control-label" for="azmoon_for2"
                            >نظرسنجی</label
                          >
                        </div>
                      </div>
                      <div class="col-lg-2 mb-3">
                        <h5 class="font-size-14">کلاس بندی</h5>
                        <div
                          class="
                            custom-control custom-radio custom-control-inline
                          "
                        >
                          <input
                            type="radio"
                            id="class_type2"
                            name="class_type"
                            value="all"
                            autocomplete="off"
                            class="custom-control-input"
                            v-model="azmoonData.class_type"
                          />
                          <label class="custom-control-label" for="class_type2"
                            >همه کلاس ها</label
                          >
                        </div>
                        <div
                          class="
                            custom-control custom-radio custom-control-inline
                          "
                        >
                          <input
                            type="radio"
                            id="class_type3"
                            name="class_type"
                            value="elective"
                            class="custom-control-input"
                            v-model="azmoonData.class_type"
                          />
                          <label class="custom-control-label" for="class_type3"
                            >کلاس انتخابی</label
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
                            v-model="azmoonData.type"
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
                            v-model="azmoonData.type"
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

                    <div class="row col-md-12">
                      <div
                        class="col-lg-3 mb-3"
                        v-show="azmoonData.azmoon_type === 'normal'"
                      >
                        <div class="form-group">
                          <label for="book">کتاب </label>
                          <select
                            class="form-control"
                            name="book_id"
                            id="book"
                            v-model="azmoonData.book_id"
                          >
                            <option :selected="true">لطفا انتخاب کنید!</option>
                            <option
                              v-for="book in books"
                              :key="book.id"
                              :value="book.id"
                            >
                              {{ book.book_name }}
                            </option>
                          </select>
                        </div>
                      </div>

                      <div
                        class="col-lg-4 mb-3"
                        v-show="azmoonData.azmoon_type === 'advanced'"
                      >
                        <label class="typo__label">کتاب ها</label>
                        <multiselect
                          dir="rtl"
                          v-model="azmoonData.book_id"
                          :options="books"
                          :multiple="true"
                          :close-on-select="false"
                          :clear-on-select="false"
                          :preserve-search="true"
                          noOptions="false"
                          selectLabel="لطفا کتاب را انتخاب کنید!"
                          selectedLabel="انتخاب شده"
                          deselectLabel="از منتخب حذف کن"
                          placeholder="لطفا انتخاب کنید"
                          label="book_name"
                          track-by="book_name"
                          :preselect-first="true"
                        >
                          <template
                            slot="selection"
                            slot-scope="{ values, isOpen }"
                          >
                            <span
                              class="multiselect__single text-right"
                              style="text-align: right !important"
                              v-if="values.length &amp;&amp; !isOpen"
                              >{{ values.length }} کتاب انتخاب شده:</span
                            >
                          </template>
                        </multiselect>
                      </div>

                      <div
                        class="row col-md-8"
                        v-show="azmoonData.class_type === 'elective'"
                      >
                        <div class="form-group col-md-6">
                          <label>پایه آموزشی</label>
                          <select
                            name="base_id"
                            class="form-control"
                            v-model="base_id"
                          >
                            <option value="" disabled>لطفا انتخاب کنید!</option>
                            <option
                              v-for="base in bases"
                              :key="base.id"
                              :value="base.id"
                            >
                              {{ base.base_title }}
                            </option>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="typo__label">لیست کلاس ها</label>
                          <multiselect
                            dir="rtl"
                            v-model="azmoonData.class_id"
                            :options="classes"
                            :multiple="true"
                            :close-on-select="false"
                            :clear-on-select="false"
                            :preserve-search="true"
                            noOptions="false"
                            placeholder="لطفا انتخاب کنید"
                            label="class_title"
                            track-by="class_title"
                            :preselect-first="true"
                          >
                            <template
                              slot="selection"
                              slot-scope="{ values, search, isOpen }"
                            >
                              <span
                                class="multiselect__single text-right"
                                style="text-align: right !important"
                                v-if="values.length &amp;&amp; !isOpen"
                                >{{ values.length }} کلاس های انتخاب شده:</span
                              >
                            </template>
                          </multiselect>
                        </div>
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
                          value=""
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

                    <div class="col-lg-12 p-5">
                      <div class="row">
                        <div class="col-lg-4 mb-3">
                          <label for="azmoon_time">تاریخ شروع آزمون </label>
                          <date-picker
                            v-model="azmoonData.start_date"
                            name="start_date"
                            label="شروع"
                            type="datetime"
                            format="YYYY-MM-DD HH:mm:ss"
                            locale="fa"
                          ></date-picker>
                        </div>
                        <div class="col-lg-4 mb-3">
                          <label for="azmoon_time">تاریخ پایان آزمون </label>
                          <date-picker
                            v-model="azmoonData.end_date"
                            name="end_date"
                            label="پایان"
                            type="datetime"
                            format="YYYY-MM-DD HH:mm:ss"
                            locale="fa"
                          ></date-picker>
                        </div>
                        <div class="col-lg-4 mb-3">
                          <label for="azmoon_time">مدت آزمون به دقیقه </label>
                          <input
                            type="number"
                            autocomplete="off"
                            class="form-control"
                            name="azmoon_time"
                            id="azmoon_time"
                            title="مدت آزمون به دقیقه"
                            placeholder=""
                            v-model="azmoonData.azmoon_time"
                          />
                        </div>
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
                            v-model="azmoonData.soal_count"
                          />
                        </div>
                        <div class="col-lg-4 mb-3">
                          <label for="answer_type">نوع نمایش گزینه ها</label>
                          <select
                            autofocus
                            class="form-control"
                            name="answer_type"
                            id="answer_type"
                            v-model="azmoonData.answer_type"
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
                      @click.prevent="FieldStored()"
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
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.min.css";
import "vue-multiselect/dist/vue-multiselect.min";

import VuePersianDatetimePicker from "vue-persian-datetime-picker";

export default {
  name: "AzmoonCreate",

  data() {
    return {
      azmoonData: {
        azmoon_type: "normal",
        azmoon_for: "exam",
        class_type: "all",
        type: "porseshnameh",
        type_payment: "free",
        answer_type: "numeric",
        soal_count: 5,
        azmoon_time: 1,
        class_id: [],
      },
      books: [],
      bases: {},
      classes: [],
      base_id: "",
    };
  },

  methods: {
    fetchAllBooks() {
      Vue.http
        .get("api/admin/books-all")
        .then((response) => {
          this.books = response.body;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    FieldStored() {
      Vue.http
        .post("api/admin/azmoon-store", this.azmoonData)
        .then((response) => {
          Toast.fire({
            icon: "success",
            title: "اطلاعات با موفقیت آپدیت شد!",
          });
          this.$router.push({
            name: "AzmoonShow",
            params: { id: response.body.id },
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },

    fetchAllBases() {
      Vue.http.get("api/get-bases-list").then((response) => {
        this.bases = response.body;
      });
    },
  },

  watch: {
    base_id: function (value) {
      Vue.http
        .get("api/get-class-list/" + this.base_id)
        .then((response) => {
          this.classes = response.body;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    "azmoonData.class_type": function (params) {
      if (params === "elective") {
        this.fetchAllBases();
      }
    },
  },

  created() {
    this.fetchAllBooks();
  },

  components: {
    Multiselect,
    datePicker: VuePersianDatetimePicker,
  },
};
</script>

<style scoped>
</style>
