<template>
    <div class="page-content">
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">نوع کاربری</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست </li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right d-md-block">
                            <router-link :to="{name : 'CourseCreate'}" class="btn btn-light btn-rounded">
                                <i class="dripicons-plus mr-1"></i>
                                <strong>افزودن نوع کاربر</strong>
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
                                <h4 class="header-title">لیست کاربری ها</h4>
                                <p class="card-title-desc"></p>
                                <div class="row col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="search">عنوان دوره</label>
                                            <input
                                                id="search"
                                                v-model.lazy="search"
                                                type="text"
                                                @change="getRoles"
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
                                                <option value="name">نام</option>
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
                                                <th>عنوان </th>
                                                <th>کلید</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(role,index) in roles" :key="role.id">
                                                <td>{{ role.name }}</td>
                                                <td>{{ role.guard_name }}</td>
                                                <td>
                                                    <div class="btn-group btn-sm">
                                                        <router-link
                                                            :to="{
                              name: 'RoleEdit',
                              params: { id: role.id },
                            }"
                                                            class="btn btn-warning"
                                                            title="ویرایش ">
                                                            <i class="ti-pencil-alt"></i>
                                                            <b>ویرایش</b>
                                                        </router-link>
                                                        <button
                                                            @click.prevent="destroyRole(role.id,index)"
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
    name: "Roles",
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
            roles: {}
        }
    },
    methods: {
        getRoles() {
            const self = this;
            axios.get('/api/dashboard/roles', {
                params: {
                    page: self.page,
                    sort: self.sort,
                    search: self.search,
                    perPage: self.perPage
                }
            }).then(response => {
                self.roles = response.data.roles;
                self.pagination = response.data.pagination;
                if (self.pagination.totalPages < self.pagination.currentPage) {
                    self.page = self.pagination.totalPages;
                    self.getRoles();
                } else {
                    self.loading = false;
                }
            }).catch(function () {
                self.loading = false;
            });
        },
        destroyRole(id, index) {
            Swal.fire({
                title: 'آیا مطمئن هستید؟',
                text: 'نوع کاربری مورد نظر غیر قابل برگشت خواهد بود!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله حذف شود',
                confirmButtonColor: 'red',
                cancelButtonText: 'نه! دستم اشتباهی خورد',
                showCloseButton: true,
                customClass: 'swal2-popup',
            }).then((result) => {
                if (result.value) {
                    axios.delete('/api/dashboard/roles/' + id).then(response => {
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
                            this.roles.splice(index, 1);
                        }
                    }, error => {
                        console.log(error);
                    });
                    Swal.fire('حذف شد!', 'اطلاعات با موفقیت حذف گردید!', 'success');
                } else {
                    Swal.fire('کنسل شد', 'اطلاعات مورد نظر هنوز سالم است', 'info')
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
            self.getRoles();
        },

        changePage(page) {
            const self = this;
            if ((page > 0) && (page <= self.pagination.totalPages) && (page !== self.page)) {
                self.page = page;
                self.getRoles();
            }
        },
    },
    created() {
        this.getRoles();
    }
}
</script>

<style scoped>

</style>
