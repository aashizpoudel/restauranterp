<template>
  <div>
    <div class="row">
      <div class="col-md-4 mx-1 my-1 bordered rounded" v-for="image in images" :key="image.id">
        <img :src="'/uploads/'+image.location" alt class="img img-fluid" srcset />
        <a
          href="#"
          :id="image.id"
          @click="deleteImage(image.id,$event)"
          title="Delete"
          class="btn btn-sm btn-outline-danger my-1"
        >
          <i class="fa fa-trash fa2x"></i>
        </a>
      </div>
    </div>
    <form action="" @submit="submit" ref='image_form' method="post">
      <input required id='file' type="file" @change="submit" ref="file_input" class="form-control my-2 d-none" name="image" />
        <label for="file">
           <div class="bordered shadow px-2 py-1" style='cursor:pointer'>
                <i class='fa fa-upload'></i>
            <span class='mx-1'>Add Image</span>
           </div>
        </label>
    </form>
    <p class="text-danger">{{message}}</p>
    <p v-show="loading">loading</p>
  </div>
</template>

<script>
import "axios";
export default {
    props:{
        'list_url':String,
        'upload_url':String,
        'delete_url':String
    },
  data() {
    return {
      images: [],
      message: "",
      loading: false
    };
  },
  mounted() {
    this.loadImages();
  },
  methods: {
    submit: function(e) {
      e.preventDefault();
      this.loading = true;
      let formData = new FormData(this.$refs.image_form);
      axios
        .post(this.upload_url, formData)
        .then(e => {
          this.message = "Successfully uploaded";
          swal.fire('Successfully Uploaded');
          this.loadImages();
        })
        .catch(e => {
          this.message = e.message;
        })
        .finally(() => {
          this.loading = false;

          this.$refs.file_input.value = "";
        });
    },
    loadImages: function() {
      axios
        .get(this.list_url)
        .then(resp => {
          this.images = resp.data.data;
        })
        .catch(e => {
          this.message = e.message;
        });
    },
    deleteImage: function(e, f) {
      f.preventDefault();
      this.loading = true;
      axios
        .post(this.delete_url+"/"+e,{_method:'DELETE'})
        .then(e => {
          this.message = "Successfully deleted";
          swal.fire("Successfully deleted");
          this.loadImages();
        })
        .catch(e => {
          this.message = e.message;
        })
        .finally(() => {
          this.loading = false;
        });
    }
  }
};
</script>
