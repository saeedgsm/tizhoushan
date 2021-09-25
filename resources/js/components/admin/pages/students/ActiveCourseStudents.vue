<template>
    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">دانش آموزان</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست دانش آموزان دوره فعال</li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right">
                            <router-link :to="{name : 'ImportExcelStudents'}" class="btn btn-light btn-rounded">
                                <i class="dripicons-inbox mr-1"></i>
                                <strong>ورودی اکسل</strong>
                            </router-link>
                            <router-link :to="{name : 'Courses'}" class="btn btn-light btn-rounded">
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
                                    compactMode
                                    :columns="columns"
                                    :rows="rows"
                                    :line-numbers="true"
                                    :search-options="{
                      enabled: true,
                      placeholder:'کل اطلاعات را جستجو کن',
                      trigger: 'enter',
                    }"
                                    :pagination-options="{
                    enabled: true,
                    mode: 'pages',
                    perPage: 5,
                    position: 'top',
                    perPageDropdown: [10, 20, 50, 100,],
                    dropdownAllowAll: true,
                    setCurrentPage: 1,
                    nextLabel: 'بعدی',
                    prevLabel: 'قبلی',
                    rowsPerPageLabel: 'تعداد ردیف ',
                    ofLabel: 'از',
                    pageLabel: 'صفحه', // for 'pages' mode
                    allLabel: 'همه',
                    infoFn: (params) => `در حال نمایش از ${params.firstRecordOnPage} تا ${params.lastRecordOnPage} در صفحه ${params.currentPage}`,
                    }">
                                    <template slot="table-row" slot-scope="props">
                      <span v-if="props.column.field === 'actions'">
                         <button @click="editRow(props.row.actions)" class="btn btn-info btn-sm" title="ویرایش دانش آموز">
                           <i class="fa fa-edit"></i>
                           <span></span>
                         </button>
                         <button @click="deleteRow(props.row.actions, props.index)" class="btn btn-danger btn-sm"
                                 title="حذف دانش آموز">
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
    </div>
</template>

<script>
    import {VueGoodTable} from "vue-good-table";
    import 'vue-good-table/dist/vue-good-table.css';
    export default {
        name: "ActiveCourseStudents",
        data() {
            return {
                columns: [
                    {
                        label: 'نام نام خانوادگی',
                        field: 'name',
                        filterable: true,
                        filterOptions: {
                            enabled: true, // enable filter for this column
                            placeholder: "جستجو نام", // placeholder for filter input
                            trigger: "enter" //only trigger on enter not on keyup
                        }
                    },
                    {
                        label: 'پایه',
                        field: 'base_name',
                        width: '200px',
                        filterable: true,
                        filterOptions: {
                            placeholder: 'فیلتر براساس',
                            enabled: true, // enable filter for this column
                            filterDropdownItems: [
                                {value: '', text: 'همه'},
                                {value: 'اول', text: 'اول'},
                                {value: 'دوم', text: 'دوم'},
                                {value: 'سوم', text: 'سوم'},
                                {value: 'چهارم', text: 'چهارم'},
                                {value: 'پنجم', text: 'پنجم'},
                                {value: 'ششم', text: 'ششم'},
                                {value: 'هفتم', text: 'هفتم'},
                                {value: 'هشتم', text: 'هشتم'},
                                {value: 'نهم', text: 'نهم'},
                                {value: 'دهم', text: 'دهم'},
                                {value: 'یازدهم', text: 'یازدهم'},
                                {value: 'دوازدهم', text: 'دوازدهم'},
                                {value: 'تعیین نشده', text: 'تعیین نشده'},
                            ],
                        }
                    },
                    {
                        label: 'کلاس',
                        field: 'class_name',
                        filterable: true,
                        filterOptions: {
                            enabled: true, // enable filter for this column
                            placeholder: "جستجو کلاس", // placeholder for filter input
                            trigger: "enter" //only trigger on enter not on keyup
                        }
                    },
                    {
                        label: 'کد کاربری',
                        field: 'usercode',
                        type: 'number',
                        filterable: false,
                        filterOptions: {
                            enabled: true, // enable filter for this column
                            placeholder: "جستجو کد کاربری", // placeholder for filter input
                            trigger: "enter" //only trigger on enter not on keyup
                        }
                    },
                    {
                        label: 'کلمه عبور',
                        field: 'userpass',
                    },
                    {
                        label: 'موبایل',
                        field: 'phone',
                        type: 'number',
                        filterable: false,
                        filterOptions: {
                            enabled: true, // enable filter for this column
                            placeholder: "جستجو موبایل", // placeholder for filter input
                            trigger: "enter" //only trigger on enter not on keyup
                        }
                    },
                    {
                        label: 'تنظیمات',
                        field: 'actions',
                    },
                ],
                rows: [],
                studentBaseClass: {},
                text: ''
            }
        },
        methods: {
            fetchActiveCourseStudents() {
                Vue.http.get('api/admin/active-course-students').then(response => {
                    if (response.body === 'error'){
                         Swal.fire("لطفا دوره فعال را مشخص کنید!");
                        this.$router.push({name: 'Courses'});
                    }else{
                         Swal.fire("مدیریت محترم اطلاعات دانش آموزان در حال بارگزاری می باشد! لطفا چند لحظه صبر کنید!");
                        let studentAll = response.data.students;
                        let publicHeaders = response.data.public_headers;
                        let fHeaders = response.data.headers;
                        for (const publicHeadersKey of publicHeaders) {
                            this.columns.push(publicHeadersKey);
                        }
                        for (const fHeadersKey of fHeaders) {
                            this.columns.push(fHeadersKey);
                        }
                        let students = [];
                        for (let student of studentAll) {
                            let obj = {};
                            for (const student1 of student.custom_fields) {
                                obj[student1.field] = student1.value;
                                // obj[student1.field] = "jsj";
                            }
                            let cells = {
                                'actions': student.user_id,
                                'name': student.name_family,
                                'usercode': student.user_code,
                                'userpass': student.user_pass,
                                'phone': student.phone,
                                'base_id': student.base_id,
                                'base_name': student.base_name,
                                'class_id': student.class_id,
                                'class_name': student.class_name,
                            }
                            let all = Object.assign(cells, obj)
                            students.push(all);
                        }
                        this.rows = students;
                    }

                }, error => {
                    console.log(error);
                });
            },

            editRow(id) {
                this.$router.push({name: 'StudentEdit', params: {id: id}});
            },
            deleteRow(id, index) {
                 Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'دانش آموز مورد نظر غیر قابل برگشت خواهد بود!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله حذف شود',
                    confirmButtonColor:'red',
                    cancelButtonText: 'نه! دستم اشتباهی خورد',
                    showCloseButton: true,
                    customClass: 'swal2-popup',
                }).then((result) => {
                    if(result.value) {
                        Vue.http.delete('api/admin/active-course-student/delete/' + id).then(response => {
                            console.log(response);
                            if (response.status === 200) {
                                this.rows.splice(index, 1);
                            }
                        }, error => {
                            console.log(error);
                        });
                         Swal.fire('حذف شد!', 'اطلاعات دانش آموز با موفقیت حذف گردید!', 'success');
                    } else {
                         Swal.fire('کنسل شد', 'اطلاعات دانش آموز مورد نظر هنوز سالم است', 'info')
                    }
                });
            },
        },
        created() {
            this.fetchActiveCourseStudents();

        },
        components: {
            VueGoodTable
        }
    }
</script>

<style scoped>
    .vgt-wrap {
        white-space: nowrap;
    }
</style>
