<template>

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">فیلد های سفارشی</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">
                                سفارش سازی لیست فیلد ها برای کاربران
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right d-md-block">
                            <router-link
                                :to="{ name: 'FieldCreate' }"
                                class="btn btn-light btn-rounded"
                            >
                                <i class="dripicons-plus mr-1"></i>
                                <strong>افزودن فیلد</strong>
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
                                <h4 class="header-title">لیست فیلد های سفارشی</h4>
                                <p class="card-title-desc"></p>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr class="table-primary">
                                            <th>نام</th>
                                            <th>وضعیت</th>
                                            <th>تنظیمات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(field, index) in displayedFields" :key="field.id">
                                            <td>{{ field.field_name }}</td>
                                            <td>
                                                <b>{{ field.field_active === '1' ? 'فعال' : 'غیر فعال' }}</b>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-sm">
                                                    <router-link
                                                        :to="{
                                                        name: 'FieldEdit',
                                                        params: { id: field.id },
                                                        }"
                                                        class="btn btn-warning  btn-sm"
                                                        title="ویرایش ">
                                                        <i class="ti-pencil-alt"></i>
                                                        <b>ویرایش</b>
                                                    </router-link>
                                                    <button
                                                        @click.prevent="destroyField(field.id,index)"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="dripicons dripicons-document-delete"></i>
                                                        <b>حذف</b>
                                                    </button>
                                                    <router-link
                                                        v-if="field.field_type === 'select' || field.field_type === 'checkbox' || field.field_type === 'radio'"
                                                        :to="{
                              name: 'FieldOptions',
                              params: { id: field.id },
                            }"
                                                        class="btn btn-info btn-sm"
                                                        title="آپشن ">
                                                        <i class="ti-layers"></i>
                                                        <b>آپشن</b>
                                                    </router-link>
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
        data() {
            return {
                fields: [],
                page: 1,
                perPage: 5,
                pages: [],
            }
        },
        methods: {
            getFieldsFromServer() {
                Vue.http.get("api/admin/field/all")
                    .then(response => {
                        this.fields = response.data;
                    }).catch(error => {
                    console.log(error)
                });
            },
            destroyField(id, index) {
                 Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'فیلد مورد نظر غیر قابل برگشت خواهد بود!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله حذف شود',
                    confirmButtonColor:'red',
                    cancelButtonText: 'نه! دستم اشتباهی خورد',
                    showCloseButton: true,
                    customClass: 'swal2-popup',
                }).then((result) => {
                    if(result.value) {
                        Vue.http.delete('api/admin/field/destroy/' + id).then(response => {
                            this.fields.splice(index, 1)
                        }, error => {
                            console.log(error);
                        });
                         Swal.fire('حذف شد!', 'اطلاعات فیلد سفارشی با موفقیت حذف گردید!', 'success');
                    } else {
                         Swal.fire('کنسل شد', 'فیلد مورد نظر هنوز سالم است', 'info')
                    }
                })

            },
        },

        computed: {
            displayedFields () {
                return  Paginate.paginate(this.page,this.perPage,this.fields);
            }
        },

        watch: {
            fields () {
                Paginate.setPages(this.fields.length,this.perPage,this.pages);
            }
        },

        created() {
            this.getFieldsFromServer()
        },

       /* filters: {
            trimWords(value){
                return value.split(" ").splice(0,20).join(" ") + '...';
            }
        }*/
    };
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
