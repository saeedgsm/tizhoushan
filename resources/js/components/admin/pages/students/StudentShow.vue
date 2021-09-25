<template>
  <div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-4">
            <h4 class="page-title mb-1">اطلاعات دانش آموز</h4>
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
          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <h1 class="header-title">اطلاعات کاربری دانش آموز</h1>
                <!-- Nav tabs -->
                <ul
                  class="nav nav-tabs nav-justified nav-tabs-custom"
                  role="tablist"
                >
                  <li class="nav-item">
                    <a
                      class="nav-link active"
                      data-toggle="tab"
                      href="#custom-profile"
                      role="tab"
                      aria-selected="true"
                    >
                      <i class="fas fa-user mr-1 align-middle"></i>
                      <span class="d-none d-md-inline-block"></span>
                    </a>
                  </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3">
                  <div
                    class="tab-pane active"
                    id="custom-profile"
                    role="tabpanel"
                  >
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <a
                                href=""
                                itemprop="contentUrl"
                                data-size="480x360"
                              >
                                <img
                                  width="250"
                                  class="img-thumbnail"
                                  :src="avatar"
                                  alt="Image description"
                                />
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-8 text-xs-center text-md-left">
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <td>نام کامل</td>
                                  <td class="text-xs-right">
                                    <b>{{ first_name }} </b>
                                    <b>{{ last_name }}</b>
                                  </td>
                                </tr>
                                <tr>
                                  <td>کد کاربری</td>
                                  <td class="text-xs-right">
                                    <b>{{ usercode }}</b>
                                  </td>
                                </tr>
                                <tr>
                                  <td>رمز عبور</td>
                                  <td class="text-xs-right">
                                    <b>{{ userpass }}</b>
                                  </td>
                                </tr>
                                <tr>
                                  <td>موبایل</td>
                                  <td class="text-xs-right">
                                    <b>{{ phone }}</b>
                                  </td>
                                </tr>

                                <tr>
                                  <td>پایه</td>
                                  <td class="text-xs-right">
                                    <b>{{ base_name }}</b>
                                  </td>
                                </tr>
                                <tr>
                                  <td>کلاس</td>
                                  <td class="text-xs-right">
                                    <b>{{ class_name }}</b>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "StudentShow",

  data() {
    return {
      first_name: "",
      last_name: "",
      usercode: "",
      userpass: "",
      email: "",
      phone: "",
      class_name: "",
      base_name: "",
      avatar: "",
      publicPath: process.env.BASE_URL,
    };
  },

  methods: {
    fetchStudentShow(userId) {
      Vue.http
        .get("api/admin/student-show/" + userId)
        .then((response) => {
          this.first_name = response.data.first_name;
          this.last_name = response.data.last_name;
          this.usercode = response.data.usercode;
          this.userpass = response.data.userpass;
          this.phone = response.data.phone;
          this.class_name = response.data.class_name;
          this.base_name = response.data.base_name;
          this.avatar =
            window.location.protocol +
            "//" +
            window.location.host +
            "/" +
            response.data.avatar;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  created() {
    this.fetchStudentShow(this.$route.params.id);
  },
};
</script>

<style scoped>
</style>
