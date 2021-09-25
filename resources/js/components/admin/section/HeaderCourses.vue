<template>
  <div class="dropdown d-inline-block">
    <button style="border: 2px solid #4865d8;border-radius: 10px;"
            type="button" class="btn header-item waves-effect"
            id="page-header-user-dropdown" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">

      <span class=" d-sm-inline-block ml-1">دوره ها</span>
      <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
      <router-link class="dropdown-item" :to="{name:'Courses'}">
        <i class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i> همه دوره ها
      </router-link>
      <div v-for="course in courses" :key="course.id">
        <a @click.prevent="pushToCourse(this.$router)" class="dropdown-item">
          <i class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i>
          {{ course.course_title }}
        </a>
<!--        <div class="dropdown-divider"></div>
        <router-link class="dropdown-item" :to="{name:'CourseStudents',params:{id:course.id}}">
          <i class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i>
          {{ course.course_title }}
        </router-link>-->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HeaderCourses",
  data() {
    return {
      courses: {},
      courseId:''
    }
  },

  methods: {
    fetchAllHeaderCourses() {
      Vue.http.get('api/admin/courses').then(response => {
        //console.log(response);
        this.courses = response.body;
      }).catch(error => {
        console.log(error);
      })
    },

    pushToCourse(id){
      console.log(id);
     // const currentParams = this.$router.currentRoute.params;
    //  console.log( currentParams)
      //this.$router.push({name:'CourseStudents',params:{id:id}});
     // router.push({ name: 'user', params: { userId: '123' } })
    }
  },

  created() {
    console.log(this.courseId);
    this.fetchAllHeaderCourses();
  }
}
</script>

<style scoped>

</style>