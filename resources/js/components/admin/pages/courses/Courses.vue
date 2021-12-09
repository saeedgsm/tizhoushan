<template>
    <div class="page-content">
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">دوره ها</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست دوره ها</li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right d-md-block">
                            <router-link :to="{name : 'CourseCreate'}" class="btn btn-light btn-rounded">
                                <i class="dripicons-plus mr-1"></i>
                                <strong>افزودن دوره</strong>
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
                                <h4 class="header-title">لیست دوره ها</h4>
                                <p class="card-title-desc"></p>
                                <div class="row col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="search">عنوان دوره</label>
                                            <input
                                                id="search"
                                                v-model.lazy="search"
                                                type="text"
                                                @change="getCourses"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sortBy">ترتیب</label>
                                            <select id="sortBy"
                                                    v-model="sort.column"
                                                    @change="changeSort"
                                                    class="form-control">
                                                <option value="course_title">نام</option>
                                                <option value="created_at">تاریخ ایجاد</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>عنوان دوره</th>
                                                <th>کلاس</th>
                                                <th>دانش آموزان</th>
                                                <th>وضعیت</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(course,index) in courses" :key="course.id">
                                                <td>{{ course.course_title }}</td>

                                                <td>
                                                    <router-link :to="{name:'CourseClasses',params:{id:course.id}}"
                                                                 class="btn btn-info btn-sm">
                                                        <i class="fa fa-book-medical"></i> کلاس ها
                                                    </router-link>
                                                </td>

                                                <td>
                                                    <router-link :to="{name:'VuetifyStudents',params:{id:course.id}}"
                                                                 class="btn btn-info btn-sm">
                                                        <i class="fa fa-book-medical"></i> دانش آموزان
                                                    </router-link>
                                                </td>

                                                <td>{{ course.status === 1 ? 'فعال' : 'غیر فعال' }}</td>
                                                <td>
                                                    <div class="btn-group btn-sm">
                                                        <router-link
                                                            :to="{
                              name: 'CourseEdit',
                              params: { id: course.id },
                            }"
                                                            class="btn btn-warning"
                                                            title="ویرایش ">
                                                            <i class="ti-pencil-alt"></i>
                                                            <b>ویرایش</b>
                                                        </router-link>
                                                        <button
                                                            @click.prevent="destroyCourse(course.id,index)"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="dripicons dripicons-document-delete"></i>
                                                            <b>حذف</b>
                                                        </button>
                                                    </div>
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
        </div>
    </div>
</template>

<script>

export default {
    name: "Courses",
    data() {
        return {
            page: 1,
            search: '',
            sort: {
                order: 'asc',
                column: 'created_at',
            },
            perPage: 10,
            loading: true,
            pagination: {
                currentPage: 0,
                perPage: 0,
                total: 0,
                totalPages: 0
            },
            courses: {}
        }
    },
    methods: {
        getCourses() {
            const self = this;
            axios.get('/api/dashboard/courses', {
                params: {
                    page: self.page,
                    sort: self.sort,
                    search: self.search,
                    perPage: self.perPage
                }
            }).then(response => {
                self.courses = response.data.courses;
                self.pagination = response.data.pagination;
                if (self.pagination.totalPages < self.pagination.currentPage) {
                    self.page = self.pagination.totalPages;
                    self.getCourses();
                } else {
                    self.loading = false;
                }
            }).catch(function () {
                self.loading = false;
            });
        },
        destroyCourse(id, index) {
            Swal.fire({
                title: 'آیا مطمئن هستید؟',
                text: 'دوره مورد نظر غیر قابل برگشت خواهد بود!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله حذف شود',
                confirmButtonColor: 'red',
                cancelButtonText: 'نه! دستم اشتباهی خورد',
                showCloseButton: true,
                customClass: 'swal2-popup',
            }).then((result) => {
                if (result.value) {
                    axios.delete('/api/dashboard/courses/' + id).then(response => {
                        let result= response.data;
                        Swal.fire({
                            position: 'top-center',
                            icon: result.class,
                            title: result.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        if (result.ex!=null){
                            console.log(result.ex);
                        }
                        if (response.status === 200) {
                            this.courses.splice(index, 1);
                        }
                    }, error => {
                        console.log(error);
                    });
                    Swal.fire('حذف شد!', 'اطلاعات دوره با موفقیت حذف گردید!', 'success');
                } else {
                    Swal.fire('کنسل شد', 'دوره مورد نظر هنوز سالم است', 'info')
                }
            })
        },

        changeSort() {
            const self = this;
            if (self.sort.order === 'asc') {
                self.sort.order = 'desc';
            } else if (self.sort.order === 'desc') {
                self.sort.order = 'asc';
            }
            self.getCourses();
        },

        changePage(page) {
            const self = this;
            if ((page > 0) && (page <= self.pagination.totalPages) && (page !== self.page)) {
                self.page = page;
                self.getCourses();
            }
        },
    },
    created() {
        this.getCourses();
    }
}
</script>

<style scoped>

</style>
