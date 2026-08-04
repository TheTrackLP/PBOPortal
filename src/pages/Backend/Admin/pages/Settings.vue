<script setup>
import { supabase } from "@/lib/supabase";
import { ref } from "vue";

const contactMode = ref(false);
const successMsg = ref("");
const errorMsg = ref("");
const formContactUs = ref({
  name: "",
  address: "",
  contact: "",
  email: "",
  map_url: "",
});

async function submitContactUs() {
  contactMode.value = true;
  successMsg.value = "";
  errorMsg.value = "";
  const { error } = await supabase.from("settings").insert({
    name: formContactUs.value.name,
    address: formContactUs.value.address,
    contact: formContactUs.value.contact,
    email: formContactUs.value.email,
    map_url: formContactUs.value.map_url,
  });

  successMsg.value = "Contact Info Added Successfully";

  if (error) {
    errorMsg.value = error.message;
  }

  formContactUs.value = {
    name: "",
    address: "",
    contact: "",
    email: "",
    map_url: "",
  };
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
              <input type="file" class="form-control" accept="/img/settings" />
            </div>
            <div class="mb-4">
              <label class="form-label d-block">Preview</label>
              <iframe
                src=""
                width="100%"
                height="300"
                style="border: 0"
                loading="lazy"
              ></iframe>
            </div>
            <div class="mb-4">
              <label class="form-label d-block">Preview</label>
              <iframe
                src=""
                width="100%"
                height="300"
                style="border: 0"
                loading="lazy"
              ></iframe>
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
