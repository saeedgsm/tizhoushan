<template>
  <div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-4">
            <h4 class="page-title mb-1">آپشن های فیلد سفارشی</h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active">
                آپشن های فیلد های سفارشی کمبوباکس - چک باکس - رادیو باتن
              </li>
            </ol>
          </div>
          <div class="col-md-8">
            <div class="float-right">
              <router-link
                  :to="{ name: 'OptionCreate' }"
                  class="btn btn-light btn-rounded">
                <i class="dripicons-plus mr-1"></i>
                <strong>افزودن آپشن</strong>
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
                    <tr  class="table-primary">
                      <th>نام</th>
                      <th>تنظیمات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(option,index) in options" :key="option.id">
                      <td>{{ option.option_value }}</td>
                      <td>
                        <div class="btn-group btn-sm">
                          <router-link
                              :to="{
                              name: 'OptionEdit',
                              params: { id: option.id },
                            }"
                              class="btn btn-warning"
                              title="ویرایش ">
                            <i class="ti-pencil-alt"></i>
                            <b>ویرایش</b>
                          </router-link>
                          <button
                              @click.prevent="destroyOption(option.id,index)"
                              class="btn btn-danger ">
                            <i class="ti-rem"></i>
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
</template>
<script>
import Vue from "vue";

export default {
  name: 'options',
  data() {
    return {
      options: {}
    }
  },
  methods: {
    getOptions(id) {
      Vue.http.get('api/admin/field/options/' + id).then(response => {
        this.options = response.body;
      }, error => {
        console.log(error);
      });
    },
    destroyOption(id,index) {
        this.$swal({
            title: 'آیا مطمئن هستید؟',
            text: 'آپشن فیلد مورد نظر غیر قابل برگشت خواهد بود!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'بله حذف شود',
            confirmButtonColor:'red',
            cancelButtonText: 'نه! دستم اشتباهی خورد',
            showCloseButton: true,
            customClass: 'swal2-popup',
        }).then((result) => {
            if(result.value) {
                Vue.http.delete('api/admin/field/option/destroy/' + id).then(Response => {
                    this.options.splice(index, 1)
                }, error => {
                    console.log(error);
                });
                this.$swal('حذف شد!', 'اطلاعات آپشن فیلد سفارشی با موفقیت حذف گردید!', 'success');
            } else {
                this.$swal('کنسل شد', 'آپشن فیلد مورد نظر هنوز سالم است', 'info')
            }
        });
    },
  },
  created() {
    this.getOptions(this.$route.params.id);
  }
}
</script>
