<template>
  <div class="page-content">
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-4">
            <h4 class="page-title mb-1">آپشن</h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active">آپشن های فیلد های سفارشی کمبوباکس - چک باکس - رادیو باتن</li>
            </ol>
          </div>
          <div class="col-md-8">
            <div class="float-right ">
              <router-link :to="{name : 'Fields'}" class="btn btn-light btn-rounded">
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
                <h3 class="mb-0">ویرایش آپشن </h3>
              </div>

              <div class="card-body">
                <div class="card mb-0">
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label>نام</label>
                      <i class="fas fa-flag-checkered pull-right" title="This field is translatable."></i>
                      <input type="text" name="option_value" value="" placeholder="مقدار آپشن"
                             class="form-control" v-model="option_value" :class="{invalid:$v.option_value.$error}"  @input="$v.option_value.$touch()">
                      <p class="text-danger" v-if="! $v.option_value.required && $v.option_value.$dirty">لطفا مقدار آپشن را وارد کنید!</p>
                      <p class="text-danger" v-if="! $v.option_value.maxLength">
                        مقدار آپشن نمی تواند بیشتر از
                        {{ $v.option_value.$params.maxLength }}
                        کاراکتر باشد!</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mt-4">
                  <button type="submit"
                          @click.prevent="OptionUpdate()"
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
import {maxLength, required} from "vuelidate/lib/validators";
import Vue from "vue";
export default {
  data() {
    return {
      'option_value': '',
    }
  },
  methods: {
    getOption(id){
      Vue.http.get("api/admin/field/option/edit/" + id).then(
          (response) => {
            this.option_value = response.body.option_value;
          },
          (error) => {
            console.log(error);
          }
      );
    },
    OptionUpdate(){
      const option = {
        'option_value' : this.option_value,
      }
      Vue.http.post('api/admin/field/option/update/'+this.$route.params.id,option).then(response=>{
          let timerInterval
          this.$swal({
              title: 'خیلی خب',
              html: 'اطلاعات با موفقیت  <b></b> ویرایش گردید.',
              timer: 2000,
              timerProgressBar: true,
              didOpen: () => {
                  this.$swal.showLoading()
                  timerInterval = setInterval(() => {
                      const content = this.$swal.getHtmlContainer()
                      if (content) {
                          const b = content.querySelector('b')
                          if (b) {
                              b.textContent = this.$swal.getTimerLeft()
                          }
                      }
                  }, 100)
              },
              willClose: () => {
                  clearInterval(timerInterval)
              }
          }).then((result) => {
              if (result.dismiss === this.$swal.DismissReason.timer) {
                  console.log('I was closed by the timer')
              }
          });
        this.$router.push({name: 'FieldOptions',params :{ id :response.body.field_id }});

      }).catch(error=>{
          console.log(error);
      });
    }
  },
  created() {
    this.getOption(this.$route.params.id);
  },
  validations: {
    option_value: {
      required,
      maxLength: maxLength(100),
    },
  }
}
</script>

<style scoped>

</style>
