<template>
    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">پایه های آموزشی</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست پایه های آموزشی</li>
                        </ol>
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
                                <h4 class="header-title">لیست پایه های آموزشی</h4>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>عنوان پایه</th>
                                            <th>لیبل</th>
                                            <th>کلاس ها</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="base in bases" :key="base.id">
                                            <td>{{ base.base_title }}</td>
                                            <td>{{ base.base_label }}</td>
                                            <td>
                                                <router-link
                                                    :to="{
                                                        name: 'BaseClasses',
                                                        params: { id: base.id },
                                                        }" class="btn btn-info btn-sm" title="مشاهده جزئیات پایه های آموزشی ">
                                                    <i class="ti-eye"></i>
                                                    <b>کلاس ها</b>
                                                </router-link>
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
</template>

<script>
export default {
    name: "AllBases",

    data(){
        return {
            bases:[]
        }
    },

    methods:{
        fetchAllBases(){
            Vue.http.get('api/get-bases-list').then(response=>{
                console.log(response);
                this.bases = response.body;
            }).catch(error=>{
                console.log(error);
            })
        }
    },

    created() {
        this.fetchAllBases();
    }


}
</script>

<style scoped>

</style>
