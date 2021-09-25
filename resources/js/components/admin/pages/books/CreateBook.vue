<template>
  <div>
    <div
      class="modal fade create-book"
      tabindex="-1"
      role="dialog"
      aria-labelledby="create-book"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title mt-0" id="create-book">فرم افزودن کتاب</h5>
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
                <label for="book_name">عنوان کتاب</label>
                <input
                  type="text"
                  class="form-control"
                  name="book_name"
                  v-model="form.book_name"
                  id="book_name"
                  placeholder="عنوان کتاب را وارد کنید"
                />
              </div>
              <div class="col-md-4 mb-3">
                <label for="zarib">ضریب</label>
                <input
                  type="text"
                  class="form-control"
                  name="zarib"
                  v-model="form.zarib"
                  id="zarib"
                  placeholder="ضریب را وارد کنید"
                />
              </div>
              <div class="col-md-4 mb-3">
                <label for="nomreh_manfi">نمره منفی به ازای تعداد غلط</label>
                <input
                  type="text"
                  class="form-control"
                  name="nomreh_manfi"
                  v-model="form.nomreh_manfi"
                  id="nomreh_manfi"
                  placeholder="تعداد غلط را وارد کنید"
                />
              </div>
              <div class="col-md-4 mb-3">
                <label for="nomreh">نمره کتاب</label>
                <input
                  type="text"
                  class="form-control"
                  name="nomreh"
                  v-model="form.nomreh"
                  id="nomreh"
                  placeholder="نمره کتاب را وارد کنید"
                />
              </div>
                <div class="form-group col-md-6">
                    <label class="typo__label">پایه های آموزشی</label>
                    <multiselect dir="rtl" v-model="form.base" :options="bases" :multiple="true"
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
                  @click.prevent="storeBook()"
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
    data() {
        return {
            bases: [],
            form : new Form({
                base:'',
                book_name:'',
                zarib:1,
                nomreh_manfi:1,
                nomreh:100,
            })

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

        storeBook(){
            Vue.http.post('api/admin/book/store',this.form).then(response=>{
               // console.log(response)
              const book = response.book;
              this.$emit('updateBookList',book);
              Swal.fire({
                icon: 'success',
                title: 'اطلاعات با موفقیت ثبت گردید!',
                showConfirmButton: true,
              });


            }).catch(error=>{
                console.log(error);
            })
        }
    },

    created() {
        this.fetchAllBases();
    },

    components: {
        Multiselect
    },
};
</script>
