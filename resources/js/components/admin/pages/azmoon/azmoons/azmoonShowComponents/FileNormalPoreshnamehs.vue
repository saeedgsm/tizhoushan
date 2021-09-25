<template>
  <div>
    <div
      class="modal fade normal-poreshnameh"
      tabindex="-1"
      role="dialog"
      aria-labelledby="normal-poreshnameh-files"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title mt-0" id="normal-poreshnameh-files">
              فایل سوالات
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
              <div class="table-responsive">
                <table class="table mb-0">
                  <thead>
                    <tr>
                      <th>عنوان</th>
                      <th>تصویر</th>

                      <th>تنظیمات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(file, index) in files" :key="file.id">
                      <td>{{ file.title  }}</td>
                      <td>
                        <a :href="file.image">فایل عکس</a>
                      </td>

                      <td>
                        <button
                          @click.prevent="destroyFile(file.id, index)"
                          class="btn btn-danger btn-sm"
                        >
                          <b>حذف</b>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group mt-4"></div>
            </div>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
</template>
<script>
export default {
  //props:{azmoonId},
  props: ["azmoonId"],

  data() {
    return {
      azmoon_id: this.azmoonId,
      files: [],
    };
  },

  methods: {
    fetchfiles() {
      Vue.http
        .get("api/admin/normal-poreshnameh-files/" + this.azmoon_id)
        .then((response) => {
          this.files = response.body.files;
        })
        .catch((error) => {
          console.log(error);
        });

    },

    destroyFile(id, index) {
      Swal.fire({
        title: "آیا مطمئن هستید؟",
        text: "فایل آزمون مورد نظر غیر قابل برگشت خواهد بود!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "بله حذف شود",
        confirmButtonColor: "red",
        cancelButtonText: "نه! دستم اشتباهی خورد",
        showCloseButton: true,
        customClass: "swal2-popup",
      }).then((result) => {
        if (result.value) {
          Vue.http.delete("api/admin/normal-poreshnameh-file/delete/" + id).then(
            response => {
              this.fetchfiles();
              if (response.status === 200) {
                  Swal.fire("حذف شد!", "اطلاعات آزمون با موفقیت حذف گردید!", "success");

              }
            }).catch(error=>{
                console.log(error);
            })

        } else {
          Swal.fire("کنسل شد", "آزمون مورد نظر هنوز سالم است", "info");
        }
      });
    },
  },

  created() {
    // console.log(this.azmoon_id);
    this.fetchfiles();
  },
};
</script>
<style>
</style>
