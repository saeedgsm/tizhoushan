<template>
  <div class="page-content">
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-4">
            <h4 class="page-title mb-1">هزینه پیش ثبت نام</h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active">بعد ثبت نام اولیه برای تکمیل اطلاعات </li>
            </ol>
          </div>
          <div class="col-md-8">
            <div class="float-right ">
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
                <h3 class="mb-0"> هزینه ثبت نام پایه های آموزشی </h3>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table mb-0">
                    <thead>
                    <tr>
                      <th>پایه </th>
                      <th>مقدار هزینه</th>
                      <th>وضعیت</th>
                      <th>ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="fee in fees" :key="fee.id">
                      <td>{{ fee.base_name }}</td>
                      <td>{{ fee.cost }}</td>
                      <td>{{ fee.status === 1 ? 'فعال' : 'غیر فعال' }}</td>
                      <td>
                        <div class="btn-group btn-sm">
                          <router-link
                              :to="{
                              name: 'RegistrationFeeEdit',
                              params: { id: fee.id },
                            }"
                              class="btn btn-info btn-sm"
                              title="ویرایش ">
                            <i class="ti-pencil-alt"></i>
                            <b></b>
                          </router-link>
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
export default {
  data(){
    return {
      fees:{}
    }
  },
  methods:{
    getRegistrationFeesAll(){
      Vue.http.get("api/registration-fees-all" ).then(
          (response) => {
             console.log(response.body);
             this.fees = response.body;
          },
          (error) => {
            console.log(error);
          }
      );
    },
  },
  created() {
    this.getRegistrationFeesAll();
  },
}
</script>

<style scoped>

</style>