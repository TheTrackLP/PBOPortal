<script setup>
import { supabase } from "@/lib/supabase";
import { onMounted, ref } from "vue";

const selectedCharter = ref(null);
const fetchCharterList = ref([]);

const charterMode = ref("create");
const successMsg = ref("");
const errorMsg = ref("");

function handleFileSelected(event) {
  selectedCharter.value = event.target.files[0];
}
const formCitizenCharter = ref({
  title: "",
  edition: "",
  file_url: "",
  is_current: false,
});

async function fetchCitizenCharter() {
  const { data, error } = await supabase.from("citizens_charter").select("*");
  fetchCharterList.value = data;
}

onMounted(fetchCitizenCharter);

async function submitCitizenCharter() {
  charterMode.value = "create";
  errorMsg.value = "";
  successMsg.value = "";

  if (!selectedCharter.value) {
    errorMsg.value = "Please select a PDF file.";
    return;
  }

  const fileName = `${Date.now()}_${formCitizenCharter.value.title}_${formCitizenCharter.value.edition}`;

  const { error: uploadError } = await supabase.storage
    .from("citizens_charter")
    .upload(fileName, selectedCharter.value);

  if (uploadError) {
    errorMsg.value = uploadError.message;
    return;
  }

  const { data: urlData } = supabase.storage
    .from("citizens_charter")
    .getPublicUrl(fileName);

  const publicUrl = urlData.publicUrl;

  const { error: insertError } = await supabase
    .from("citizens_charter")
    .insert({
      title: formCitizenCharter.value.title,
      edition: formCitizenCharter.value.edition,
      file_url: publicUrl,
      is_current: false,
    });

  if (insertError) {
    errorMsg.value = insertError.message;
    return;
  }
  charterMode.value = "create";
  await fetchCitizenCharter();

  successMsg.value = "Citizen Charter added successfully!";

  formCitizenCharter.value = {
    title: "",
    edition: "",
    file_url: "",
    is_current: false,
  };
}

async function toggleCurrent(chart) {
  const newCurrent = !chart.is_current;

  const { error } = await supabase
    .from("citizens_charter")
    .update({ is_current: newCurrent })
    .eq("id", chart.id);

  if (error) {
    errorMsg.value = error.message;
    return;
  }

  chart.is_current = newCurrent;
  successMsg.value = "Current Edition Changed";
}
</script>

<template>
  <div class="container-fluid">
    <div v-if="successMsg" class="alert alert-success">{{ successMsg }}</div>
    <div v-if="errorMsg" class="alert alert-danger">{{ errorMsg }}</div>
    <div class="row mt-4">
      <div class="col-md-4">
        <form @submit.prevent="submitCitizenCharter">
          <div class="card">
            <div class="card-header">
              <h3>Citizen's Charter Form</h3>
            </div>
            <div class="card-body">
              <div class="form-group mb-3">
                <label for="">Title:</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="e.g. Roxas City Citizen's Charter"
                  v-model="formCitizenCharter.title"
                  required
                />
              </div>

              <div class="form-group mb-3">
                <label for="">Edition:</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="e.g. 4th Edition, 2023"
                  v-model="formCitizenCharter.edition"
                  required
                />
              </div>

              <div class="form-group mb-3">
                <label for="">PDF File:</label>
                <input
                  type="file"
                  class="form-control"
                  accept="application/pdf"
                  @change="handleFileSelected"
                  required
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
            <h3>Editions History</h3>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
              <thead class="table-dark">
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Title</th>
                  <th class="text-center">Edition</th>
                  <th class="text-center">File</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Uploaded</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(chart, index) in fetchCharterList" :key="index">
                  <td class="text-center">{{ index + 1 }}</td>
                  <td>{{ chart.title }}</td>
                  <td class="text-center">{{ chart.edition }}</td>
                  <td class="text-center">
                    <a :href="chart.file_url" target="_blank">
                      <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                      View
                    </a>
                  </td>
                  <td class="text-center">
                    <span
                      class="badge bg-success"
                      v-if="chart.is_current === true"
                      >Current</span
                    >
                    <span
                      class="badge bg-secondary"
                      v-else-if="chart.is_current === false"
                      >Archive</span
                    >
                  </td>
                  <td class="text-center">
                    {{ new Date(chart.created_at).toLocaleDateString() }}
                  </td>
                  <td class="text-center">
                    <button
                      type="button"
                      class="btn btn-success btn-sm"
                      @click="toggleCurrent(chart)"
                      v-if="chart.is_current === true"
                    >
                      <i class="fa-solid fa-circle-check"></i>
                    </button>
                    <button
                      type="button"
                      class="btn btn-danger btn-sm"
                      @click="toggleCurrent(chart)"
                      v-else-if="chart.is_current === false"
                    >
                      <i class="fa-solid fa-circle-xmark"></i>
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
