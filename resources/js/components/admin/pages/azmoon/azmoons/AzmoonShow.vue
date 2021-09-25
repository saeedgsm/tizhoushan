<template>
  <div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-4">
            <h4 class="page-title mb-1">آزمون</h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active">
                <span
                  >این صفحه در حال توسعه است برای مشاهده امکانات قبلی دکمه روبرو
                  کلیک کنید</span
                >
              </li>
            </ol>
          </div>
          <div class="col-md-8">
            <div class="float-right">
              <router-link
                :to="{ name: 'Azmoons' }"
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
    <div class="page-content-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h4 class="header-title pb-3">کنترل پنل آزمون</h4>
                <div class="m-3 border p-3 mb-3 bg-white shadow-lg">
                  <h5 class="header-title p-2">تنظیمات</h5>
                  <div class="row pr-3 pl-3">
                    <button
                      v-show="azmoon.azmoon_status === 1"
                      class="btn btn-success m-1"
                      @click="changeAzmoonStatus(azmoon.id)"
                    >
                      فعال
                    </button>
                    <button
                      v-show="azmoon.azmoon_status === 0"
                      class="btn btn-danger m-1"
                      @click="changeAzmoonStatus(azmoon.id)"
                    >
                      غیرفعال
                    </button>

                    <button
                      class="btn btn-info m-1"
                      @click="resetAzmoon(azmoon.id)"
                    >
                      ریست
                    </button>
                    <router-link
                      :to="{
                        name: 'AzmoonEdit',
                        params: {
                          id: this.$route.params.id,
                        },
                      }"
                      class="btn btn-info m-1"
                      title="ویرایش آزمون"
                    >
                      ویرایش
                    </router-link>
                    <router-link
                      :to="{
                        name: 'AzmoonDateEdit',
                        params: {
                          id: this.$route.params.id,
                        },
                      }"
                      class="btn btn-info m-1"
                      title="ویرایش تاریخ آزمون"
                    >
                      ویرایش تاریخ
                    </router-link>
                    <button
                      v-if="azmoon.class_type === 'elective'"
                      type="button"
                      class="btn btn-info btn-sm m-1"
                      data-toggle="modal"
                      data-target=".azmoon-classes"
                    >
                      کلاس ها
                    </button>

                    <router-link
                      :to="{
                        name: 'AnalyticalReport',
                        params: {
                          id: this.$route.params.id,
                        },
                      }"
                      class="btn btn-info m-1"
                      title="گزارش تحلیل آزمون"
                    >
                      گزارش تحلیلی
                    </router-link>
                    <router-link
                      :to="{
                        name: 'MomentReport',
                        params: {
                          id: this.$route.params.id,
                        },
                      }"
                      class="btn btn-info m-1"
                      title="گزارش لحظه ای آزمون"
                    >
                      گزارش لحظه ای
                    </router-link>

                    <button
                      class="btn btn-info m-1"
                      @click="exportExcel(azmoon.id)"
                    >
                      اکسل
                    </button>
                  </div>
                </div>
                <div class="m-3 border p-3 mb-3 bg-white shadow-lg">
                  <h5 class="header-title p-2">مدیریت سوال و فایل</h5>
                  <div class="row pr-3 pl-3">
                    <div v-if="azmoon.azmoon_type === 'normal'">
                      <div v-if="soal.soal_type === 'porseshnameh'">
                        <button
                          type="button"
                          class="btn btn-info"
                          data-toggle="modal"
                          data-target=".normal-poreshnameh"
                        >
                          فایل پرسشنامه
                        </button>

                        <button
                          type="button"
                          class="btn btn-info"
                          data-toggle="modal"
                          data-target=".normal-poreshnameh-file-upload"
                        >
                          آپلود فایل
                        </button>

                        <button
                          type="button"
                          class="btn btn-info"
                          data-toggle="modal"
                          data-target=".normal-poreshnameh-soal"
                        >
                          پاسخنامه
                        </button>
                      </div>

                      <button
                        v-if="soal.soal_type === 'soal_b_soal'"
                        type="button"
                        class="btn btn-info"
                        data-toggle="modal"
                        data-target=".file-poreshnameh"
                      >
                        فایل سوالات
                      </button>
                    </div>

                    <div v-if="azmoon.azmoon_type === 'advanced'">
                      <button
                        v-if="soal.soal_type === 'porseshnameh'"
                        type="button"
                        class="btn btn-info"
                        data-toggle="modal"
                        data-target=".file-poreshnameh"
                      >
                        فایل پرسشنامه
                      </button>
                      <button
                        v-if="soal.soal_type === 'soal_b_soal'"
                        type="button"
                        class="btn btn-info"
                        data-toggle="modal"
                        data-target=".file-poreshnameh"
                      >
                        فایل سوالات
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h4 class="header-title pb-3">جزئیات آزمون</h4>
                <div class="row">
                  <div class="col-sm-4 text-xs-center text-md-left">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <td>نام آزمون</td>
                            <td class="text-xs-right">
                              <b>{{ azmoon.azmoon_title }}</b>
                            </td>
                          </tr>
                          <tr>
                            <td>نوع آزمون</td>
                            <td class="text-xs-right">
                              <b>{{
                                azmoon.azmoon_type === "normal"
                                  ? "عادی"
                                  : "پیشرفته"
                              }}</b>
                            </td>
                          </tr>
                          <tr>
                            <td>کتاب مربوطه</td>
                            <td class="text-xs-right">
                              <div v-for="book in books" :key="book.id">
                                <b
                                  >{{ book.book_name }}
                                  ,
                                </b>
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>زمان شروع</td>
                            <td class="text-xs-right">
                              <b>{{ azmoon.azmoon_start }}</b>
                            </td>
                          </tr>
                          <tr>
                            <td>زمان پایان</td>
                            <td class="text-xs-right">
                              <b>{{ azmoon.azmoon_end }}</b>
                            </td>
                          </tr>
                          <tr>
                            <td>لینک آزمون</td>
                            <td class="text-xs-right">
                              <button
                                class="btn btn-outline-info btn-sm"
                                @click="copyToClipboard('#links')"
                              >
                                <i class="fa fa-copy"></i>
                                <span>کپی لینک</span>
                              </button>
                            </td>
                          </tr>
                          <tr>
                            <td>هزینه آزمون</td>
                            <td class="text-xs-right">
                              <b v-if="azmoon.type_payment === 'free'"
                                >رایگان</b
                              >
                              <b v-else>{{ azmoon.price }} تومان</b>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-sm-4 text-xs-center text-md-left">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <td>همگام سازی آزمون</td>
                            <td class="text-xs-right">
                              <b>{{
                                azmoon.azmoon_sync === 1 ? "فعال" : "غیر فعال"
                              }}</b>
                            </td>
                          </tr>
                          <tr>
                            <td>مدت زمان تاخیر</td>
                            <td class="text-xs-right">
                              <b v-if="azmoon.azmoon_sync_time === null"
                                >ندارد</b
                              >
                              <b v-else>{{ azmoon.azmoon_sync_time }} دقیقه</b>
                            </td>
                          </tr>

                          <tr>
                            <td>مدت آزمون</td>
                            <td class="text-xs-right">
                              <b>{{ azmoon.azmoon_time }}</b>
                              دقیقه
                            </td>
                          </tr>
                          <tr>
                            <td>نوع سوال</td>
                            <td class="text-xs-right">
                              <b v-if="soal.type === 'porseshnameh'"
                                >پرسشنامه ای</b
                              >
                              <b v-else>سوال به سوال</b>
                            </td>
                          </tr>
                          <tr>
                            <td>تعداد سوال</td>
                            <td class="text-xs-right">
                              <b>{{ soal.soal_count }}</b>
                              سوال
                            </td>
                          </tr>
                          <tr>
                            <td>نوع نمایش گزینه ها</td>
                            <td class="text-xs-right">
                              <b>{{
                                soal.answer_type === "alpha" ? "حروف" : "عددی"
                              }}</b>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="vld-parent">
                    <loading
                      :active.sync="isLoading"
                      :can-cancel="true"
                      :is-full-page="fullPage"
                    ></loading>
        </div>
      </div>
    </div>

    <file-normal-porseshnameh
      :azmoonId="this.$route.params.id"
    ></file-normal-porseshnameh>

    <azmoon-classes :azmoonId="this.$route.params.id"></azmoon-classes>

    <file-normal-porseshnameh-upload
      :azmoonId="this.$route.params.id"
    ></file-normal-porseshnameh-upload>
    <soal-normal-porseshnameh
      :soalCount="soal.soal_count"
      :azmoonId="this.$route.params.id"
    ></soal-normal-porseshnameh>
  </div>
