<script setup>
import { supabase } from "@/lib/supabase";
import { handleError, onMounted, ref } from "vue";

const contactMode = ref("create");
const successMsg = ref("");
const errorMsg = ref("");
const formContactUs = ref({
  name: "",
  address: "",
  contact: "",
  email: "",
  map_url: "",
});

onMounted(async () => {
  const { data: check, error } = await supabase
    .from("settings")
    .select("*")
    .single();

  if (error) {
    console.error(error);
  } else {
    formContactUs.value = {
      id: check.id ?? "",
      name: check.name ?? "",
      address: check.address ?? "",
      contact: check.contact ?? "",
      email: check.email ?? "",
      map_url: check.map_url ?? "",
      photo: check.photo ?? "",
    };
  }
});
const selectedImage = ref(null);
const previewSelectedPhoto = ref(null);

const handlePhotoPreview = (event) => {
  const file = event.target.files[0];
  if (file) {
    selectedImage.value = file;
    previewSelectedPhoto.value = URL.createObjectURL(file);
    formContactUs.value.photo = file
  }
};

async function submitContactUs() {
  const { data: check, error } = await supabase
    .from("settings")
    .select("*")
    .single();

  if (!check) {
    contactMode.value = true;
    successMsg.value = "";
    errorMsg.value = "";

    const fileName = `${selectedImage.value.name}`;

    const { error: uploadError } = await supabase.storage
      .from("settings")
      .upload(fileName, selectedImage.value);

    if (uploadError) {
      const resultSuccess = await Swal.fire({
        title: "Error!",
        text: "Error, Try Again inserting an image!",
        icon: "error",
        timer: 1500,
        showConfirmButton: false,
      });
      return;
    }

    const { data: urlData } = supabase.storage
      .from("settings")
      .getPublicUrl(fileName);

    const publicUrl = urlData.publicUrl;

    const { error } = await supabase.from("settings").insert({
      name: formContactUs.value.name,
      address: formContactUs.value.address,
      contact: formContactUs.value.contact,
      email: formContactUs.value.email,
      photo: publicUrl,
      map_url: formContactUs.value.map_url,
    });

    successMsg.value = "Contact Info Added Successfully";

    if (error) {
      errorMsg.value = error.message;
    }

    contactMode.value = false;
  } else {
    contactMode.value = true;
    successMsg.value = "";
    errorMsg.value = "";
    const fileName = `${selectedImage.value.name}`;

    const { error: uploadError } = await supabase.storage
      .from("settings")
      .update(fileName, selectedImage.value);

    if (uploadError) {
      const resultSuccess = await Swal.fire({
        title: "Error!",
        text: "Error, Try Again inserting an image!",
        icon: "error",
        timer: 1500,
        showConfirmButton: false,
      });
      return;
    }

    const { data: urlData } = supabase.storage
      .from("settings")
      .getPublicUrl(fileName);

    const publicUrl = urlData.publicUrl;

    const { error } = await supabase
      .from("settings")
      .update({
        name: formContactUs.value.name,
        address: formContactUs.value.address,
        contact: formContactUs.value.contact,
        email: formContactUs.value.email,
        photo: publicUrl,
        map_url: formContactUs.value.map_url,
      })
      .eq("id", formContactUs.value.id);

    successMsg.value = "Contact Info Updated Successfully";

    if (error) {
      errorMsg.value = error.message;
    }

    contactMode.value = false;
  }
}
</script>
<template>
  <div>
    <div class="container py-4">
      <h3 class="mb-4">Office Settings</h3>
      <form @submit.prevent="submitContactUs">
        <div class="card shadow-sm">
          <div class="card-body">
            <div v-if="successMsg" class="alert alert-success">
              {{ successMsg }}
            </div>
            <div v-if="errorMsg" class="alert alert-danger">{{ errorMsg }}</div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Office Name</label>
                <input type="hidden" v-model="formContactUs.id" />
                <input
                  type="text"
                  class="form-control"
                  v-model="formContactUs.name"
                />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Office Address</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="formContactUs.address"
                />
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Map Embed URL</label>
              <input
                type="text"
                class="form-control"
                placeholder="Paste Google Maps embed src here"
                v-model="formContactUs.map_url"
              />
              <small class="text-muted">
                Google Maps → Share → Embed a map → copy the src URL.
              </small>
            </div>
            <div class="mb-4" v-if="formContactUs.map_url">
              <label class="form-label d-block">Preview</label>
              <iframe
                :src="formContactUs.map_url"
                width="100%"
                height="300"
                style="border: 0"
                loading="lazy"
              ></iframe>
            </div>
            <hr />
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Contact Number</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="formContactUs.contact"
                />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Email Address</label>
                <input
                  type="email"
                  class="form-control"
                  v-model="formContactUs.email"
                />
              </div>
            </div>
            <hr />
            <div class="mb-3">
              <label class="form-label">Office Photo</label>
              <input
                type="file"
                class="form-control"
                accept="/img/*"
                @change="handlePhotoPreview"
              />
            </div>
            <div class="mb-4">
              <label class="form-label d-block">Preview</label>
              <img
                :src="previewSelectedPhoto"
                width="100%"
                height="500"
                style="object-fit: fill;"
                loading="lazy" v-if="previewSelectedPhoto"
              ></img>
              <img
                :src="formContactUs.photo"
                width="100%"
                height="500"
                style="object-fit: fill;"
                loading="lazy" v-else-if="formContactUs.photo"
              ></img>
              <img
                src="/img/capiz-logo.png"
                width="100%"
                height="500"
                style="object-fit: fill;"
                loading="lazy" v-else
              ></img>
            </div>
          </div>
          <div class="card-footer d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary">Save Settings</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
