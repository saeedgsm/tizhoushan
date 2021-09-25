<template>
  <div>
    <div
        class="modal fade edit-book"
        tabindex="-1"
        role="dialog"
        aria-labelledby="edit-book"
        aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title mt-0" id="edit-book">فرم ویرایش کتاب</h5>
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
              {{ setSelectedBases }}
              <div class="col-md-4 mb-3">
                <label >عنوان کتاب</label>
                <input
                    type="text"
                    class="form-control"
                    name="book_name"
                    v-model="form.book_name"
                    title=""
                    placeholder="عنوان کتاب را وارد کنید"
                />
              </div>
              <div class="col-md-4 mb-3">
                <label >ضریب</label>
                <input
                    type="text"
                    class="form-control"
                    name="zarib"
                    v-model="form.zarib"
                    title=""
                    placeholder="ضریب را وارد کنید"
                />
              </div>
              <div class="col-md-4 mb-3">
                <label >نمره منفی به ازای تعداد غلط</label>
                <input
                    type="text"
                    class="form-control"
                    name="nomreh_manfi"
                    v-model="form.nomreh_manfi"
                    title=""
                    placeholder="تعداد غلط را وارد کنید"
                />
              </div>
              <div class="col-md-4 mb-3">
                <label >نمره کتاب</label>
                <input
                    type="text"
                    class="form-control"
                    name="nomreh"
                    v-model="form.nomreh"
                    title=""
                    placeholder="نمره کتاب را وارد کنید"
                />
              </div>
              <div class="form-group col-md-6">
                <label class="typo__label">پایه های آموزشی</label>
                <multiselect dir="rtl" v-model="form.bases" :options="bases" :multiple="true"
                             :close-on-select="false" :clear-on-select="false" :preserve-search="true"
                             noOptions="false" placeholder="لطفا انتخاب کنید" label="base_title"
                             track-by="base_title" :preselect-first="true">
                  <template slot="selection" slot-scope="{ values, search, isOpen }">
                    <span  class="multiselect__single text-right" style="text-align: right !important;" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} پایه های انتخاب شده:</span>
                  </template>
                </multiselect>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group mt-4">
                <button
                    type="submit"
                    @click.prevent="updateBook()"
                    data-dismiss="modal"
                    class="btn btn-primary waves-effect waves-light"
                >
                  ثبت اطلاعات
                </button>

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
  props:{
    book:{}
  },
  data() {
    return {
      bases: [],
      form : new Form({

      }) ,

    }
  },

  methods: {
    fetchAllBases(){
      Vue.http.get('api/get-bases-list')
          .then(response=>{
            // console.log(response);
            this.bases = response.body;
          }).catch(error=>{
        console.log(error);
      })
    },

    updateBook(){
      Vue.http.post('api/admin/book/update',this.form).then(response=>{
      //  console.log(response)
        Swal.fire({
          icon: 'success',
          title: 'اطلاعات با موفقیت ویرایش گردید!',
          showConfirmButton: true,
        });

      }).catch(error=>{
        console.log(error);
      })
    }
  },

  computed:{
    setSelectedBases(){
      this.form = this.book;
    }
  },

  created() {
    this.fetchAllBases();
    //console.log(this.book)

  },

  components: {
    Multiselect
  },
};
</script>
