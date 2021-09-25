<template>
  <div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-4">
            <h4 class="page-title mb-1">دانش آموزان</h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active">لیست دانش آموزان</li>
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

    <div class="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h4 class="font-size-18">لیست دانش آموزان</h4>
                <p class="card-title-desc"></p>

                <vue-good-table
                  :columns="columns"
                  :rows="rows"
                  :line-numbers="true"
                  :search-options="{
                    enabled: true,
                    placeholder: 'کل اطلاعات را جستجو کن',
                    trigger: 'enter',
                  }"
                  :pagination-options="{
                    enabled: true,
                    mode: 'pages',
                    perPage: 5,
                    position: 'top',
                    perPageDropdown: [10, 20, 50, 100],
                    dropdownAllowAll: true,
                    setCurrentPage: 1,
                    nextLabel: 'بعدی',
                    prevLabel: 'قبلی',
                    rowsPerPageLabel: 'تعداد ردیف ',
                    ofLabel: 'از',
                    pageLabel: 'صفحه', // for 'pages' mode
                    allLabel: 'همه',
                    infoFn: (params) =>
                      `در حال نمایش از ${params.firstRecordOnPage} تا ${params.lastRecordOnPage} در صفحه ${params.currentPage}`,
                  }"
                >
                  <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field === 'actions'">
                      <button
                        @click="editRow(props.row,props.index)"
                        class="btn btn-info btn-sm"
                        title="ویرایش نتایج دانش آموز"
                        data-toggle="modal"
                          data-target=".edit-student-result"
                      >
                        <i class="fa fa-edit"></i>
                        <span></span>
                      </button>
                      <button
                        @click="resetStudent(props.row.actions, props.index)"
                        class="btn btn-danger btn-sm"
                        title="ریست"
                      >
                        <i class="mdi mdi-account-remove"></i>
                        <span></span>
                      </button>
                    </span>
                    <span v-else>
                      {{ props.formattedRow[props.column.field] }}
                    </span>
                  </template>
                </vue-good-table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <edit-student-result :azmoonInfo="azmoonInfo" @updateStudentResult="updateStudentResult"></edit-student-result>
  </div>
</template>

