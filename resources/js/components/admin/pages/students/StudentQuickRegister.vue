<template>
  <div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-4">
            <h4 class="page-title mb-1">ثبت نام سریع دانش آموز</h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active"></li>
            </ol>
          </div>
          <div class="col-md-8">
            <div class="float-right d-md-block">
              <router-link
                :to="{ name: 'Students' }"
                class="btn btn-light btn-rounded"
              >
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
                <h4 class="header-title">ثبت نام سریع دانش آموز</h4>
                <div class="row">
                  <div class="col-lg-12 mt-5">
                    <h4 class="form-section">
                      <i class="mdi mdi-account"></i>پایه و کلاس های آموزشی
                    </h4>
                    <hr />
                  </div>
                  <div class="form-group col-md-6">
                    <label for="base_id">پایه آموزشی</label>
                    <select
                      name="base_id"
                      id="base_id"
                      class="form-control"
                      v-model="base_id"
                    >
                      <option :selected="true">لطفا انتخاب کنید!</option>
                      <option
                        v-for="base in bases"
                        :v-key="base.id"
                        :value="base.id"
                        :key="base.id"
                      >
                        {{ base.base_title }}
                      </option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="class_id" class="typo__label"
                      >لیست کلاس ها</label
                    >
                    <select
                      name="class_id"
                      id="class_id"
                      class="form-control"
                      v-model="class_id"
                    >
                      <option selected disabled>لطفا انتخاب کنید</option>
                      <option
                        v-for="class_obj in classes"
                        :v-key="class_obj.id"
                        :value="class_obj.id"
                        :key="class_obj.id"
                      >
                        {{ class_obj.class_title }}
                      </option>
                    </select>
                  </div>
                </div>
                <div id="user">
                  <div class="col-lg-12 mt-5">
                    <h4 class="form-section">
                      <i class="mdi mdi-account"></i>اطلاعات اصلی
                    </h4>
                    <hr />
                  </div>

                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="first_name">نام </label>
                        <input
                          id="first_name"
                          type="text"
                          class="form-control"
                          v-model="first_name"
                          name="first_name"
                          placeholder="نام را وارد کنید"
                          :class="{ invalid: $v.first_name.$error }"
                          @input="$v.first_name.$touch()"
                        />
                        <p
                          class="text-danger"
                          v-if="!$v.first_name.required && $v.first_name.$dirty"
                        >
                          لطفا نام دانش آموز را وارد کنید!
                        </p>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="last_name">نام خانوادگی</label>
                        <input
                          id="last_name"
                          type="text"
                          class="form-control"
                          name="last_name"
                          value=""
                          v-model="last_name"
                          placeholder="نام خانوادگی را وارد کنید"
                          :class="{ invalid: $v.last_name.$error }"
                          @input="$v.last_name.$touch()"
                        />
                        <p
                          class="text-danger"
                          v-if="!$v.last_name.required && $v.last_name.$dirty"
                        >
                          لطفا نام خانوادگی دانش آموز را وارد کنید!
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="checkbox">
                        <h6>نوع پرداخت</h6>
                        <label>
                          <input
                            type="hidden"
                            name="type_payment"
                            value="online"
                            checked
                            v-model="type_payment"
                          />
                          <input
                            type="checkbox"
                            value="in-person"
                            name="type_payment"
                            v-model="type_payment"
                          />
                          پرداخت حضوری
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="usercode"><span>کد کاربری</span></label>
                        <input
                          id="usercode"
                          type="text"
                          class="form-control"
                          name="usercode"
                          placeholder="کد کاربری را وارد کنید"
                          v-model="usercode"
                          :class="{ invalid: $v.usercode.$error }"
                          @input="$v.usercode.$touch()"
                        />
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="password">رمز عبور </label>
                        <input
                          id="password"
                          type="text"
                          class="form-control"
                          v-model="password"
                          name="password"
                          placeholder="رمز عبور را وارد کنید"
                          :class="{ invalid: $v.password.$error }"
                          @input="$v.password.$touch()"
                        />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 mt-4">
                    <button
                      type="submit"
                      @click.prevent="RegisterStudent()"
                      :disabled="$v.$invalid"
                      class="btn btn-primary waves-effect waves-light"
                    >
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
import {
  maxLength,
  minLength,
  required,
  integer,
} from "vuelidate/lib/validators";

export default {
  name: "StudentQuickRegister",

  data() {
    return {
      bases: [],
      base_id: "",
      classes: [],
      class_id: "",
      type_payment: "",
      first_name: "",
      last_name: "",
      usercode: "",
      password: "",
    };
  },

  methods: {
    fetchAllBases() {
      Vue.http.get("api/get-bases-list").then((response) => {
        this.bases = response.body;
      });
    },

    RegisterStudent() {
      const fields = {
        base_id: this.base_id,
        class_id: this.class_id,
        first_name: this.first_name,
        last_name: this.last_name,
        usercode: this.usercode,
        password: this.password,
        type_payment: this.type_payment,
      };
      Vue.http
        .post("api/admin/student-quick-register", fields)
        .then((response) => {
          Swal.fire({
            position: "top-center",
            icon: "success",
            title: "اطلاعات دانش آموز با موفقیت ثبت گردید!",
            showConfirmButton: false,
            timer: 1500,
          });
          this.$router.push({
            name: "StudentShow",
            params: { id: response.data.id },
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },

    checkUsercode(val) {
      let field = {
        check_usercode: val,
        user_id: this.user_id,
      };
      Vue.http
        .post("api/admin/check-student-usercode", field)
        .then((response) => {
          // console.log(response);
          this.checkedUsercode = response.body;
          //
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  watch: {
    base_id: function (value) {
      Vue.http
        .get("api/get-class-list/" + this.base_id)
        .then((response) => {
          this.classes = response.body;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  created() {
    this.fetchAllBases();
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
    usercode: {
      integer,
      minLength: minLength(4),
      async unique(val) {
        this.checkUsercode(val);
        return this.checkedUsercode;
      },
    },
    password: {},
  },
};
</script>

<style scoped>
.invalid {
  border: 1px solid red;
  box-shadow: 0 0 5px red;
  background-color: lightpink;
}
</style>
