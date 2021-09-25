<template>
    <div class="page-content">
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">تعرفه پایه ها</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">بعد ثبت نام اولیه برای تکمیل اطلاعات</li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right ">
                            <router-link
                                :to="{ name: 'TariffBaseCreate' }"
                                class="btn btn-light btn-rounded">
                                <i class="dripicons-plus mr-1"></i>
                                <strong>افزودن تعرفه</strong>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="flex-row d-flex justify-content-center">
                    <div class="col-sm-12 col-md-9">
                        <div class="card border-top border-primary">
                            <div class="card-header">
                                <h4 class="mb-0"> هزینه ثبت نام پایه های آموزشی </h4>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr class="table-primary">
                                            <th>عنوان</th>
                                            <th> هزینه</th>
                                            <th> پایه ها</th>
                                            <th>وضعیت</th>
                                            <th>ویرایش</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(fee,index) in displayedTariffs" :key="fee.id">
                                            <td>{{ fee.tariff_label }}</td>
                                            <td>{{ fee.tariff_amount }}</td>
                                            <td>{{ fee.tariff_bases }}</td>
                                            <td>{{ fee.tariff_active === 1 ? 'فعال' : 'غیر فعال' }}</td>
                                            <td>
                                                <div class="btn-group btn-sm">
                                                    <button
                                                        @click.prevent="destroyTariff(fee.id,index)"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="dripicons dripicons-document-delete"></i>
                                                        <b>حذف</b>
                                                    </button>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div class="d-flex justify-content-center">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <button type="button" class="page-link" v-if="page != 1" @click="page--">  قبلی </button>
                                                </li>
                                                <li class="page-item">
                                                    <button type="button" class="page-link" v-for="pageNumber in pages.slice(page-1, page+5)" @click="page = pageNumber"> {{pageNumber}} </button>
                                                </li>
                                                <li class="page-item">
                                                    <button type="button" @click="page++" v-if="page < pages.length" class="page-link"> بعدی </button>
                                                </li>
                                            </ul>
                                        </nav>
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
    import Paginate from "../../../../services/paginate/Paginate";
    export default {
        name: "TariffBases",
        data() {
            return {
                tariffBases: [],
                page: 1,
                perPage: 5,
                pages: [],
            }
        },

        methods: {
            fetchAllTariffBases() {
                Vue.http.get('api/admin/tariff-bases').then(response => {
                    this.tariffBases = response.body;
                }).catch(error => {
                    console.log(error);
                });
            },

            destroyTariff(id, index) {

                 Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'تعرفه مورد نظر غیر قابل برگشت خواهد بود!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله حذف شود',
                    confirmButtonColor:'red',
                    cancelButtonText: 'نه! دستم اشتباهی خورد',
                    showCloseButton: true,
                    customClass: 'swal2-popup',
                }).then((result) => {
                    if(result.value) {
                        Vue.http.delete('api/admin/tariff-base/delete/' + id).then(Response => {
                            this.tariffBases.splice(index, 1);
                        }, error => {
                            console.log(error);
                        });
                         Swal.fire('حذف شد!', 'اطلاعات تعرفه با موفقیت حذف گردید!', 'success');
                    } else {
                         Swal.fire('کنسل شد', 'تعرفه مورد نظر هنوز سالم است', 'info')
                    }
                })
            },
        },

        created() {
            this.fetchAllTariffBases();
        },

        computed: {
            displayedTariffs () {
                return  Paginate.paginate(this.page,this.perPage,this.tariffBases);
            }
        },

        watch: {
            tariffBases () {
                Paginate.setPages(this.tariffBases.length,this.perPage,this.pages);
            }
        },
    }
</script>

<style scoped>
    button.page-link {
        display: inline-block;
    }
    button.page-link {
        font-size: 20px;
        color: #29b3ed;
        font-weight: 500;
    }
    .offset{
        width: 500px !important;
        margin: 20px auto;
    }
</style>