<script>
import { VueGoodTable } from "vue-good-table";
import "vue-good-table/dist/vue-good-table.css";
import EditStudentResult from './momentReportComponents/EditStudentResult.vue';
export default {
  name: "MomentReport",
  data() {
    return {
      columns: [
        {
          label: "تاریخ شروع",
          field: "azmoon_start",
          filterable: false,
        },
        {
          label: "کد کاربری",
          field: "usercode",
          type: "number",
          filterable: false,
          filterOptions: {
            enabled: true, // enable filter for this column
            placeholder: "جستجو کد کاربری", // placeholder for filter input
            trigger: "enter", //only trigger on enter not on keyup
          },
        },
        {
          label: "نام نام خانوادگی",
          field: "fullname",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            placeholder: "جستجو نام", // placeholder for filter input
            trigger: "enter", //only trigger on enter not on keyup
          },
        },
        {
          label: "پایه",
          field: "base_title",
          width: "200px",
          filterable: true,
          filterOptions: {
            placeholder: "همه",
            enabled: true, // enable filter for this column
            filterDropdownItems: [
              { value: "اول", text: "اول" },
              { value: "دوم", text: "دوم" },
              { value: "سوم", text: "سوم" },
              { value: "چهارم", text: "چهارم" },
              { value: "پنجم", text: "پنجم" },
              { value: "ششم", text: "ششم" },
              { value: "هفتم", text: "هفتم" },
              { value: "هشتم", text: "هشتم" },
              { value: "نهم", text: "نهم" },
              { value: "دهم", text: "دهم" },
              { value: "یازدهم", text: "یازدهم" },
              { value: "دوازدهم", text: "دوازدهم" },
              { value: "تعیین نشده", text: "تعیین نشده" },
            ],
          },
        },
        {
          label: "کلاس",
          field: "class_title",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            placeholder: "جستجو کلاس", // placeholder for filter input
            trigger: "enter", //only trigger on enter not on keyup
          },
        },

        {
          label: "نمره",
          field: "percent",
        },

        {
          label: "درست",
          field: "correct",
        },

        {
          label: "نادرست",
          field: "incorrect",
        },

        {
          label: "نزده",
          field: "not_answer",
        },

        {
          label: "وضعیت",
          field: "azmoon_status",
          width: "200px",
          filterable: true,
          filterOptions: {
            placeholder: "همه",
            enabled: true, // enable filter for this column
            filterDropdownItems: [
              { value: "درحال آزمون", text: "درحال آزمون" },
              { value: "تموم شده", text: "تموم شده" },
              { value: "غائب", text: "غائب" },
            ],
          },
        },
        {
          label: "تنظیمات",
          field: "actions",
        },
      ],
      rows: [],
      studentBaseClass: {},
      text: "",
      soal:{},
      azmoonInfo:{
          azmoon_id:this.$route.params.id,
          result:null,
          index:null,
          soalCount:null
      }
    };
  },
  methods: {
    fetchMomentReport(azmoonId) {
      Vue.http
        .get("api/admin/azmoon/moment-report/" + azmoonId)
        .then((response) => {
         // console.log(response);
          this.rows = response.body.results;
          this.azmoonInfo.soalCount=response.body.soal.soal_count;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    fetchAzmoonClasses(azmoonId) {
      Vue.http
        .get("api/admin/azmoon-classes/" + azmoonId)
        .then((response) => {
         // console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    editRow(result,index) {
        this.azmoonInfo.result=result;
        this.azmoonInfo.index=index;
    },
    resetStudent(userId, index) {
      Swal.fire({
        title: "آیا مطمئن هستید؟",
        text: "از ریست کردن نتایج آزمون دانش آموز مطمئن هستید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "بله ریست شود",
        confirmButtonColor: "red",
        cancelButtonText: "نه! دستم اشتباهی خورد",
        showCloseButton: true,
        customClass: "swal2-popup",
      }).then((result) => {
        if (result.value) {
          const form = {
            azmoon_id: this.$route.params.id,
            user_id: userId,
          };
          Vue.http
            .post("api/admin/azmoon/student-result-reset", form)
            .then((response) => {
              Swal.fire({
                icon: response.body.icon,
                title: response.body.title,
                text: response.body.text,
                confirmButtonText:'خیلی خوب'
              });
              if (response.body.icon === 'error') {
                   console.log(response.body.error);
              }

            })
            .catch((error) => {
              console.log(error);
            });
        } else {
          Swal.fire("کنسل شد", "آزمون مورد نظر هنوز سالم است", "info");
        }
      });
    },

    updateStudentResult(result){
        const index_row = this.rows[result.index];
        index_row.percent = result.percent;
        index_row.azmoon_start = result.azmoon_start;
        index_row.correct = result.correct;
        index_row.incorrect = result.incorrect;
        index_row.not_answer = result.not_answer;
        index_row.azmoon_status = result.azmoon_status;
    }
  },
  created() {
    Swal.fire({
      icon: "info",
      title: "اطلاعات در حال پردازش می باشد لطفا چند لحظه صبر کنید!",
      showConfirmButton: true,
    });
    this.fetchMomentReport(this.$route.params.id);
  },
  components: {
    VueGoodTable,
    'edit-student-result':EditStudentResult
  },
};
</script>

<style scoped>
.vgt-wrap {
  white-space: nowrap;
}
.vgt-wrap__footer .footer__row-count::after {
  content: "";
  display: block;
  position: absolute;
  height: 0;
  width: 0;
  left: 6px;
  top: 50%;
  margin-top: -1px;
  border-top: 6px solid #606266;
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  border-bottom: none;
  pointer-events: none;
}
</style>
