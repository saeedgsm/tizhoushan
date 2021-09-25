
<template>
  <div>
    <div
      class="modal fade normal-poreshnameh-file-upload"
      tabindex="-1"
      role="dialog"
      aria-labelledby="normal-poreshnameh-file-upload"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title mt-0" id="normal-poreshnameh-file-upload">
              آپلود فایل
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
              <div class="col-sm-12">
                <div class="form-group">
                  <input
                    type="text"
                    required
                    name="image_name"
                    v-model="form.image_name"
                    class="form-control"
                    placeholder="عنوان عکس"/>

                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <div v-if="!image">
                    <h4>انتخاب عکس</h4>
                    <input
                      type="file"
                      @change="onFileChange"
                      ref="file"
                      v-on:change="handleFileUpload()"
                    />
                  </div>
                  <div v-else>
                    <img :src="image" />
                    <div class="text-center">
                      <progress
                        max="100"
                        :value.prop="uploadPercentage"
                      ></progress>
                    </div>
                    <button @click="uploadImage" data-dismiss="modal" class="btn btn-success btn-sm">
                      آپلود کن
                    </button>
                    <button @click="removeImage" class="btn btn-info btn-sm">
                      پاک کن
                    </button>
                  </div>
                </div>
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
import axios from "axios";


export default {
    props: ["azmoonId"],
  data() {
    return {
      image_name: "",
      image: "",
      file: null,
      uploadPercentage: 0,
      form : new Form({
          file: null,
          azmoon_id:  this.azmoonId,
          image_name: '',
      })
    };
  },

  methods: {
    onFileChange(e) {

      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImage: function (e) {
      this.image = "";
    },

    handleFileUpload() {
      this.form.file = this.$refs.file.files[0];
    },

    uploadImage() {
      let formData = new FormData();
      formData.append("file", this.form.file);
      formData.append("azmoon_id", this.form.azmoon_id);
      formData.append("file_name", this.form.image_name);
      //formData.append(this.form);
      axios
        .post("/api/admin/normal-poreshname-image-upload", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
          onUploadProgress: function (progressEvent) {
            this.uploadPercentage = parseInt(
              Math.round((progressEvent.loaded / progressEvent.total) * 100)
            );
          }.bind(this),
        })
        .then(response=>{
            this.form.reset();
            Toast.fire({
                      icon: 'success',
                      title: 'فایل آپلود شد!'
                    })
            $('#normal-poreshnameh-file-upload').modal('hide');
            console.log(response);
        })
        .catch(error=>{
            console.log(error);
        });
    },



  },
};
</script>

<style scoped>
#app {
  text-align: center;
}
img {
  width: 30%;
  margin: auto;
  display: block;
  margin-bottom: 10px;
}

.invalid {
  border: 1px solid red;
  box-shadow: 0 0 5px red;
  background-color: lightpink;
}
</style>
