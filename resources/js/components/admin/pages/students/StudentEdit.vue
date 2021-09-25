<template>
    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">دانش آموزان</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">ثبت نام دانش آموز</li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right">
                            <router-link :to="{name : 'ActiveCourseStudents'}" class="btn btn-light btn-rounded">
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
                                <h4 class="header-title">ثبت نام دانش آموز</h4>
                                <div class="row">
                                    <div class="col-lg-12 mt-5">
                                        <h4 class="form-section"><i class="mdi mdi-account"></i>پایه و کلاس های آموزشی
                                        </h4>
                                        <hr>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="base_id">پایه آموزشی </label>
                                        <select name="base_id" id="base_id" class="form-control" v-model="base_id">
                                            <option disabled>لطفا انتخاب کنید!</option>
                                            <option v-for="base in bases" :value="base.id">{{ base.base_title }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="class_id">عنوان کلاس</label>
                                        <select name="class_id" id="class_id" class="form-control" v-model="class_id">
                                            <option disabled>لطفا انتخاب کنید!</option>
                                            <option v-for="class_item in classes" :value="class_item.id">{{
                                                class_item.class_title }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div id="user">
                                    <div class="col-lg-12 mt-5">
                                        <h4 class="form-section"><i class="mdi mdi-account"></i>اطلاعات اصلی</h4>
                                        <hr>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="first_name">نام </label>
                                                <input id="first_name" type="text"
                                                       class="form-control"
                                                       v-model="first_name"
                                                       name="first_name"
                                                       placeholder="نام را وارد کنید"
                                                       :class="{invalid:$v.first_name.$error}"
                                                       @input="$v.first_name.$touch()">
                                                <p class="text-danger"
                                                   v-if="! $v.first_name.required && $v.first_name.$dirty">لطفا نام
                                                    دانش آموز
                                                    را وارد کنید!</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="last_name">نام خانوادگی</label>
                                                <input id="last_name" type="text"
                                                       class="form-control"
                                                       name="last_name" value=""
                                                       v-model="last_name"
                                                       placeholder="نام خانوادگی را وارد کنید"
                                                       :class="{invalid:$v.last_name.$error}"
                                                       @input="$v.last_name.$touch()">
                                                <p class="text-danger"
                                                   v-if="! $v.last_name.required && $v.last_name.$dirty">لطفا نام
                                                    خانوادگی
                                                    دانش آموز
                                                    را وارد کنید!</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label
                                                    for="phone"><span>موبایل فعلی</span></label>
                                                <input id="phone" type="text"
                                                       class="form-control "
                                                       name="phone" value=""
                                                       placeholder="موبایل را وارد کنید"
                                                       v-model="phone"
                                                       :class="{invalid:$v.phone.$error}"
                                                       @input="$v.phone.$touch()">

                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label
                                                    for="usercode"><span>کد کاربری</span></label>
                                                <input id="usercode" type="text"
                                                       class="form-control "
                                                       name="usercode"
                                                       placeholder="کد کاربری را وارد کنید"
                                                       v-model="usercode"
                                                       :class="{invalid:$v.usercode.$error}"
                                                       @input="$v.usercode.$touch()">

                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="password">رمز عبور </label>
                                                <input id="password" type="text"
                                                       class="form-control"
                                                       v-model="password"
                                                       name="password"
                                                       placeholder="رمز عبور را وارد کنید"
                                                       :class="{invalid:$v.password.$error}"
                                                       @input="$v.password.$touch()">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="state">استان </label>
                                                <select autofocus class="form-control " name="state_id" id="state"
                                                        v-model="state_id">
                                                    <option value="">لطفا انتخاب کنید!</option>
                                                    <option v-for="state in states" :value="state.id">{{ state.name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="city_id">شهر </label>
                                                <select autofocus class="form-control" v-model="city_id" name="city_id"
                                                        id="city_id">
                                                    <option value="">لطفا انتخاب کنید!</option>
                                                    <option v-for="city in cities" :value="city.id">{{ city.name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-4">
                                        <button type="submit"
                                                @click.prevent="UpdateStudent()"

                                                class="btn btn-primary waves-effect waves-light">
                                            ویرایش اطلاعات
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
    import {minLength,maxLength, required , integer} from "vuelidate/lib/validators";
    export default {
        name: "StudentEdit",

        data() {
            return {
                user_id: '',
                first_name: '',
                last_name: '',
                phone: '',
                usercode: '',
                bases: '',
                base_id: '',
                classes: '',
                class_id: '',
                states: {},
                state_id: '',
                cities: {},
                city_id: '',
                password: '',
                checkedPhone:'',
                checkedUsercode:'',
            }
        },

        methods: {
            fetchStudentShow(userId) {
                Vue.http.get('api/admin/student-edit/' + userId).then(response => {
                    this.user_id = response.data.user_id;
                    this.first_name = response.data.first_name;
                    this.last_name = response.data.last_name;
                    this.phone = response.data.phone;
                    this.usercode = response.data.usercode;
                    this.base_id = response.data.base_id;
                    this.class_id = response.data.class_id;
                    this.state_id = response.data.state_id;
                    this.city_id = response.data.city_id;
                }).catch(error => {
                    console.log(error);
                })
            },

            fetchAllStates() {
                Vue.http.get('api/get-states-list').then(response => {
                    this.states = response.body;
                });
            },

            fetchAllBases() {
                Vue.http.get('api/get-bases-list').then(response => {
                    this.bases = response.body;
                });
            },

            UpdateStudent() {
                const fields = {
                    'user_id': this.user_id,
                    'first_name': this.first_name,
                    'last_name': this.last_name,
                    'phone': this.phone,
                    'usercode': this.usercode,
                    'base_id': this.base_id,
                    'class_id': this.class_id,
                    'state_id': this.state_id,
                    'city_id': this.city_id,
                    'password': this.password,
                };
                Vue.http.post('api/admin/student-update', fields)
                    .then(response => {
                         Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'اطلاعات با موفقیت ویرایش گردید!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push({name: 'ActiveCourseStudents'});
                    }).catch(error => {
                    console.log(error);
                })
            },

            checkPhone(val){
                let field = {
                    'check_phone':val,
                    'user_id':this.user_id
                }
                Vue.http.post('api/admin/check-student-phone',field)
                .then(response=>{
                   // console.log(response);
                    this.checkedPhone = response.body
                   //
                }).catch(error=>{
                    console.log(error);
                })
            },

            checkUsercode(val){
                let field = {
                    'check_usercode':val,
                    'user_id':this.user_id
                }
                Vue.http.post('api/admin/check-student-usercode',field)
                .then(response=>{

                    this.checkedUsercode = response.body

                }).catch(error=>{
                    console.log(error);
                })
            },
        },

        watch: {
            state_id: function (value) {
                Vue.http.get('api/get-city-list/' + this.state_id).then(response => {
                    this.cities = response.body;
                }).catch(error => {
                    console.log(error);
                })
            },

            base_id: function (value) {
                Vue.http.get('api/get-class-list/' + this.base_id).then(response => {
                    this.classes = response.body;
                }).catch(error => {
                    console.log(error);
                })
            }
        },

        created() {
            this.fetchAllStates();
            this.fetchStudentShow(this.$route.params.id);
            this.fetchAllBases();
        },

        computed:{
            CheckUnique(){
                console.log(this.phone);
            }
        },

        validations: {
            base_id: {
                required,
            },
            class_id: {
                required,
            },
            first_name: {
                required,
                maxLength: maxLength(100),
            },
            last_name: {
                required,
                maxLength: maxLength(100),
            },
            phone: {
                //required,
                async unique (val){
                    //console.log(val.length);
                    if(val.length === 11){
                        this.checkPhone(val);
                        return this.checkedPhone;
                    }
                }
            },
            usercode: {
                integer,
                minLength: minLength(5),
                async unique (val){
                    this.checkUsercode(val);
                        return this.checkedUsercode;
                }
            },
            password: {}
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
