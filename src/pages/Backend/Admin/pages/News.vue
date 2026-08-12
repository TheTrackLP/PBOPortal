<script setup>
import { supabase } from "@/lib/supabase";
import { onMounted, ref } from "vue";
import Swal from "sweetalert2";

const newsFormMode = ref("create");
const selectedImage = ref(null);
const previewPhotoFile = ref(null);
const newsLists = ref([]);

const newsForm = ref({
  title: "",
  content: "",
  cover_image: "",
  is_published: "",
  published_date: "",
});

const handlePhotoView = (event) => {
  const file = event.target.files[0];
  if (file) {
    selectedImage.value = file;
    previewPhotoFile.value = URL.createObjectURL(file);
    newsForm.value.photo = file;
  }
};

async function submitNewsForm() {
  if (newsFormMode.value === "create") {
    newsFormMode.value = "create";

    if (!selectedImage.value) {
      const { data, error } = await supabase.from("news").insert({
        title: newsForm.value.title,
        content: newsForm.value.content,
        is_published: 1,
        published_date: newsForm.value.published_date,
      });
      newsFormMode.value = "create";

      if (error) {
        const resultError = await Swal.fire({
          title: "Error!",
          text: "Error, Try Again inserting into Forms!",
          icon: "error",
          timer: 1500,
          showConfirmButton: false,
        });
        return;
      }

      const resultSuccess = await Swal.fire({
        title: "Success!",
        text: "News has been successfully Added",
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
      });

      newsForm.value = {
        title: "",
        content: "",
        cover_image: "",
        is_published: "",
        published_date: "",
      };
      previewPhotoFile.value = null;
      await fetchNewsList();
    }

    const filename = `${selectedImage.value.name}`;

    const { error: uploadError } = await supabase.storage
      .from("news")
      .upload(filename, selectedImage.value);

    if (uploadError) {
      const resultError = await Swal.fire({
        title: "Error!",
        text: "Error, Try Again inserting an image!",
        icon: "error",
        timer: 1500,
        showConfirmButton: false,
      });
      return;
    }

    const { data: urlData } = supabase.storage
      .from("news")
      .getPublicUrl(filename);

    const publicUrl = urlData.publicUrl;

    const { data, error } = await supabase.from("news").insert({
      title: newsForm.value.title,
      content: newsForm.value.content,
      cover_image: publicUrl,
      is_published: 1,
      published_date: newsForm.value.published_date,
    });
    newsFormMode.value = "create";

    if (error) {
      const resultError = await Swal.fire({
        title: "Error!",
        text: "Error, Try Again inserting into Forms!",
        icon: "error",
        timer: 1500,
        showConfirmButton: false,
      });
      return;
    }

    const resultSuccess = await Swal.fire({
      title: "Success!",
      text: "News has been successfully Added",
      icon: "success",
      timer: 1500,
      showConfirmButton: false,
    });

    newsForm.value = {
      title: "",
      content: "",
      cover_image: "",
      is_published: "",
      published_date: "",
    };
    previewPhotoFile.value = null;
    await fetchNewsList();
  } else {
    newsFormMode.value = "edit";
    if (!selectedImage.value) {
      const { error } = await supabase
        .from("news")
        .update({
          title: newsForm.value.title,
          content: newsForm.value.content,
          is_published: 1,
          published_date: newsForm.value.published_date,
        })
        .eq("id", newsForm.value.id);

      const resultSuccess = await Swal.fire({
        title: "Success!",
        text: "News has been successfully Updated",
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
      });
      await fetchNewsList();

      newsForm.value = {
        id: "",
        title: "",
        content: "",
        cover_image: "",
        is_published: "",
        published_date: "",
      };
      previewPhotoFile.value = null;
      return;
    }

    const newfilename = `${selectedImage.value.name}`;

    const { error: uploadError } = await supabase.storage
      .from("news")
      .update(newfilename, selectedImage.value);

    if (uploadError) {
      const resultError = await Swal.fire({
        title: "Error!",
        text: "Error, Try Again inserting an image!",
        icon: "error",
        timer: 1500,
        showConfirmButton: false,
      });
      return;
    }

    const { data: urlData } = supabase.storage
      .from("news")
      .getPublicUrl(newfilename);

    const publicUrl = urlData.publicUrl;

    const { data, error } = await supabase
      .from("news")
      .update({
        title: newsForm.value.title,
        content: newsForm.value.content,
        cover_image: publicUrl,
        is_published: 1,
        published_date: newsForm.value.published_date,
      })
      .eq("id", newsForm.value.id);
    newsFormMode.value = "create";

    if (error) {
      const resultError = await Swal.fire({
        title: "Error!",
        text: "Error, Try Again inserting into Forms!",
        icon: "error",
        timer: 1500,
        showConfirmButton: false,
      });
      return;
    }

    const resultSuccess = await Swal.fire({
      title: "Success!",
      text: "News has been successfully Added",
      icon: "success",
      timer: 1500,
      showConfirmButton: false,
    });

    newsForm.value = {
      title: "",
      content: "",
      cover_image: "",
      is_published: "",
      published_date: "",
    };
    previewPhotoFile.value = null;
  }
}

