<template>
  <div>
    <div class="page-content">
      <!-- Page-Title -->
      <div class="page-title-box">
        <div class="container-fluid">
          <div class="row align-items-center">
            <div class="col-md-4">
              <h4 class="page-title mb-1">کتاب ها</h4>
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">لیست کتاب</li>
              </ol>
            </div>
            <div class="col-md-8">
              <div class="float-right d-md-block">

                <button
                      type="button"
                      class="btn btn-light btn-rounded btn-sm"
                      data-toggle="modal"
                      data-target=".create-book"
                    >
                     <i class="dripicons-plus mr-1"></i>
                      ایجاد کتاب جدید
                    </button>

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
                  <h4 class="header-title">لیست کتاب</h4>

                  <div class="table-responsive">
                    <table class="table mb-0">
                      <thead>
                        <tr>
                          <th>کتاب</th>
                          <th>ضریب</th>
                          <th>نمره منفی</th>
                          <th>نمره</th>
                          <th>پایه های مربوطه</th>
                          <th>تنظیمات</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(book, index) in books" :key="book.id">
                          <td>{{ book.book_name }}</td>
                          <td>{{ book.zarib }}</td>
                          <td>{{ book.nomreh_manfi }}</td>
                          <td>{{ book.nomreh }}</td>
                          <td>
                              <div class="" v-for="base in book.bases" :key="base.id">
                                  <span>{{ base.base_title }}</span>
                              </div>
                          </td>
                          <td>
                            <div class="btn-group btn-group-sm">
                              <a
                                class="btn btn-warning btn-sm text-white"
                                data-toggle="modal"
                                data-target=".edit-book"
                                title="ویرایش "
                                @click="editBook(book)">
                                <i class="ti-pencil-alt"></i>
                                <b>ویرایش</b>
                              </a>
                              <button
                                @click.prevent="
                                  destroyBook(book.id, index)
                                "
                                class="btn btn-danger btn-sm"
                              >
                                <i
                                  class="dripicons dripicons-document-delete"
                                ></i>
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
      <create-book @updateBookList="updateBookList"></create-book>
      <edit-book :book="edit_book"></edit-book>
    </div>
  </div>
</template>
<script>

import Vue from "vue";
import CreateBookVue from './CreateBook.vue';
import EditBook from "./EditBook";
export default {
  name: "Books",

  data() {
    return {
      books: {},
      edit_book:{}
    };
  },

  methods: {
    fetchAllBooks() {
      Vue.http
        .get("api/admin/books")
        .then((response) => {
        //  console.log(response);
          this.books = response.body.books;
        })
        .catch((error) => {
          console.log("error");
        });
    },

    editBook(book){
      this.edit_book=book;
     // console.log(this.edit_book)
    },

    destroyBook(bookId,index){


      Swal.fire({
        title: "آیا مطمئن هستید؟",
        text: "از حذف کتاب احتمال بروز تداخل در آزمون ها شود!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "بله حذف شود",
        confirmButtonColor: "red",
        cancelButtonText: "نه! دستم اشتباهی خورد",
        showCloseButton: true,
        customClass: "swal2-popup",
      }).then((result) => {
        if (result.value) {
          Vue.http.delete('api/admin/book/delete/'+bookId).then(response=>{
            Swal.fire({
              icon: response.body.icon,
              title: response.body.title,
              text: response.body.text,
              confirmButtonText:'خیلی خوب'
            });
            this.fetchAllBooks();
            if (response.body.icon === 'error') {
              console.log(response.body.error);
            }
          }).catch(error=>{
            console.log(error);
          })
        } else {
          Swal.fire("کنسل شد", "کتاب مورد نظر هنوز سالم است", "info");
        }
      });
    },

    updateBookList(result){
     // console.log(result)
      this.fetchAllBooks();
      //this.books.push(result);
    }
  },

  created() {
    this.fetchAllBooks();
  },

  components:{
      'create-book':CreateBookVue,
    'edit-book':EditBook
  }
};
</script>
