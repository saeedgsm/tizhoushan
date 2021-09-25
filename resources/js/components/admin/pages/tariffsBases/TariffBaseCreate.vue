<template>
  <div class="page-content">
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-4">
            <h4 class="page-title mb-1">افزودن تعرفه پایه ها</h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active">بعد ثبت نام اولیه برای تکمیل اطلاعات</li>
            </ol>
          </div>
          <div class="col-md-8">
            <div class="float-right d-md-block">
              <router-link :to="{name : 'TariffBases'}" class="btn btn-light btn-rounded">
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
        <div class="row">
              <div class="col-sm-12">
                <div class="flex-row d-flex justify-content-center">
                  <div class="card border-top border-primary">
                    <div class="card-header">
                      <h3 class="mb-0">هزینه ثبت نام پایه های آموزشی</h3>
                    </div>

                    <div class="card-body">
                      <div class="card mb-0">
                        <div class="row">

                          <div class="form-group col-md-6">
                            <label>عنوان تعرفه</label>
                            <i class="fas fa-flag-checkered pull-right" title="This field is translatable."></i>
                            <input type="text" name="tariff_label" value="" placeholder="نام تعرفه"
                                   class="form-control" v-model="tariffBases.tariff_label"
                                   :class="{invalid:$v.tariffBases.tariff_label.$error}"
                                   @input="$v.tariffBases.tariff_label.$touch()">
                            <p class="text-danger"
                               v-if="! $v.tariffBases.tariff_label.required && $v.tariffBases.tariff_label.$dirty">لطفا
                              نام تعرفه را وارد کنید!</p>
                            <p class="text-danger" v-if="! $v.tariffBases.tariff_label.maxLength">
                              نام تعرفه نمی تواند بیشتر از
                              {{ $v.tariffBases.tariff_label.$params.maxLength }}
                              کاراکتر باشد!</p>
                          </div>

                          <div class="form-group col-md-6">
                            <label>هزینه به تومان</label>

                            <input type="text" name="tariff_amount" value="" placeholder="به تومان وارد کنید"
                                   class="form-control" v-model="tariffBases.tariff_amount"
                                   :class="{invalid:$v.tariffBases.tariff_amount.$error}"
                                   @input="$v.tariffBases.tariff_amount.$touch()">
                            <p class="text-danger"
                               v-if="! $v.tariffBases.tariff_amount.required && $v.tariffBases.tariff_amount.$dirty">لطفا
                              هزینه تعرفه را وارد کنید!</p>
                            <p class="text-danger"
                               v-if="! $v.tariffBases.tariff_amount.numeric">
                              هزینه تعرفه باید عدد باشد!</p>
                          </div>

                          <div class="form-group col-md-12">
                            <label class="typo__label">لیست پایه ها</label>
                            <multiselect dir="rtl" v-model="tariffBases.bases_ids" :options="bases" :multiple="true"
                                         :close-on-select="false" :clear-on-select="false" :preserve-search="true"
                                         noOptions="false" placeholder="لطفا انتخاب کنید" label="base_title"
                                         track-by="base_title" :preselect-first="true">
                              <template slot="selection" slot-scope="{ values, search, isOpen }">
                                <span  class="multiselect__single text-right" style="text-align: right !important;" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} پایه های انتخاب شده:</span>
                              </template>
                            </multiselect>
                          </div>

                          <div class="form-group col-md-12">
                            <div class="checkbox">

                              <label>وضعیت تعرفه</label><br>
                              <label>
                                <input type="hidden" name="tariff_active" value="0" v-model="tariffBases.tariff_active">
                                <input type="checkbox" value="1" name="tariff_active" v-model="tariffBases.tariff_active">
                                فعال
                              </label>
                            </div>
                          </div>

                          <div class="form-group col-md-12">
                            <label>توضیح</label>
                            <i class="fas fa-flag-checkered pull-right" title="This field is translatable."></i>
                            <input type="text" name="tariff_desc" value="" placeholder="توضیح در مورد تعرفه"
                                   class="form-control" v-model="tariffBases.tariff_desc"
                                   :class="{invalid:$v.tariffBases.tariff_desc.$error}"
                                   @input="$v.tariffBases.tariff_desc.$touch()">
                            <p class="text-danger" v-if="! $v.tariffBases.tariff_desc.maxLength">
                              توضیح تعرفه نمی تواند بیشتر از
                              {{ $v.tariffBases.tariff_desc.$params.maxLength }}
                              کاراکتر باشد!</p>
                          </div>

                        </div>
                      </div>
                      <div class="col-md-4 mt-4">
                        <button type="submit"
                                @click.prevent="TariffStore"
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
  </div>
</template>

<script>
import Vue from "vue";
import Multiselect from 'vue-multiselect';
import "vue-multiselect/dist/vue-multiselect.min.css";
import "vue-multiselect/dist/vue-multiselect.min";
import {maxLength, required, alphaNum, numeric} from "vuelidate/lib/validators";

export default {
  name: "TariffBaseCreate",
  data() {
    return {
      tariffBases: {
        tariff_label: '',
        tariff_amount: '',
        tariff_active: '',
        tariff_desc: '',
        bases_ids: [],
      },
      bases: [],
    }
  },

  methods: {
    TariffStore() {
      Vue.http.post('api/admin/tariff-base/store', this.tariffBases)
          .then(response => {
              let timerInterval
               Swal.fire({
                  title: 'خیلی خب',
                  html: 'اطلاعات با موفقیت  <b></b> ثبت گردید.',
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
                  /* Read more about handling dismissals below */
                  if (result.dismiss === this.$swal.DismissReason.timer) {
                      console.log('I was closed by the timer')
                  }
              });
            this.$router.push({name: 'TariffBases'});
          }).catch(error => {
        console.log(error)
      });

    },

    fetchAllBases(){
      Vue.http.get('api/get-bases-list')
      .then(response=>{
        this.bases = response.body;
      }).catch(error=>{
        console.log(error);
      });
    }

  },

  created() {
    this.fetchAllBases();
  },

  validations: {
    tariffBases: {
      tariff_label: {
        required,
        maxLength: maxLength(100),
      },
      tariff_amount: {
        required,
        numeric,
      },
      tariff_desc: {
        maxLength: maxLength(191),
      },
      bases_ids: {
        required,
      }

    }
  },

  components: {
    Multiselect
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
