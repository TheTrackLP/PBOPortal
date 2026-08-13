<script setup>
import { supabase } from "@/lib/supabase";
import { ref } from "vue";
import Swal from "sweetalert2";

const topicFormMode = ref("create");
const topicForm = ref({
  title: "",
  order: "",
});

async function submitTopicForm() {
  if (topicFormMode.value === "create") {
    topicFormMode.value = "create";
    const { error } = await supabase.from("benefit_topics").insert({
      title: topicForm.value.title,
      order: topicForm.value.order,
    });

    if (error) {
      const resultError = await Swal.fire({
        title: "Error!",
        text: "Error, Try Again!",
        icon: "error",
        timer: 1000,
        showConfirmButton: false,
      });
    }

    const resultSuccess = await Swal.fire({
      title: "Success!",
      text: "Topic has been successfully Added",
      icon: "success",
      timer: 1500,
      showConfirmButton: false,
    });

    topicFormMode.value = "create";

    topicForm.value = {
      title: "",
      order: "",
    };
  } else {
  }
}
</script>

<style>
.nav-tabs .nav-link {
  color: #55627a;
  font-weight: 600;
  font-size: 1rem;
  border: none;
  border-bottom: 3px solid transparent;
}
.nav-tabs .nav-link.active {
  color: var(--navy-dark);
  border-bottom: 3px solid var(--gold);
  background: transparent;
}
</style>

<template>
  <div class="container-fluid mt-4">
    <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button
          class="nav-link active"
          data-bs-toggle="pill"
          data-bs-target="#pills-home"
          type="button"
        >
          Benefits Topics
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button
          class="nav-link"
          data-bs-toggle="pill"
          data-bs-target="#pills-profile"
          type="button"
        >
          Legal issuances
        </button>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div
        class="tab-pane fade show active"
        id="pills-home"
        role="tabpanel"
        aria-labelledby="pills-home-tab"
        tabindex="0"
      >
        <div class="row mt-4">
          <div class="col-md-4">
            <form @submit.prevent="submitTopicForm">
              <div class="card">
                <div class="card-header">
                  <h3>Topics Form</h3>
                </div>
                <div class="card-body">
                  <input type="text" />
                  <div class="form-group mb-3">
                    <label for="">Topic Name:</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="topicForm.title"
                      required
                    />
                  </div>
                  <div class="form-group mb-3">
                    <label for="">Display Order:</label>
                    <input
                      type="number"
                      class="form-control"
                      v-model="topicForm.order"
                      required
                    />
                  </div>
                </div>
                <div class="card-footer">
                  <button
                    type="submit"
                    class="btn btn-success px-5 m-2 float-end"
                  >
                    {{
                      topicForm.processing
                        ? "Saving..."
                        : topicFormMode === "create"
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
                <h3>All Topics</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead class="table-dark">
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Year</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(row, index) in 4" :key="index">
                      <td class="align-middle text-center">{{ index + 1 }}</td>
                      <td class="align-middle"></td>
                      <td class="align-middle text-center"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="pills-profile"
        role="tabpanel"
        aria-labelledby="pills-profile-tab"
        tabindex="0"
      >
        <div class="row mt-4">
          <div class="col-md-4">
            <form @submit.prevent="submitAccomplish">
              <div class="card">
                <div class="card-header">
                  <h3>Accomplishment Form</h3>
                </div>
                <div class="card-body">
                  <div class="form-group mb-3">
                    <label for="">Benefit Topic:</label>
                    <select name="" class="form-select">
                      <option value="">Select a Topic</option>
                      <option value=""></option>
                      <option value=""></option>
                      <option value=""></option>
                      <option value=""></option>
                    </select>
                  </div>
                  <div class="form-group mb-3">
                    <label for="">Title:</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="DBM Circular..."
                      required
                    />
                  </div>
                  <div class="form-group mb-3">
                    <label for="">Description:</label>
                    <textarea
                      name=""
                      class="form-control"
                      rows="4"
                      placeholder="Short Description of Issuance...."
                    ></textarea>
                  </div>
                  <div class="form-group mb-3">
                    <label for="">Date Issued:</label>
                    <input type="date" class="form-control" required />
                  </div>
                  <div class="form-group mb-3">
                    <label for="">Google Drive Link:</label>
                    <input type="text" class="form-control" required />
                    <small
                      >Right-Click File, Share then paste the link here</small
                    >
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
                <h3>All Topics</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead class="table-dark">
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Topic</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Data Issued</th>
                      <th class="text-center">GDrive Link</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(row, index) in 4" :key="index">
                      <td class="align-middle text-center">{{ index + 1 }}</td>
                      <td class="align-middle"></td>
                      <td class="align-middle text-center"></td>
                      <td class="align-middle text-center"></td>
                      <td class="align-middle text-center"></td>
                      <td class="align-middle text-center"></td>
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
</template>
