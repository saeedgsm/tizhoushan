<template>
    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">ارسال پیامک گروهی</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">پیامک برحسب کلاس های آموزشی ارسال می شود.</li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right d-md-block">
                            <router-link :to="{name : 'Dashboard'}" class="btn btn-light btn-rounded">
                                <i class="dripicons-arrow-left mr-1"></i>
                                <strong>برگشت</strong>
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
                                <h4 class="header-title">فرم ارسال پیامک گروهی </h4>
                                <p class="card-title-desc"></p>

                                <form class="needs-validation" novalidate="">
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
                                        <div class="form-group col-md-12">
                                            <label>متن پیامک</label>
                                            <i class="fas fa-flag-checkered pull-right"
                                               title="This field is translatable."></i>
                                            <input type="text" name="field_help" value=""
                                                   placeholder="متن پیامک را وارد کنید!"
                                                   class="form-control" v-model="message"
                                                   :class="{invalid:$v.message.$error}"
                                                   @input="$v.message.$touch()">
                                            <p class="text-danger"
                                               v-if="! $v.message.required && $v.message.$dirty">لطفا متن پیامک
                                                را وارد کنید!</p>
                                            <p class="text-danger" v-if="! $v.message.maxLength">
                                                متن پیامک نمی تواند بیشتر از
                                                {{ $v.message.$params.maxLength }}
                                                کاراکتر باشد!</p>
                                            <p class="text-danger" v-if="! $v.message.minLength">
                                                متن پیامک نمی تواند بیشتر از
                                                {{ $v.message.$params.minLength }}
                                                کاراکتر باشد!</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <button type="submit"
                                                @click.prevent="sendMessage()"
                                                :disabled="$v.$invalid"
                                                class="btn btn-primary waves-effect waves-light">
                                            ثبت اطلاعات
                                        </button>
                                    </div>
                                </form>
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
import Multiselect from "vue-multiselect";
import {minLength, maxLength, required} from "vuelidate/lib/validators";

export default {
    name: "SMSGroupClasses",

    data(){
        return {
            bases: {},
            classes: [],
            base_id: '',
            class_id: [],
            message:''
        }
    },

    methods:{
        fetchAllBases() {
            Vue.http.get('api/get-bases-list').then(response => {
                this.bases = response.body;
            });
        },

        sendMessage(){
            console.log(this.message,this.class_id)
            const field = {
                'message' : this.message,
                'classes' : this.class_id,
            }
            Vue.http.post('api/admin/send-sms-group',field).then(response=>{
                console.log(response);
            }).catch(error=>{
                console.log(error);
            })
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
        message: {
            required,
            maxLength: maxLength(191),
            minLength: minLength(5)
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