</template>

<script>
import FileNormalPorsehnamehs from "./azmoonShowComponents/FileNormalPoreshnamehs.vue";
import FileNormalPorsehnamehUpload from "./azmoonShowComponents/FileNormalPoreshnamehsUpload.vue";
import SoalNormalPorsehnamehs from "./azmoonShowComponents/SoalNormalPoreshnamehs.vue";
import AzmoonClasses from "./azmoonShowComponents/AzmoonClasses.vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
  name: "AzmoonShow",
  components: {
    "file-normal-porseshnameh": FileNormalPorsehnamehs,
    "file-normal-porseshnameh-upload": FileNormalPorsehnamehUpload,
    "soal-normal-porseshnameh": SoalNormalPorsehnamehs,
    "azmoon-classes": AzmoonClasses,
    Loading,
  },
  data() {
    return {
      azmoon: [],
      books: [],
      soal: {},
       isLoading: false,
       fullPage: true,
    };
  },

  methods: {
    fetchAzmoonInfo(id) {
      Vue.http
        .get("api/admin/azmoon-show/" + id)
        .then((response) => {
          // console.log(response);
          this.azmoon = response.body.azmoon;
          this.books = response.body.books;
          this.soal = response.body.soal;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    copyToClipboard(element) {
      let azmoon_link = this.azmoon.azmoon_link;
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val(azmoon_link).select();
      document.execCommand("copy");
      $temp.remove();
      Swal.fire({
        icon: "success",
        title: "لینک آزمون کپی شد!",
        showConfirmButton: false,
        timer: 1500,
      });
    },

    changeAzmoonStatus(azmoonId) {
      Vue.http
        .post("api/admin/change-azmoon-status/" + azmoonId)
        .then((response) => {
          this.fetchAzmoonInfo(azmoonId);
          Toast.fire({
            icon: "success",
            title: "وضعیت آزمون با موفقیت تغییر یافت.",
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },

    resetAzmoon(azmoonId) {
      Swal.fire({
        title: "آیا مطمئن هستید؟",
        text: "نتایج آزمون ریست گردد؟!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "بله ریست شود",
        confirmButtonColor: "red",
        cancelButtonText: "نه! دستم اشتباهی خورد",
        showCloseButton: true,
        customClass: "swal2-popup",
      }).then((result) => {
        if (result.value) {
          Vue.http
            .post("api/admin/reset-azmoon/" + azmoonId)
            .then((response) => {
              console.log(response);
              this.fetchAzmoonInfo(azmoonId);
            })
            .catch((error) => {
              console.log(error);
            });
          Toast.fire({
            icon: "success",
            title: " آزمون با موفقیت ریست گردید.",
          });
        } else {
          Toast.fire({
            icon: "info",
            title: " ریست آزمون لغو گردید!",
          });
        }
      });
    },

    exportExcel(azmoonId) {
        this.isLoading = true;
        setTimeout(() => {
            Vue.http
        .get("api/admin/azmoon/export-excel/" + azmoonId)
        .then((response) => {
          let res = response.body.data;
          const anchor = document.createElement("a");
          const filename = response.body.filename;
          anchor.setAttribute("download", filename);
          anchor.setAttribute("href", res);
          document.body.appendChild(anchor);
          anchor.click();
          document.body.removeChild(anchor);
        //  this.isLoading = false;
        })
        .catch((error) => {
          console.log(error);
        });
        this.isLoading = false;
      }, 1000);


       //  this.isLoading = false;

    },
    doAjax() {
      this.isLoading = true;
      // simulate AJAX
      setTimeout(() => {
        this.isLoading = false;
      }, 5000);
    },
  },

  computed: {
    soalCount: function () {
      var ans = [];
      for (let i = 1; i <= this.soal.soal_count; i++) {
        ans.push(i);
      }
      return ans;
    },
  },

  created() {
    this.fetchAzmoonInfo(this.$route.params.id);
  },
};
</script>

<style scoped></style>
