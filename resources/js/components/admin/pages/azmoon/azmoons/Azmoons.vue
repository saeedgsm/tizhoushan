<template>
    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">آزمون</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست آزمون</li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right d-md-block">
                            <router-link :to="{name : 'AzmoonCreate'}" class="btn btn-light btn-rounded">
                                <i class="dripicons-plus mr-1"></i>
                                <strong>افزودن آزمون</strong>
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
                                <h4 class="header-title">لیست آزمون</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0 table-striped table-hover mx-auto">
                                        <thead>
                                        <tr >
                                            <th> نام </th>
                                            <th>نوع </th>
                                            <th>جهت استفاده </th>
                                            <th>زمان شروع</th>
                                            <th>تنظیمات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(azmoon,index) in azmoonsData.data" :key="azmoon.id">

                                            <th scope="row">

                                                <router-link :to="{
                                                        name: 'AzmoonShow',
                                                        params: { id: azmoon.id },
                                                        }" class="btn btn-outline-info btn-sm" title="مشاهده جزئیات آزمون">
                                                    <i class="ti-eye"></i>
                                                    <b>{{ azmoon.azmoon_title }}</b>
                                                </router-link>
                                            </th>
                                            <td>{{ azmoon.azmoon_type }}</td>
                                            <td>{{ azmoon.azmoon_for }}</td>
                                            <td>{{ azmoon.azmoon_start }}</td>
                                            <td>
                                                <div class="btn-group btn-sm">

                                                    <button
                                                        @click.prevent="destroyAzmoon(azmoon.id,index)"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="dripicons dripicons-document-delete"></i>
                                                        <b>حذف</b>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>


                                        </tbody>
                                    </table>
                                    <pagination :data="azmoonsData" @pagination-change-page="fetchAllAzmoons"></pagination>
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
        name: "Azmoons",

        data(){
            return {
                azmoonsData:{},
            }
        },

        methods:{

            fetchAllAzmoons(page){
                if (typeof page === 'undefined') {
                    page = 1;
                }
                Vue.http.get('api/admin/azmoons-all?page='+page)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                    this.azmoonsData = data;
                });
            },

            destroyAzmoon(id,index){
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'آزمون مورد نظر غیر قابل برگشت خواهد بود!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله حذف شود',
                    confirmButtonColor:'red',
                    cancelButtonText: 'نه! دستم اشتباهی خورد',
                    showCloseButton: true,
                    customClass: 'swal2-popup',
                }).then((result) => {
                    if(result.value) {
                        Vue.http.delete('api/admin/azmoon/delete/' + id).then(response => {
                            this.fetchAllAzmoons();
                            if (response.status === 200) {
                               // this.azmoonsData.splice(index, 1);
                            }
                        }, error => {
                            console.log(error);
                        });
                         Swal.fire('حذف شد!', 'اطلاعات آزمون با موفقیت حذف گردید!', 'success');
                    } else {
                         Swal.fire('کنسل شد', 'آزمون مورد نظر هنوز سالم است', 'info')
                    }
                })
            }
        },

        created() {
            this.fetchAllAzmoons();
        }
    }
</script>

<style scoped>

</style>
