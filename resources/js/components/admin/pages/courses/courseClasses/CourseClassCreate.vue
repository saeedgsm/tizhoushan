<template>
  <div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-4">
            <h4 class="page-title mb-1">دوره ها</h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active">لیست دوره ها</li>
            </ol>
          </div>
          <div class="col-md-8">
            <div class="float-right d-md-block">
              <router-link :to="{name : 'CourseCreate'}" class="btn btn-light btn-rounded">
                <i class="dripicons-plus mr-1"></i>
                <strong>افزودن دوره</strong>
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
                <h4 class="header-title">لیست دوره ها</h4>
                <p class="card-title-desc"></p>

                <div class="row">
                  <div class="form-group col-md-6">
                    <label>پایه آموزشی</label>
                    <select name="base_id" class="form-control" v-model="base_id">
                      <option value="" disabled>لطفا انتخاب کنید!</option>
                      <option v-for="base in bases" :v-key="base.id" :value="base.id">{{ base.base_title}}</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="typo__label">لیست کلاس ها</label>
                    <multiselect dir="rtl" v-model="class_id" :options="classes" :multiple="true"
                                 :close-on-select="false" :clear-on-select="false" :preserve-search="true"
                                 noOptions="false" placeholder="لطفا انتخاب کنید" label="class_title"
                                 track-by="class_title" :preselect-first="true">
                      <template slot="selection" slot-scope="{ values, search, isOpen }">
                        <span  class="multiselect__single text-right" style="text-align: right !important;" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} کلاس های انتخاب شده:</span>
                      </template>
                    </multiselect>
                  </div>

                  <div class="col-md-4 mt-4">
                    <button type="submit"
                            @click.prevent="ClassStore()"
                            class="btn btn-primary waves-effect waves-light">
                      ثبت اطلاعات
                    </button>
                  </div>
                  <!--                  <div class="form-group col-md-6">
                                      <label>جدول</label>
                                      <select name="class_id" class="form-control" v-model="class_id" multiple>
                                        <option value="" disabled>لطفا انتخاب کنید!</option>
                                        <option v-for="class_item in classes" :v-key="class_item.id" :value="class_item.id" >{{ class_item.class_title}}</option>
                                      </select>
                                    </div>-->
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
import Multiselect from 'vue-multiselect';
import "vue-multiselect/dist/vue-multiselect.min.css";
import "vue-multiselect/dist/vue-multiselect.min";
export default {
  name: "CourseClassCreate",
  data() {
    return {
      bases: {},
      classes: [],
      base_id: '',
      class_id: []
    }
  },

  methods: {
    fetchAllBases() {
      Vue.http.get('api/get-bases-list').then(response => {
        this.bases = response.body;
      });
    },

    ClassStore(){
      let fields = {
        'course_id':this.$route.params.id,
        'class_list':this.class_id
      };
      Vue.http.post('api/admin/course-class/store',fields).then(response=>{
           Swal.fire({
              position: 'top-center',
              icon: 'success',
              title: 'اطلاعات با موفقیت ثبت گردید!',
              showConfirmButton: false,
              timer: 1500
          });
        this.$router.push({name: 'CourseClasses',params :{ id :this.$route.params.id }});
      }).catch(error=>{
        console.log(error);
      })
    }

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

  created() {
    //console.log(this.$route.params.id);
    this.fetchAllBases();
  },

  components: {
    Multiselect
  },
}
</script>

<style scoped>

</style>
