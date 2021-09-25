<template>
  <div>
    <div
      class="modal fade azmoon-classes"
      tabindex="-1"
      role="dialog"
      aria-labelledby="azmoon-classes-selected"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title mt-0" id="azmoon-classes-selected">
              کلاس های انتخابی آزمون
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
            <div class="row col-md-12">
               <div class="col-md-12 m-3 border p-3 mb-3 bg-white shadow-lg">
                    <h4 class="header-title pb-3">افزودن کلاس</h4>
                    <div class="form-group col-md-12">
                      <label>پایه آموزشی</label>
                      <select
                        name="base_id"
                        class="form-control"
                        v-model="base_id"
                      >
                        <option value="" disabled>لطفا انتخاب کنید!</option>
                        <option
                          v-for="base in bases"
                          :key="base.id"
                          :value="base.id"
                        >
                          {{ base.base_title }}
                        </option>
                      </select>
                    </div>
                    <div class="form-group col-md-12">
                      <label class="typo__label">لیست کلاس ها</label>
                      <multiselect
                        dir="rtl"
                        v-model="class_list"
                        :options="classes"
                        :multiple="true"
                        :close-on-select="false"
                        :clear-on-select="false"
                        :preserve-search="true"
                        noOptions="false"
                        placeholder="لطفا انتخاب کنید"
                        label="class_title"
                        track-by="class_title"
                        :preselect-first="true"
                      >
                        <template
                          slot="selection"
                          slot-scope="{ values, search, isOpen }"
                        >
                          <span
                            class="multiselect__single text-right"
                            style="text-align: right !important"
                            v-if="values.length &amp;&amp; !isOpen"
                            >{{ values.length }} کلاس های انتخاب شده:</span
                          >
                        </template>
                      </multiselect>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <button @click="updateClassList()" class="btn btn-info btn-sm">ثبت کلاس</button>
                        </div>
                    </div>
                  </div>
            </div>
            <div class="row">
              <div class="table-responsive">
                <table class="table mb-0">
                  <thead>
                    <tr>
                      <th>کلاس</th>
                      <th>پایه</th>
                      <th>تنظیمات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(class_obj, index) in azmoon_classes"
                      :key="class_obj.id"
                    >
                      <td>{{ class_obj.class_title }}</td>
                      <td>{{ class_obj.base_title }}</td>

                      <td>
                        <button
                          @click.prevent="destroyclass_obj(class_obj.id, index)"
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
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
</template>

<script>
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.min.css";
import "vue-multiselect/dist/vue-multiselect.min";
export default {
  props: {
      azmoonId:{}
  },
  data() {
    return {
      azmoon_classes: {},

      bases: {},
      classes: [],
      base_id: "",
      class_list: [],
    };
  }, // end data

  methods: {
    fetchAzmoonClasses() {
      Vue.http
        .get("api/admin/azmoon-classes/" + this.azmoonId)
        .then((response) => {
         // console.log(response);
          this.azmoon_classes = response.body.classes;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    destroyclass_obj(azmoon_class_id, index) {
      Swal.fire({
        title: "آیا مطمئن هستید؟",
        text: "کلاس مورد نظر از آزمون غیر قابل برگشت خواهد بود!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "بله حذف شود",
        confirmButtonColor: "red",
        cancelButtonText: "نه! دستم اشتباهی خورد",
        showCloseButton: true,
        customClass: "swal2-popup",
      }).then((result) => {
        if (result.value) {
          Vue.http
            .delete("api/admin/azmoon-class/delete/" + azmoon_class_id)
            .then((response) => {
              this.fetchAzmoonClasses();
              if (response.status === 200) {
                Swal.fire(
                  "حذف شد!",
                  "اطلاعات آزمون با موفقیت حذف گردید!",
                  "success"
                );
              }
            })
            .catch((error) => {
              console.log(error);
            });
        } else {
          Swal.fire("کنسل شد", "آزمون مورد نظر هنوز سالم است", "info");
        }
      });
    },

    fetchAllBases() {
      Vue.http.get("api/get-bases-list").then((response) => {
        this.bases = response.body;
      });
    },

    updateClassList(){
        const form = {
            'azmoon_id':this.azmoonId,
            'class_list':this.class_list
        }
        Vue.http.post('api/admin/azmoon-classlist-update',form)
        .then(response=>{
            Swal.fire({
                icon:'success',
                title:'خیلی عالی',
                text:"با موفقیت ثبت گردید!"
            })
            this.fetchAzmoonClasses();
        }).catch(error=>{
            console.log(error);
        })
    },
  }, // end methods

  watch: {
    base_id: function (value) {
      Vue.http
        .get("api/get-class-list/" + this.base_id)
        .then((response) => {
          this.classes = response.body;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  }, // end watch

  created() {
    this.fetchAzmoonClasses();
    this.fetchAllBases();
  }, // end created

  components: {
    Multiselect,
  },
};
</script>
