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
            <div class="float-right d-md-block">
              <router-link
                  :to="{ name: 'RegistrationFee' }"
                  class="btn btn-light btn-rounded">
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
        <div class="flex-row d-flex justify-content-center">
          <div class="col-sm-12 col-md-9">
            <div class="card border-top border-primary">
              <div class="card-header">
                <h3 class="mb-0">ویرایش هزینه ثبت نام </h3>
              </div>
              <div class="card-body">
                <div class="card mb-0">
                  <div class="row">
                    <div class="form-group col-md-4">
                      <label>مقدار هزینه </label>
                      <i class="fas fa-flag-checkered pull-right" title="مقدار هزینه پرداختی دانش آموز"></i>
                      <input type="text" name="cost" placeholder="مقدار هزینه"
                             class="form-control" v-model="cost" :class="{ invalid: $v.cost.$error }"
                             @input="$v.cost.$touch()">
                      <p class="text-danger mt-1" v-if="! $v.cost.between"> مقدار معتبر نمی باشد!</p>
                      <p class="text-danger mt-1" v-if="! $v.cost.required && $v.cost.$dirty">لطفا مقدار هزینه را وارد کنید!</p>
                    </div>

                    <div class="col-md-12" style="margin-right: 20px">
                      <div class="mt-4 mt-sm-0">
                        <h5 class="font-size-14 mb-3">وضعیت پرداخت</h5>
                        <div class="custom-control custom-checkbox mb-2">
                          <input type="checkbox"
                                 name="field_active"
                                 value="1"
                                 id="customCheck1"
                                 class="custom-control-input"
                                 v-model="status">
                          <label class="custom-control-label" for="customCheck1">فعال</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="hidden"
                                 name="field_active"
                                 value="0"
                                 v-model="status">
                        </div>
                      </div>
                    </div>

                    <div class="form-group col-md-12">
                      <label>پیام برای کاربر </label>
                      <i class="fas fa-flag-checkered pull-right" title="پیام خود را برای کاربر وارد کنید"></i>
                      <textarea rows="4" name="cost" placeholder="پیام خود را برای کاربر وارد کنید"
                                class="form-control" v-model="desc"></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mt-4">
                  <button type="submit"
                          @click.prevent="RegistrationUpdate()"
                          :disabled="$v.$invalid"
                          class="btn btn-primary waves-effect waves-light">
                    ثبت اطلاعات
                  </button>
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
import Notify from "../../../../services/notification/Notification";
import {between, maxLength, required} from "vuelidate/lib/validators";

export default {
name: "RegistrationFeeEdit",
  data(){
    return {
      id: '',
      cost: '',
      status:'',
      desc:'',
    }
  },
  methods:{
    getRegistrationFee(id){
      Vue.http.get("api/registration-fee/"+id ).then(
          (response) => {
            // console.log(response.body.id);
            let gets = response.body;
            this.id =response.body.id;
            this.cost = gets.cost;
            this.status = gets.status;
            this.desc = gets.desc;
          },
          (error) => {
            console.log(error);
          }
      );
    },
    RegistrationUpdate(){
      const field = {
        'cost': this.cost,
        'status': this.status,
        'desc': this.desc,
      }
      Vue.http.post('api/registration-fee/update/' + this.id, field).then(response => {
        console.log(response.body);
        Notify.success('اطلاعات هزینه سفارش با موفقیت ویرایش گردید!');
        this.$router.push({name: 'RegistrationFee'});
      }, error => {
        console.log(error);
      });
    }
  },
  created() {
    //console.log(this.$route.params.id);
    this.getRegistrationFee(this.$route.params.id);
  },
  validations: {
    cost: {
      required,
      maxLength: maxLength(100),
      between: between(100, 99999999),
    },
  },
}
</script>

<style scoped>
.invalid {
  border: 1px solid red;
  box-shadow: 0 0 5px red;
  background-color: lightpink;
}
</style>