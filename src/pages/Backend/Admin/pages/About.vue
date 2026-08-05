<script setup>
import { supabase } from "@/lib/supabase";
import { onMounted, ref } from "vue";

const aboutusFormMode = ref(false);
const mandateFormMode = ref("create");
const successMsg = ref("");
const errorMsg = ref("");

const aboutusForm = ref({
  mission_title: "",
  mission_content: "",
  vision_title: "",
  vision_content: "",
  org_title: "",
  org_content: "",
});

onMounted(async () => {
  const { data: check, error } = await supabase
    .from("aboutcontents")
    .select("*")
    .single();

  const { data: mandateList } = await supabase.from("mandates").select("*");

  if (error) {
    console.error(error);
  } else {
    aboutusForm.value = {
      id: check.id ?? "",
      mission_title: check.mission_title ?? "",
      mission_content: check.mission_content ?? "",
      vision_title: check.vision_title ?? "",
      vision_content: check.vision_content ?? "",
      org_title: check.org_title ?? "",
      org_content: check.org_content ?? "",
    };

    const { data: mandateList } = await supabase.from("mandates").select("*");

    if (mandateList) {
      mandateForm.value.mandateArray = mandateList.map((item) => ({
        id: item.id ?? "",
        content: item.content ?? "",
      }));
    }
  }
});

async function submitAboutUs() {
  const { data: check } = await supabase
    .from("aboutcontents")
    .select("*")
    .single();

  if (check) {
    aboutusFormMode.value = true;
    successMsg.value = "";
    errorMsg.value = "";

    const { data, error } = await supabase
      .from("aboutcontents")
      .update({
        mission_title: aboutusForm.value.mission_title,
        mission_content: aboutusForm.value.mission_content,
        vision_title: aboutusForm.value.vision_title,
        vision_content: aboutusForm.value.vision_content,
        org_title: aboutusForm.value.org_title,
        org_content: aboutusForm.value.org_content,
      })
      .eq("id", aboutusForm.value.id);

    aboutusFormMode.value = false;

    if (error) {
      errorMsg.value = error.message;
      return;
    }

    successMsg.value = "About page info Updated Successfully";
  } else {
    aboutusFormMode.value = true;
    successMsg.value = "";
    errorMsg.value = "";

    const { data, error } = await supabase.from("aboutcontents").insert({
      mission_title: aboutusForm.value.mission_title,
      mission_content: aboutusForm.value.mission_content,
      vision_title: aboutusForm.value.vision_title,
      vision_content: aboutusForm.value.vision_content,
      org_title: aboutusForm.value.org_title,
      org_content: aboutusForm.value.org_content,
    });

    aboutusFormMode.value = false;

    if (error) {
      errorMsg.value = error.message;
      return;
    }

    successMsg.value = "About page info added Successfully";
  }
}

const mandateForm = ref({
  mandateArray: [],
});

const addMandate = () => {
  mandateForm.value.mandateArray.push({
    content: "",
  });
};
async function fetchMandates() {
  const { data, error } = await supabase.from("mandates").select("*");
  if (data) {
    mandateForm.value.mandateArray = data.map((item) => ({
      id: item.id,
      content: item.content,
    }));
  }
}

