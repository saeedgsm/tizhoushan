<template>
  <div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-4">
            <h4 class="page-title mb-1">
              کلاس های پایه آموزشی
              <span class="text-danger">{{ base.base_title }}</span>
            </h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active">
                جزئیات پایه آموزشی و کلاس های آموزشی مربوطه
              </li>
            </ol>
          </div>
          <div class="col-md-8">
            <div class="float-right d-md-block">

              <button
                type="button"
                @click="openModalWindow"
                class="btn btn-light btn-rounded btn-sm"
                data-toggle="modal"
                data-target=".education-class-add"
              >
                <i class="dripicons-plus mr-1"></i>
                افزودن کلاس آموزشی
              </button>
              <router-link :to="{name : 'AllBases'}"
              class="btn btn-light btn-rounded btn-sm">
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
                <h4 class="header-title">مشاهده لیست کلاس های آموزشی</h4>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>عنوان کلاس</th>
                        <th>تعداد دانش آموز</th>
                        <th>ثبت نام</th>
                        <th>تنظیمات</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(edu_class, index) in classes"
                        :key="edu_class.id"
                      >
                        <td>{{ edu_class.class_title }}</td>
                        <td>{{ edu_class.student_count }}</td>

                        <td>
                          <b v-if="edu_class.registrable === 1">فعال</b>
                          <b v-else>غیر فعال</b>

                        </td>
                        <td>
                          <div class="btn btn-group-lg">
                            <div class="btn-group btn-group-sm">

                              <a
                                href="#"
                                class="btn btn-warning btn-sm"
                                data-toggle="modal"
                                data-target=".education-class-add"
                                title="ویرایش "
                                @click="editModalWindow(edu_class)"
                              >
                                <i class="ti-pencil-alt"></i>
                                <b>ویرایش</b>
                              </a>
                              <button
                                @click.prevent="
                                  destroyClass(edu_class.id, index)
                                "
                                class="btn btn-danger btn-sm"
                              >
                                <i
                                  class="dripicons dripicons-document-delete"
                                ></i>
                                <b>حذف</b>
                              </button>
                            </div>
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

    <div
      class="modal fade education-class-add"
      tabindex="-1"
      role="dialog"
      aria-labelledby="my-edu-class-add"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              v-show="!editMode"
              class="modal-title mt-0"
              id="my-edu-class-add"
            >
              فرم افزودن کلاس
            </h5>
            <h5
              v-show="editMode"
              class="modal-title mt-0"
              id="my-edu-class-add"
            >
              فرم ویرایش کلاس
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="class_title">عنوان کلاس</label>
                <input
                  type="text"
                  class="form-control"
                  name="class_title"
                  v-model="form.class_title"
                  id="class_title"
                  placeholder="عنوان کلاس را وارد کنید"
                />
              </div>
              <div class="col-md-4 mb-3">
                <label for="class_label">لیبل کلاس</label>
                <input
                  type="text"
                  class="form-control"
                  name="class_label"
                  v-model="form.class_label"
                  id="class_label"
                  placeholder="لیبل کلاس را وارد کنید"
                />
              </div>
              <div class="form-group col-md-12">
                <div class="checkbox">
                  <label>وضعیت ثبت نام</label><br />
                  <label>
                    <input
                      type="hidden"
                      name="registrable"
                      value="0"
                      v-model="form.registrable"
                    />
                    <input
                      type="checkbox"
                      value="1"
                      name="registrable"
                      v-model="form.registrable"
                    />
                    فعال
                  </label>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group mt-4">
                <button
                v-show="editMode"
                  type="submit"
                  @click.prevent="baseClassUpdate()"
                  data-dismiss="modal"
                  class="btn btn-primary waves-effect waves-light"
                >
                  ویرایش
                </button>
                <button
                v-show="!editMode"
                  type="submit"
                  @click.prevent="baseClassStore()"
                  data-dismiss="modal"
                  class="btn btn-primary waves-effect waves-light"
                >
                  ثبت اطلاعات
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </div>
</template>

<script>
export default {
  name: "BaseClasses",

  data() {
    return {
      base: [],
      classes: [],

      editMode: false,

      form: new Form({
        id: "",
        class_title: "",
        class_label: "",
        base_id: this.$route.params.id,
        registrable: 0,
      }),
    };
  },

  methods: {
    fetchBase(baseId) {
      Vue.http
        .get("api/admin/base/" + baseId)
        .then((response) => {
          this.base = response.body;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    fetchBaseClasses(baseId) {
      Vue.http
        .get("api/admin/base-classes/" + baseId)
        .then((response) => {
          this.classes = response.body.classes;
         console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    baseClassStore() {
       // this.$Progress.start();
      /* const field = {
        base_id: this.$route.params.id,
        class_title: this.class_title,
        class_label: this.class_label,
        registrable: this.registrable,
      }; */

      Vue.http
        .post("api/admin/class-store", this.form)
        .then((response) => {

          Swal.fire({
            position: "top-center",
            icon: "success",
            title: "اطلاعات با موفقیت ثبت گردید!",
            showConfirmButton: false,
            timer: 1500,
          });
          this.fetchBaseClasses(this.$route.params.id);
          this.form.reset();
        //   this.$Progress.finish()
        })
        .catch((error) => {
          console.log(error);
        });
    },

    baseClassUpdate(){
          Vue.http.post('api/admin/update-class/'+this.form.id,this.form)
               .then(()=>{

                   Toast.fire({
                      icon: 'success',
                      title: 'اطلاعات با موفقیت آپدیت شد!'
                    })
 this.fetchBaseClasses(this.$route.params.id);
                   // Fire.$emit('AfterCreatedUserLoadIt');

                    $('#addNew').modal('hide');
               })
               .catch(()=>{
                  console.log("Error.....")
               })
    },

    destroyClass(id, index) {
      Swal.fire({
        title: "آیا مطمئن هستید؟",
        text: "کلاس مورد نظر شامل دانش آموز و در دوره ای احتمالا ثبت شده است!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "بله حذف شود",
        confirmButtonColor: "red",
        cancelButtonText: "نه! دستم اشتباهی خورد",
        showCloseButton: true,
        customClass: "swal2-popup",
      }).then((result) => {
        if (result.value) {
          Vue.http.delete("api/admin/class/delete/" + id).then(
            (response) => {
                console.log(response);
              this.fetchBaseClasses(this.base_id);
             Swal.fire("حذف شد!", "اطلاعات کلاس با موفقیت حذف گردید!", "success");
            },
            (error) => {
              console.log(error);
              Swal.fire('کلاس مورد نظر حذف نشد!', "error");
            }
          );

        } else {
          Swal.fire("کنسل شد", "کلاس مورد نظر هنوز سالم است", "info");
        }
      });
    },

    editModalWindow(edu_class) {
      this.form.clear();
      this.editMode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(edu_class);
      console.log(edu_class);
    },

    openModalWindow(){
           this.editMode = false
           this.form.reset();
           $('#addNew').modal('show');
        },
  },

  created() {
    this.base_id = this.$route.params.id;
    this.fetchBaseClasses(this.base_id);
    this.fetchBase(this.base_id);
  },
};
</script>

<style scoped>
</style>
