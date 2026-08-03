<script setup>
import { onMounted, ref } from "vue";
import { supabase } from "@/lib/supabase";

const divListData = ref([]);

const divForm = ref({
  id: "",
  name: "",
});

const submitDivisionMode = ref(false);
const successMsg = ref("");
const errorMsg = ref("");

onMounted(async () => {
  const { data, error } = await supabase.from("divisions").select("*");
  divListData.value = data;
});

async function submitDivision() {
  submitDivisionMode.value = true;
  successMsg.value = "";
  errorMsg.value = "";

  const { error } = await supabase.from("divisions").insert({
    name: divForm.value.name,
  });

  submitDivisionMode.value = false;

  if (error) {
    errorMsg.value = error.message;
    return;
  }

  successMsg.value = "Division added successfully!";

  divForm.value = {
    name: "",
  };
}
</script>
<template>
  <div>
    <div class="container-fluid">
      <div v-if="successMsg" class="alert alert-success">{{ successMsg }}</div>
      <div v-if="errorMsg" class="alert alert-danger">{{ errorMsg }}</div>
      <div class="row mt-4">
        <div class="col-md-4">
          <form @submit.prevent="submitDivision">
            <div class="card">
              <div class="card-header">
                <h3>Division Form</h3>
              </div>
              <div class="card-body">
                <div class="form-group mb-3">
                  <label for="">Name:</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="divForm.name"
                    required
                  />
                </div>
              </div>
              <div class="card-footer">
                <button
                  type="submit"
                  class="btn btn-success px-5 m-2 float-end"
                >
                  Save Changes
                </button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h3>Divisions</h3>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-hover">
                <thead class="table-dark">
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(div, index) in divListData" :key="index">
                    <td class="align-middle text-center">{{ index + 1 }}</td>
                    <td class="align-middle">{{ div.name }}</td>
                    <td class="align-middle text-center">
                      <button class="btn btn-warning">
                        <i class="fa-solid fa-pen-to-square"></i>
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
  </div>
</template>
