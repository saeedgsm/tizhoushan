<template>
  <div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-4">
            <h4 class="page-title mb-1">دوره ها</h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active">فرم افزودن دوره</li>
            </ol>
          </div>
          <div class="col-md-8">
            <div class="float-right d-md-block">
              <router-link :to="{name : 'Courses'}" class="btn btn-light btn-rounded">
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
                <h4 class="header-title">فرم افزودن دوره</h4>
                <p class="card-title-desc"></p>

                <form class="needs-validation" novalidate="">
                  <div class="row">
                    <div class="col-md-4 mb-3">
                      <label for="course_title">عنوان دوره</label>
                      <input type="text"
                             class="form-control"
                             v-model="course_title"
                             name="course_title"
                             id="course_title"
                             placeholder="عنوان دوره را وارد کنید"
                             :class="{invalid:$v.course_title.$error}"
                             @input="$v.course_title.$touch()">
                      <p class="text-danger" v-if="! $v.course_title.required && $v.course_title.$dirty">لطفا نام دوره
                        را وارد کنید!</p>
                      <p class="text-danger" v-if="! $v.course_title.maxLength">
                        نام دوره نمی تواند بیشتر از
                        {{ $v.course_title.$params.maxLength }}
                        کاراکتر باشد!</p>
                    </div>
                  </div>
                  <div class="form-group col-md-12">
                    <div class="checkbox">
                      <label>
                        <input type="hidden" name="status" value="0" v-model="status">
                        <input type="checkbox" value="1" name="status" v-model="status"> فعال
                      </label>
                    </div>
                  </div>
                  <div class="col-md-4 mt-4">
                    <button type="submit"
                            @click.prevent="CourseStore()"
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
import {maxLength, required} from "vuelidate/lib/validators";

export default {
  name: "CourseCreate",
  data() {
    return {
      'course_title': '',
      'status': 0,
    }
  },
  methods: {
    CourseStore() {
      const field = {
        'course_title': this.course_title,
        'status': this.status,
      }
      Vue.http.post('api/admin/course/store', field).then(response => {
           Swal.fire({
              position: 'top-center',
              icon: 'success',
              title: 'اطلاعات با موفقیت ثبت گردید!',
              showConfirmButton: false,
              timer: 1500
          });
        this.$router.push({name: 'Courses'});
      }).catch(error => {
        console.log(error);
      });
    }
  },
  validations: {
    course_title: {
      required,
      maxLength: maxLength(100),
    },
  }
}
</script>

<style scoped>
.invalid {
  border: 1px solid red;
  box-shadow: 0 0 5px red;
  background-color: lightpink;
}
</style>
