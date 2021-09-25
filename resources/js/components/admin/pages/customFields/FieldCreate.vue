<template>
    <div class="page-content">
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">فیلد های سفارشی</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">سفارش سازی لیست فیلد ها برای کاربران</li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right d-md-block">
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
                <div class="row">
                    <form action="" method="post">
                        <div class="flex-row d-flex justify-content-center">
                            <div class="col-sm-12 col-md-9">
                                <div class="card border-top border-primary">
                                    <div class="card-header">
                                        <h4 class="mb-0">افزودن فیلد سفارشی جدید</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="card mb-0">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>نام</label>
                                                    <i class="fas fa-flag-checkered pull-right"
                                                       title="This field is translatable."></i>
                                                    <input type="text" name="field_name" value="" placeholder="نام فیلد"
                                                           class="form-control" v-model="field_name"
                                                           :class="{invalid:$v.field_name.$error}"
                                                           @input="$v.field_name.$touch()">
                                                    <p class="text-danger"
                                                       v-if="! $v.field_name.required && $v.field_name.$dirty">لطفا نام
                                                        فیلد
                                                        را وارد کنید!</p>
                                                    <p class="text-danger" v-if="! $v.field_name.maxLength">
                                                        نام فیلد نمی تواند بیشتر از
                                                        {{ $v.field_name.$params.maxLength }}
                                                        کاراکتر باشد!</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>توضیح</label>
                                                    <i class="fas fa-flag-checkered pull-right"
                                                       title="This field is translatable."></i>
                                                    <input type="text" name="field_help" value=""
                                                           placeholder="توضیح در مورد فیلد"
                                                           class="form-control" v-model="field_help">
                                                    <small class="form-control-feedback">یک متن اشاره برای فیلد وارد
                                                        کنید. متن در زیر این قسمت
                                                        ظاهر می شود.</small>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>نوع فیلد</label>
                                                    <select name="field_type" class="form-control" v-model="field_type"
                                                            :class="{invalid:$v.field_type.$error}">
                                                        <option value="" disabled>لطفا انتخاب کنید!</option>
                                                        <option value="text">نوشته</option>
                                                        <option value="textarea">نوشته چند خطی</option>
                                                        <option value="checkbox">چک باکس</option>
                                                        <option value="radio">رادیو باتن</option>
                                                        <option value="number">عدد</option>
                                                    </select>
                                                    <p class="text-danger"
                                                       v-if="! $v.field_type.required && $v.field_type.$dirty">لطفا نام
                                                        لاتین
                                                        را انتخاب کنید!</p>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="hidden" name="check_class_public" value="0"
                                                                   v-model="check_class_public">
                                                            <input type="checkbox" value="1" name="check_class_public"
                                                                   v-model="check_class_public">
                                                            <span> فیلد عمومی </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" v-show="!check_class_public">
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            <label>پایه آموزشی</label>
                                                            <select name="base_id" class="form-control"
                                                                    v-model="base_id">
                                                                <option value="" disabled>لطفا انتخاب کنید!</option>
                                                                <option v-for="base in bases" :v-key="base.id"
                                                                        :value="base.id">{{ base.base_title }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-9">
                                                            <label class="typo__label">لیست کلاس ها</label>
                                                            <multiselect dir="rtl" v-model="class_id" :options="classes"
                                                                         :multiple="true"
                                                                         :close-on-select="false"
                                                                         :clear-on-select="false"
                                                                         :preserve-search="true"
                                                                         noOptions="false"
                                                                         placeholder="لطفا انتخاب کنید"
                                                                         label="class_title"
                                                                         track-by="class_title" :preselect-first="true">
                                                                <template slot="selection"
                                                                          slot-scope="{ values, search, isOpen }">
                                <span class="multiselect__single text-right" style="text-align: right !important;"
                                      v-if="values.length &amp;&amp; !isOpen">{{
                                    values.length
                                  }} کلاس های انتخاب شده:</span>
                                                                </template>
                                                            </multiselect>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--                        <div class="form-group col-md-12">
                                                                          <label>اندازه فیلد</label>
                                                                          <input type="text" name="field_length" value="" placeholder="اندازه فیلد"
                                                                                 class="form-control" v-model="field_length">
                                                                        </div>-->
                                                <!--                        <div class="form-group col-md-12">
                                                                          <label>مقدار پیش فرض</label>
                                                                          <i class="fas fa-flag-checkered pull-right" title="This field is translatable."></i>
                                                                          <input type="text" name="field_default_value" value="" placeholder="مقدار پیش فرض"
                                                                                 class="form-control" v-model="field_default_value">
                                                                        </div>-->


                                                <div class="form-group col-md-12">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="hidden" name="field_required" value="0"
                                                                   v-model="field_required">
                                                            <input type="checkbox" value="1" name="field_required"
                                                                   v-model="field_required"> اجباری
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="hidden" name="field_filter" value="0"
                                                                   v-model="field_filter">
                                                            <input type="checkbox" value="1" name="field_filter"
                                                                   v-model="field_filter"> قابل فیلتر
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="hidden" name="field_active" value="0"
                                                                   v-model="field_active">
                                                            <input type="checkbox" value="1" name="field_active"
                                                                   v-model="field_active"> فعال
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <button type="submit"
                                                    @click.prevent="FieldStored()"
                                                    :disabled="$v.$invalid"
                                                    class="btn btn-primary waves-effect waves-light">
                                                ثبت اطلاعات
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Multiselect from 'vue-multiselect';
    import "vue-multiselect/dist/vue-multiselect.min.css";
    import "vue-multiselect/dist/vue-multiselect.min";
    import {required, maxLength, integer, helpers} from "vuelidate/lib/validators";
    import Vue from "vue";

    export default {
        data() {
            return {
                'field_name': '',
                'field_type': '',
                //'field_model': '',
                //'field_length': '',
                //'field_default_value': '',
                'field_required': '',
                'field_filter': '',
                'field_active': '',
                'field_help': '',
                bases: {},
                classes: [],
                base_id: '',
                class_id: [],
                check_class_public: true
            }
        },
        methods: {
            fetchAllBases() {
                Vue.http.get('api/get-bases-list').then(response => {
                    this.bases = response.body;
                });
            },

            FieldStored() {
                const field = {
                    'field_name': this.field_name,
                    'field_type': this.field_type,
                    'field_required': this.field_required,
                    'field_filter': this.field_filter,
                    'field_active': this.field_active,
                    'field_help': this.field_help,
                    'class_list': this.class_id,
                    'check_class_public':this.check_class_public
                }
                Vue.http.post("api/admin/field/store", field)
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
                        this.$router.push({name: 'Fields'});
                    }).catch(error => {
                    console.log(error);
                });
            }
        },

        created() {
            this.fetchAllBases();
        },

        watch: {
            base_id: function (value) {
                Vue.http.get('api/get-class-list/' + this.base_id).then(response => {
                    this.classes = response.body;
                }).catch(error => {
                    console.log(error);
                })
            }
        },

        components: {
            Multiselect
        },

        validations: {
            field_name: {
                required,
                maxLength: maxLength(100),
            },
            field_type: {
                required,
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
