<template>
  <div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-4">
            <h4 class="page-title mb-1">آزمون</h4>
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item active">فرم ویرایش تاریخ آزمون</li>
            </ol>
          </div>
           <div class="col-md-8">
            <div class="float-right ">
              <router-link :to="{name : 'AzmoonShow',params: { id: this.$route.params.id },}" class="btn btn-light btn-rounded btn-sm">
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
                <h4 class="header-title">فرم ویرایش تاریخ آزمون</h4>
                <div class="row mt-3">
                     <div class="col-md-3">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                          <td>نام آزمون</td>
                          <td class="text-xs-right">
                            <b>{{ azmoonData.azmoon_title }}</b>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                          <td>شروع </td>
                          <td class="text-xs-right">
                            <b>{{ azmoonDate.start }}</b>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                          <td>پایان </td>
                          <td class="text-xs-right">
                            <b>{{ azmoonDate.end }}</b>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                          <td>طول زمان </td>
                          <td class="text-xs-right">
                            <b>{{ azmoonData.azmoon_time }} <span>دقیقه</span></b>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row justify-content-center  p-5">
 <h4 class="p-3">تاریخ جدید آزمون</h4>
                    <div class="col-lg-12">

                      <div class="row">
                        <div class="col-lg-4 mb-3">
                          <label for="azmoon_time">تاریخ شروع آزمون </label>
                          <date-picker
                            v-model="newDate.start_date"
                            name="start_date"
                            label="شروع"
                            type="datetime"
                            format="YYYY-MM-DD HH:mm:ss"
                            locale="fa"
                          ></date-picker>
                        </div>
                        <div class="col-lg-4 mb-3">
                          <label for="azmoon_time">تاریخ پایان آزمون </label>
                          <date-picker
                            v-model="newDate.end_date"
                            name="end_date"
                            label="پایان"
                            type="datetime"
                            format="YYYY-MM-DD HH:mm:ss"
                            locale="fa"
                          ></date-picker>
                        </div>
                        <div class="col-lg-4 mb-3">
                          <label for="azmoon_time">مدت آزمون به دقیقه </label>
                          <input
                            type="number"
                            autocomplete="off"
                            class="form-control"
                            name="azmoon_time"
                            id="azmoon_time"
                            title="مدت آزمون به دقیقه"
                            placeholder=""
                            v-model="newDate.azmoon_time"
                          />
                        </div>
                      </div>
                    </div>
                      <div class="col-md-4 mt-4">
                    <button
                      type="submit"
                      @click.prevent="azmoonDateUpdate(azmoonData.id)"
                      class="btn btn-primary waves-effect waves-light"
                    >
                      ثبت تاریخ جدید
                    </button>
                  </div>
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
import VuePersianDatetimePicker from "vue-persian-datetime-picker";
export default {
  name: "AzmoonDateEdit",
  data() {
    return {
      azmoonData: {},
      azmoonDate:{},
      newDate:{
          azmoon_time:1
      }
    };
  },

  methods: {
    fetchAzmoon(azmoonId) {
      Vue.http
        .get("api/admin/azmoon-date-edit/" + azmoonId)
        .then((response) => {
          this.azmoonData = response.body.azmoon;
          this.azmoonDate = response.body.azmoon_date;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    azmoonDateUpdate(azmoonId){
     // console.log(this.azmoonData,this.soal);
                const form = {
                    'azmoon_id' : azmoonId,
                    'new_date':this.newDate,
                }
                Vue.http.post('api/admin/azmoon-date-update',form)
                .then(response=>{
                    Toast.fire({
                      icon: 'success',
                      title: 'تاریخ آزمون با موفقیت آپدیت شد!'
                    })
                    this.$router.push({name: 'AzmoonShow',params :{ id :azmoonId }});
                }).catch(error=>{
                    console.log(error);
                })
    }
  },

  created() {
    this.fetchAzmoon(this.$route.params.id);
  },

  components: {
    datePicker: VuePersianDatetimePicker,
  },
};
</script>
