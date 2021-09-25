<template>
  <div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-4">
            <h4 class="page-title mb-1">وارد کردن لیست اکسل دانش آموزان</h4>
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
                <h4 class="header-title">فرم ورودی اکسل دانش آموزان</h4>
                <p class="card-title-desc"></p>

                <form class="needs-validation" novalidate="">
                  <label
                    >File
                    <input
                      type="file"
                      id="file"
                      ref="file"
                      v-on:change="handleFileUpload()"
                    />
                  </label>
                  <!--                                    <progress max="100" :value.prop="uploadPercentage"></progress>-->
                  <div class="col-md-4 mt-4">
                    <button
                      type="submit"
                      @click.prevent="submitFile()"
                      class="btn btn-primary waves-effect waves-light"
                    >
                      ثبت اطلاعات
                    </button>
                  </div>
                </form>
                <div class="row">
                  <div class="vld-parent">
                    <loading
                      :active.sync="isLoading"
                      :can-cancel="true"
                      :on-cancel="onCancel"
                      :is-full-page="fullPage"
                    ></loading>



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
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
  name: "ImportExcelStudents",

  data() {
    return {
      file: "",
      uploadPercentage: 0,
      isLoading: false,
      fullPage: true,
    };
  },

  methods: {
    submitFile() {
      this.isLoading = true;
      let formData = new FormData();
      formData.append("file", this.file);
      Vue.http
        .post("api/admin/import-student-excel", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          Swal.fire({
            position: "top-center",
            icon: "success",
            title: "اطلاعات با موفقیت ثبت گردید!",
            showConfirmButton: true,
          });
        })
        .catch((error) => {
          this.isLoading = false;
          Swal.fire({
            position: "top-center",
            icon: "error",
            title: error.body.message,
            //title: 'اطلاعات تکراری در فیلد موبایل موجود است!',
            showConfirmButton: true,
            // timer: 1500
          });
        });
    },
    handleFileUpload() {
      this.file = this.$refs.file.files[0];
    },

    doAjax() {
      this.isLoading = true;
      // simulate AJAX
      setTimeout(() => {
        this.isLoading = false;
      }, 5000);
    },
    onCancel() {
      console.log("User cancelled the loader.");
    },
  },

  components: {
    Loading,
  },
};
</script>

<style scoped>
</style>
