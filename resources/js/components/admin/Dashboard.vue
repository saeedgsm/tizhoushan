<template>
  <div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h4 class="page-title mb-1">داشبرد مدیریت</h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active">به پنل مدیریت خوش آمدید</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div class="card-block">
                  <div class="media">
                    <div class="media-body text-xs-left">
                      <h3 class="pink">{{ studentCount }}</h3>
                      <span>کل دانش آموزان </span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="uim uim-circle-layer icons-large"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
           <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div class="card-block">
                  <div class="media">
                    <div class="media-body text-xs-left">
                      <h3 class="teal">{{  register_last_month }}</h3>
                      <span> تعداد ثبت نام یک ماه اخیر </span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="dripicons dripicons-graph-line icons-medium"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div class="card-block">
                  <div class="media">
                    <div class="media-body text-xs-left">
                      <h3 class="pink">{{ activeAzmoonCount }}</h3>
                      <span>تعداد آزمون فعال</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="uim uim-check-circle icons-large"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div class="card-block">
                  <div class="media">
                    <div class="media-body text-xs-left">
                      <h3 class="deep-orange">0</h3>

                      <span>کلاس های آنلاین</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="uil uil-invoice icons-large"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <div class="float-right ml-2">
                  <router-link :to="{name : 'Azmoons'}">همه آزمون ها</router-link>
                </div>
                <h5 class="header-title mb-4">آزمون های فعال</h5>

                <div class="table-responsive">
                  <table class="table table-centered table-hover mb-0">
                    <thead>
                      <tr>
                        <th scope="col">عنوان</th>
                        <th scope="col">زمان شروع</th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="azmoon in azmoons" :key="azmoon.id">
                        <td>

                          <router-link
                            :to="{
                              name: 'AzmoonShow',
                              params: { id: azmoon.id },
                            }"
                            class="btn btn-outline-info btn-sm"
                            title="مشاهده جزئیات آزمون"
                          >
                            <i class="ti-eye"></i>
                            <b>{{ azmoon.azmoon_title }}</b>
                          </router-link>
                        </td>
                        <td>{{ azmoon.start_date }}</td>

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
  name: "Dashboard",
  data() {
    return {
      studentCount: 0,
      register_last_month: 0,
      activeAzmoonCount: 0,
      azmoons: [],
    };
  },
  methods: {
    getDashboardInfo() {
      Vue.http.get("api/admin/dashboard/info").then(
        (response) => {
          let dashboard_info = response.data;
          this.studentCount = dashboard_info.student_count;
          this.activeAzmoonCount = dashboard_info.azmoon_count;
          this.register_last_month = dashboard_info.register_last_month;
          this.azmoons = dashboard_info.azmoons;
        },
        (error) => {
          console.log(error);
        }
      );
    },
  },
  created() {
    this.getDashboardInfo();
    console.log( document.documentElement.lang.substr(0, 2))
  },
};
</script>

<style scoped>
</style>
