<script setup>
import { supabase } from "@/lib/supabase";
import { onMounted, ref } from "vue";

const accomplishForm = ref({
  title: "",
  year: "",
  file: "",
  order: "",
});

const accomplishFormMode = ref("create");
const successMsg = ref("");
const errorMsg = ref("");

const selectedFile = ref(null);

function handleFileSelect(event) {
  selectedFile.value = event.target.files[0];
}

async function submitAccomplish() {
  if (accomplishFormMode.value === "create") {
    accomplishFormMode.value = "create";
    errorMsg.value = "";
    successMsg.value = "";

    if (!selectedFile.value) {
      errorMsg.value = "Please select a PDF file.";
      return;
    }

    const fileName = `${Date.now()}_${selectedFile.value.name}`;

    const { error: uploadError } = await supabase.storage
      .from("accomplishments")
      .upload(fileName, selectedFile.value);

    if (uploadError) {
      errorMsg.value = uploadError.message;
      return;
    }

    const { data: urlData } = supabase.storage
      .from("accomplishments")
      .getPublicUrl(fileName);

    const publicUrl = urlData.publicUrl;

    const { error: insertError } = await supabase
      .from("accomplishments")
      .insert({
        title: accomplishForm.value.title,
        year: accomplishForm.value.year,
        file: publicUrl,
        order: accomplishForm.value.order,
      });

    if (insertError) {
      errorMsg.value = insertError.message;
      return;
    }
    accomplishFormMode.value = "create";

    successMsg.value = "Accomplishment added successfully!";
    await fetchAccomplishments();

    accomplishForm.value = {
      title: "",
      year: "",
      file: "",
      order: "",
    };
  } else {
    accomplishFormMode.value = "edit";
    errorMsg.value = "";
    successMsg.value = "";

    if (!selectedFile.value) {
      const { error: UpdateDataNoFIle } = await supabase
        .from("accomplishments")
        .update({
          title: accomplishForm.value.title,
          year: accomplishForm.value.year,
          order: accomplishForm.value.order,
        })
        .eq("id", accomplishForm.value.id);
      successMsg.value = "Accomplishment Updated successfully!";
      await fetchAccomplishments();
    }

    const newFileUpdate = `${selectedFile.value.name}`;

    const { error: uploadError } = await supabase.storage
      .from("accomplishments")
      .update(newFileUpdate, selectedFile.value);

    if (uploadError) {
      errorMsg.value = uploadError.message;
      return;
    }

    const { data: urlData } = supabase.storage
      .from("accomplishments")
      .getPublicUrl(newFileUpdate);

    const publicUrl = urlData.publicUrl;

    const { error: UpdateErrorData } = await supabase
      .from("accomplishments")
      .update({
        title: accomplishForm.value.title,
        year: accomplishForm.value.year,
        file: publicUrl,
        order: accomplishForm.value.order,
      })
      .eq("id", accomplishForm.value.id);

    if (UpdateErrorData) {
      errorMsg.value = UpdateErrorData.message;
      return;
    }
    accomplishFormMode.value = "create";

    successMsg.value = "Accomplishment Updated successfully!";
    await fetchAccomplishments();

    accomplishForm.value = {
      title: "",
      year: "",
      file: "",
      order: "",
    };
  }
}

async function fetchAccomplishData(row) {
  const { data, error } = await supabase
    .from("accomplishments")
    .select("*")
    .eq("id", row.id)
    .single();
  if (error) {
    errorMsg.value = error.message;
    return;
  }

  accomplishForm.value = data;
  accomplishFormMode.value = "edit";
}

const accomplishList = ref([]);
async function fetchAccomplishments() {
  const { data, error } = await supabase
    .from("accomplishments")
    .select("*")
    .order("order", { ascending: false });
  accomplishList.value = data;
}
onMounted(fetchAccomplishments);
</script>

<template>
  <div class="container-fluid">
    <div v-if="successMsg" class="alert alert-success">{{ successMsg }}</div>
    <div v-if="errorMsg" class="alert alert-danger">{{ errorMsg }}</div>
    <div class="row mt-4">
      <div class="col-md-4">
        <form @submit.prevent="submitAccomplish" enctype="multipart/form-data">
          <div class="card">
            <div class="card-header">
              <h3>Accomplishment Form</h3>
            </div>
            <div class="card-body">
              <div class="form-group mb-3">
                <label for="">Title:</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="accomplishForm.title"
                  required
                />
                <input type="hidden" v-model="accomplishForm.id" />
              </div>
              <div class="form-group mb-3">
                <label for="">Year:</label>
                <input
                  type="number"
                  class="form-control"
                  min="2000"
                  max="2100"
                  v-model="accomplishForm.year"
                  required
                />
              </div>

              <div class="form-group mb-3">
                <label for="">PDF File:</label>
                <input
                  type="file"
                  class="form-control"
                  accept="application/pdf"
                  @change="handleFileSelect"
                />
                <small class="text-muted"
                  >Upload the report PDF (max size TBD)</small
                >
              </div>

              <div class="form-group mb-3">
                <label for="">Display Order:</label>
                <input
                  type="number"
                  class="form-control"
                  min="0"
                  v-model="accomplishForm.order"
                />
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-success px-5 m-2 float-end">
                Save Changes
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3>Accomplishments</h3>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-hover">
              <thead class="table-dark">
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Title</th>
                  <th class="text-center">Year</th>
                  <th class="text-center">File</th>
                  <th class="text-center">Order</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(row, index) in accomplishList" :key="index">
                  <td class="align-middle text-center">{{ index + 1 }}</td>
                  <td class="align-middle">{{ row.title }}</td>
                  <td class="align-middle text-center">{{ row.year }}</td>
                  <td class="align-middle text-center">
                    <a :href="row.file" target="_blank">
                      <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                      View
                    </a>
                  </td>
                  <td class="align-middle text-center">{{ row.order }}</td>
                  <td class="align-middle text-center">
                    <button
                      class="btn btn-warning btn-sm me-1"
                      @click="fetchAccomplishData(row)"
                    >
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-danger btn-sm">
                      <i class="bi bi-trash"></i>
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