async function submitMandate() {
  successMsg.value = "";
  errorMsg.value = "";

  for (const row of mandateForm.value.mandateArray) {
    if (row.id) {
      const { error } = await supabase
        .from("mandates")
        .update({ content: row.content })
        .eq("id", row.id);

      if (error) {
        errorMsg.value = error.message;
        return;
      }
    } else {
      const { data, error } = await supabase
        .from("mandates")
        .insert({ content: row.content })
        .select()
        .single();

      if (error) {
        errorMsg.value = error.message;
        return;
      }
      row.id = data.id;
    }
  }

  successMsg.value = "Mandates updated successfully!";
}
function removeMandateRow(index) {
  const row = mandateForm.value.mandateArray[index];
  if (row.id) {
    supabase.from("mandates").delete().eq("id", row.id);
  }

  mandateForm.value.mandateArray.splice(index, 1);
}
</script>
<template>
  <div>
    <div class="container-fluid py-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h4 class="mb-0 fw-bold">Edit About Content</h4>
          <p class="text-muted small mb-0">
            Update the Mission, Vision, and Mandate shown on the public About
            page.
          </p>
        </div>
      </div>
      <div v-if="successMsg" class="alert alert-success">{{ successMsg }}</div>
      <div v-if="errorMsg" class="alert alert-danger">{{ errorMsg }}</div>
      <form @submit.prevent="submitAboutUs">
        <div class="row">
          <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-3">
              <div class="card-header bg-white border-bottom">
                <h6 class="mb-0 fw-semibold">Mission</h6>
              </div>
              <div class="card-body">
                <input type="hidden" v-model="aboutusForm.id" />
                <div class="mb-3">
                  <label
                    for="mission_title"
                    class="form-label small fw-semibold"
                    >Title</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    id="mission_title"
                    value="Our Mission"
                    v-model="aboutusForm.mission_title"
                  />
                </div>
                <div class="mb-0">
                  <label
                    for="mission_content"
                    class="form-label small fw-semibold"
                    >Content</label
                  >
                  <textarea
                    class="form-control"
                    id="mission_content"
                    rows="6"
                    placeholder="Enter the mission statement..."
                    v-model="aboutusForm.mission_content"
                  ></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-3">
              <div class="card-header bg-white border-bottom">
                <h6 class="mb-0 fw-semibold">Vision</h6>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label for="vision_title" class="form-label small fw-semibold"
                    >Title</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    id="vision_title"
                    value="Our Vision"
                    v-model="aboutusForm.vision_title"
                  />
                </div>
                <div class="mb-0">
                  <label
                    for="vision_content"
                    class="form-label small fw-semibold"
                    >Content</label
                  >
                  <textarea
                    class="form-control"
                    id="vision_content"
                    rows="6"
                    placeholder="Enter the vision statement..."
                    v-model="aboutusForm.vision_content"
                  ></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-3">
              <div class="card-header bg-white border-bottom">
                <h6 class="mb-0 fw-semibold">Organization Outcome</h6>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label
                    for="mandate_title"
                    class="form-label small fw-semibold"
                    >Title</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    id="mandate_title"
                    value="Organizational Outcome"
                    v-model="aboutusForm.org_title"
                  />
                </div>
                <div class="mb-0">
                  <label
                    for="mandate_content"
                    class="form-label small fw-semibold"
                    >Content</label
                  >
                  <textarea
                    class="form-control"
                    id="mandate_content"
                    rows="6"
                    placeholder="Enter the organization outcome..."
                    v-model="aboutusForm.org_content"
                  ></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-end gap-2">
          <button
            type="submit"
            class="btn btn-success text-white px-4 fw-semibold"
          >
            Save Changes
          </button>
        </div>
      </form>
      <form @submit.prevent="submitMandate">
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white border-bottom">
            <h6 class="mb-0 fw-semibold">
              <i class="bi bi-list-check me-2 text-warning"></i>Mandate Points
            </h6>
          </div>

          <div class="card-body">
            <div id="mandate-items">
              <div
                class="row g-2 align-items-start mandate-item mb-3"
                v-for="(item, index) in mandateForm.mandateArray"
                :key="index"
              >
                <div class="col-auto pt-2">
                  <span class="badge bg-secondary rounded-circle p-2">{{
                    index + 1
                  }}</span>
                  <input type="hidden" v-model="item.id" />
                </div>
                <div class="col">
                  <textarea
                    class="form-control"
                    rows="2"
                    placeholder="Enter mandate point..."
                    v-model="item.content"
                  ></textarea>
                </div>
                <div class="col-auto">
                  <button
                    type="button"
                    class="btn btn-outline-danger btn-sm remove-item"
                    @click="removeMandateRow(index)"
                  >
                    <i class="fa-solid fa-circle-xmark"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-end gap-2">
          <button
            type="button"
            class="btn btn-primary text-white px-4 fw-semibold float-start"
            @click="addMandate"
          >
            <i class="bi bi-plus-lg me-1"></i>Add Mandate Point
          </button>
          <button
            type="submit"
            class="btn btn-warning text-white px-4 fw-semibold"
          >
            <i class="bi bi-check-lg me-1"></i>Save Mandate
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