async function fetchNewsData(news) {
  const { data, error } = await supabase
    .from("news")
    .select("*")
    .eq("id", news.id)
    .single();
  if (error) {
    const resultError = await Swal.fire({
      title: "Error!",
      text: "Error, Try Again!",
      icon: "error",
      timer: 1500,
      showConfirmButton: false,
    });
    return;
  }
  newsForm.value = data;
  newsFormMode.value = "edit";
}

async function togglePublish(news) {
  const newStatus = !news.is_published;

  const { error } = await supabase
    .from("news")
    .update({ is_published: newStatus })
    .eq("id", news.id);

  if (error) {
    const resultError = await Swal.fire({
      title: "Error!",
      text: "Error, The status was not changed!",
      icon: "error",
      timer: 1500,
      showConfirmButton: false,
    });
    return;
  }
  news.is_published = newStatus;
  const resultSuccess = await Swal.fire({
    title: "Success!",
    text: "News Status Has been Changed!",
    icon: "success",
    timer: 1500,
    showConfirmButton: false,
  });
}

async function fetchNewsList() {
  const { data, error } = await supabase.from("news").select("*");
  newsLists.value = data;
}
onMounted(fetchNewsList);
</script>

<template>
  <div class="container-fluid">
    <div class="row mt-4">
      <div class="col-md-4">
        <form @submit.prevent="submitNewsForm">
          <div class="card">
            <div class="card-header">
              <h3>News / Announcement Form</h3>
              <input type="hidden" v-model="newsForm.id" />
            </div>
            <div class="card-body">
              <div class="form-group mb-3">
                <label for="">Title:</label>
                <input
                  type="text"
                  class="form-control"
                  required
                  v-model="newsForm.title"
                />
              </div>

              <div class="form-group mb-3">
                <label for="">Content:</label>
                <textarea
                  class="form-control"
                  rows="5"
                  required
                  v-model="newsForm.content"
                ></textarea>
              </div>

              <div class="form-group mb-3">
                <label for="">Cover Image:</label>
                <input
                  type="file"
                  class="form-control"
                  accept="image/jpeg, image/png"
                  @change="handlePhotoView"
                />
              </div>
              <div class="form-group mb-3 text-center" v-if="previewPhotoFile">
                <label for=""></label>
                <img
                  class=""
                  :src="previewPhotoFile"
                  width="400"
                  height="200"
                />
              </div>
              <div class="form-group mb-3 text-center" v-else>
                <label for=""></label>
                <img
                  class=""
                  src="/img/capiz-logo.png"
                  width="200"
                  height="200"
                />
              </div>
              <small class="text-muted mb-3">
                Change the file name to Title and Publish date, and image as
                .png
              </small>
              <div class="form-group mb-3">
                <label for="">Publish Date :</label>
                <input
                  type="date"
                  class="form-control"
                  required
                  v-model="newsForm.published_date"
                />
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-success px-5 m-2 float-end">
                {{
                  newsForm.processing
                    ? "Saving..."
                    : newsFormMode === "create"
                      ? "Add"
                      : "Save Changes"
                }}
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3>News & Announcements</h3>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
              <thead class="table-dark">
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Image</th>
                  <th class="text-center">Title</th>
                  <th class="text-center">Date</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(news, index) in newsLists" :key="index">
                  <td class="text-center">{{ index + 1 }}</td>
                  <td class="text-center">
                    <img
                      :src="news.cover_image"
                      v-if="news.cover_image"
                      style="
                        width: 60px;
                        height: 45px;
                        background: #dfe3ea;
                        border-radius: 4px;
                      "
                    /><img
                      src="/img/capiz-logo.png"
                      style="width: 60px; height: 45px"
                      v-else
                    />
                  </td>
                  <td>{{ news.title }}</td>
                  <td class="text-center">
                    {{
                      new Date(news.published_date).toLocaleDateString(
                        "en-us",
                        {
                          year: "numeric",
                          month: "long",
                          day: "numeric",
                        },
                      )
                    }}
                  </td>
                  <td class="text-center">
                    <span
                      class="badge bg-success"
                      v-if="news.is_published === true"
                      >Published</span
                    >
                    <span
                      class="badge bg-danger"
                      v-else-if="news.is_published === false"
                      >Unpublished</span
                    >
                  </td>
                  <td class="text-center">
                    <button
                      class="btn btn-warning btn-sm me-1"
                      @click="fetchNewsData(news)"
                    >
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <button
                      type="button"
                      class="btn btn-success btn-sm"
                      @click="togglePublish(news)"
                      v-if="news.is_published === true"
                    >
                      <i class="fa-solid fa-circle-check"></i>
                    </button>
                    <button
                      type="button"
                      class="btn btn-danger btn-sm"
                      @click="togglePublish(news)"
                      v-else-if="news.is_published === false"
                    >
                      <i class="fa-solid fa-circle-xmark"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
