<template>
  <div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h4 class="page-title mb-1">پایه های آموزشی</h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active">جزئیات پایه آموزشی و کلاس های آموزشی مربوطه </li>
            </ol>
          </div>
          <div class="col-md-4">
            <div class="float-right">
              <router-link :to="{name:'CourseClassCreate',params:{id:this.$route.params.id}}" class="btn btn-light btn-rounded"><i class="dripicons-plus mr-1"></i>
                <b>افزودن کلاس </b>
              </router-link>
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
                <h4 class="header-title">مشاهده جزئیات پایه آموزشی</h4>
                <p class="card-title-desc">

                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h4 class="header-title">مشاهده لیست کلاس های آموزشی </h4>
                <p class="card-title-desc">

                </p>

                <div class="table-responsive">
                  <table class="table mb-0">
                    <thead>
                    <tr>
                      <th>کلاس </th>
                      <th>پایه </th>
                      <th> ثبت نام</th>
                      <th>تنظیمات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(course,index) in courseClasses" :key="course.id">
                      <td>{{ course.class_name }}</td>
                      <td>{{ course.base_name }}</td>
                      <td>{{ course.registrable === 1 ? 'فعال' : 'غیر فعال' }}</td>
                      <td>
                        <div class="btn-group btn-sm">
                          <button
                              @click.prevent="destroyCourse(course.id,index)"
                              class="btn btn-danger ">
                            <i class="dripicons dripicons-document-delete"></i>
                            <b>حذف</b>
                          </button>
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
  </div>
</template>

<script>


export default {
  name: "CourseClasses",
  data() {
    return {
      courseClasses: []
    }
  },

  methods:{
    getCourseClasses(courseId){
      Vue.http.get('api/admin/course/classes/'+courseId).then(response=>{
        this.courseClasses = response.body;
      }).catch(error=>{
        console.log(error);
      });
    },

    destroyCourse(id,index){
         Swal.fire({
            title: 'آیا مطمئن هستید؟',
            text: 'کلاس مورد نظر از دوره حذف شود؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'بله حذف شود',
            confirmButtonColor:'red',
            cancelButtonText: 'نه! دستم اشتباهی خورد',
            showCloseButton: true,
            customClass: 'swal2-popup',
        }).then((result) => {
            if(result.value) {
                Vue.http.delete('api/admin/course-class/delete/' + id).then(response => {
                    if (response.status === 200) {
                        this.courseClasses.splice(index, 1);
                    }
                }, error => {
                    console.log(error);
                });
                 Swal.fire('حذف شد!', 'کلاس از دوره با موفقیت حذف گردید!', 'success');
            } else {
                 Swal.fire('کنسل شد', 'کلاس مورد نظر هنوز سالم است', 'info')
            }
        })
    }
  },

  created() {
    this.getCourseClasses(this.$route.params.id);
  }
}
</script>

<style scoped>

</style>
