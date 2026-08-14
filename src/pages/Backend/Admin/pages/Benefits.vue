<script setup>
import { supabase } from "@/lib/supabase";
import { onMounted, ref } from "vue";
import Swal from "sweetalert2";

const topicLists = ref([]);
const issuanceLists = ref([]);
const topicFormMode = ref("create");
const topicForm = ref({
  title: "",
});

async function submitTopicForm() {
  if (topicFormMode.value === "create") {
    topicFormMode.value = "create";
    const { data: check } = await supabase
      .from("benefit_topics")
      .select("order")
      .order("created_at", { ascending: false })
      .limit(1)
      .single();

    const { error } = await supabase.from("benefit_topics").insert({
      title: topicForm.value.title,
      order: check.order + 1,
    });

    if (error) {
      const resultError = await Swal.fire({
        title: "Error!",
        text: error.message,
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
    await fetchDatas();
  } else {
    topicFormMode.value = "edit";
    const { error } = await supabase
      .from("benefit_topics")
      .update({
        title: topicForm.value.title,
      })
      .eq("id", topicForm.value.id);

    if (error) {
      const resultError = await Swal.fire({
        title: "Error!",
        text: error.message,
        icon: "error",
        timer: 1000,
        showConfirmButton: false,
      });
    }

    const resultSuccess = await Swal.fire({
      title: "Success!",
      text: "Topic has been successfully Updated",
      icon: "success",
      timer: 1000,
      showConfirmButton: false,
    });

    topicFormMode.value = "create";

    topicForm.value = {
      title: "",
      order: "",
    };
    await fetchDatas();
  }
}

async function fetchTopicData(row) {
  const { data, error } = await supabase
    .from("benefit_topics")
    .select("*")
    .eq("id", row.id)
    .single();

  if (error) {
    const resultError = await Swal.fire({
      title: "Error!",
      text: "Error, Try Again!",
      icon: "success",
      timer: 5000,
      showConfirmButton: false,
    });
  }

  topicForm.value = data;
  topicFormMode.value = "edit";
}

async function fetchDatas() {
  const { data: topics, error } = await supabase
    .from("benefit_topics")
    .select("*")
    .order("order", { ascending: true });
  topicLists.value = topics;

  const { data: issuance, error: issuanceError } = await supabase
    .from("legal_issuances")
    .select("*");
  issuanceLists.value = issuance;
}

onMounted(fetchDatas);

const issuanceFormMode = ref("create");
const issuanceForm = ref({
  topic_id: "",
  title: "",
  description: "",
  issued_date: "",
  drive_link: "",
});

async function submitIssuance() {
  const cut = (issuanceForm.value.drive_link =
    issuanceForm.value.drive_link.slice(0, -16));
  const final = issuanceForm.value.drive_link + "preview";
  if (issuanceFormMode.value === "create") {
    const { data, error } = await supabase.from("legal_issuances").insert({
      topic_id: issuanceForm.value.topic_id,
      title: issuanceForm.value.title,
      description: issuanceForm.value.description,
      issued_date: issuanceForm.value.issued_date || null,
      drive_link: final,
    });

    if (error) {
      const resultError = await Swal.fire({
        title: "Error!",
        text: error.message,
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
      });
    }

    const resultSuccess = await Swal.fire({
      title: "Success!",
      text: "Issuance has been successfully Added",
      icon: "success",
      timer: 1000,
      showConfirmButton: false,
    });

    issuanceFormMode.value = "create";
    issuanceForm.value = {
      topic_id: "",
      title: "",
      description: "",
      issued_date: "",
      drive_link: "",
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
  <div class="container-fluid">
    <div class="row mt-4">
      <div class="col-md-4">
        <form @submit.prevent="submitTopicForm">
          <div class="card">
            <div class="card-header">
              <h3>Topics Form</h3>
            </div>
            <div class="card-body">
              <input type="hidden" v-model="topicForm.id" />
              <div class="form-group mb-3">
                <label for="">Topic Name:</label>
                <input
                  type="text"
                  class="form-control"
                  required
                  v-model="topicForm.title"
                />
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-success px-5 m-2 float-end">
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
        <form @submit.prevent="submitIssuance">
          <div class="card">
            <div class="card-header">
              <h3>Legal Issuance Form</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label for="">Benefit Topic:</label>
                    <select
                      class="form-select"
                      required
                      v-model="issuanceForm.topic_id"
                    >
                      <option value="" disabled>Select a Topic</option>
                      <option
                        :value="topic.id"
                        v-for="topic in topicLists"
                        :key="topic.id"
                      >
                        {{ topic.title }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label for="">Title:</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="DBM Circular..."
                      v-model="issuanceForm.title"
                      required
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label for="">Date Issued:</label>
                    <input
                      type="date"
                      class="form-control"
                      v-model="issuanceForm.issued_date"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label for="">Google Drive Link:</label>
                    <input
                      type="text"
                      class="form-control"
                      required
                      v-model="issuanceForm.drive_link"
                    />
                    <small
                      >Right-Click File, Share then paste the link here</small
                    >
                  </div>
                </div>
                <div class="form-group mb-3">
                  <label for="">Description:</label>
                  <textarea
                    class="form-control"
                    rows="4"
                    placeholder="Short Description of Issuance...."
                    v-model="issuanceForm.description"
                  ></textarea>
                </div>
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
    </div>

    <hr />

    <div class="row">
      <div class="col-md-4 mb-3" v-for="topic in topicLists" :key="topic.id">
        <div class="accordion" :id="'accordionTopic' + topic.id">
          <div class="accordion-item">
            <h2 class="accordion-header d-flex align-items-center">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                :data-bs-target="'#collapseTopic' + topic.id"
              >
                <strong>
                  {{ topic.title }}
                </strong>
              </button>
              <div class="d-flex gap-1 px-2">
                <button
                  type="button"
                  class="btn btn-sm btn-warning"
                  title="Edit Topic"
                  @click.stop="fetchTopicData(topic)"
                >
                  <i class="fa-solid fa-pen-to-square"></i>
                </button>
              </div>
            </h2>

            <div
              :id="'collapseTopic' + topic.id"
              class="accordion-collapse collapse"
              :data-bs-parent="'#accordionTopic' + topic.id"
            >
              <div class="accordion-body">
                <div
                  v-for="issuance in issuanceLists.filter(
                    (i) => i.topic_id === topic.id,
                  )"
                  :key="issuance.id"
                  class="mb-3 pb-2 border-bottom"
                >
                  <div class="d-flex justify-content-between align-items-start">
                    <strong>{{ issuance.title }}</strong>
                    <div class="d-flex gap-1">
                      <button
                        type="button"
                        class="btn btn-sm btn-warning"
                        title="Edit Issuance"
                        @click="editIssuance(issuance)"
                      >
                        <i class="fa-solid fa-pen-to-square"></i>
                      </button>
                    </div>
                  </div>
                  <p class="small text-muted mb-1">
                    {{ issuance.description }}
                  </p>
                  <small class="d-block mb-1">{{ issuance.issued_date }}</small>
                  <a :href="issuance.drive_link" target="_blank" class="small">
                    <i class="bi bi-file-earmark-pdf"></i> View Document
                  </a>
                </div>

                <p
                  v-if="!issuanceLists.some((i) => i.topic_id === topic.id)"
                  class="text-muted small mb-0"
                >
                  No issuances yet.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="container-fluid mt-4">
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
                  <input type="hidden" v-model="topicForm.id" />
                  <div class="form-group mb-3">
                    <label for="">Topic Name:</label>
                    <input
                      type="text"
                      class="form-control"
                      required
                      v-model="topicForm.title"
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
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(row, index) in topicLists" :key="index">
                      <td class="align-middle text-center">{{ index + 1 }}</td>
                      <td class="align-middle">{{ row.title }}</td>
                      <td class="align-middle text-center">
                        <button
                          type="button"
                          class="btn btn-warning btn-sm"
                          @click="fetchTopicData(row)"
                        >
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
      <div
        class="tab-pane fade"
        id="pills-profile"
        role="tabpanel"
        aria-labelledby="pills-profile-tab"
        tabindex="0"
      >
        <div class="row mt-4">
          <div class="col-md-4">
            <form @submit.prevent="submitIssuance">
              <div class="card">
                <div class="card-header">
                  <h3>Accomplishment Form</h3>
                </div>
                <div class="card-body">
                  <div class="form-group mb-3">
                    <label for="">Benefit Topic:</label>
                    <select
                      name=""
                      class="form-select"
                      v-model="issuanceForm.topic_id"
                    >
                      <option value="">Select a Topic</option>
                      <option
                        :value="topic.id"
                        v-for="(topic, index) in topicLists"
                      >
                        {{ topic.title }}
                      </option>
                    </select>
                  </div>
                  <div class="form-group mb-3">
                    <label for="">Title:</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="DBM Circular..."
                      v-model="issuanceForm.title"
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
                      v-model="issuanceForm.description"
                    ></textarea>
                  </div>
                  <div class="form-group mb-3">
                    <label for="">Date Issued:</label>
                    <input
                      type="date"
                      class="form-control"
                      required
                      v-model="issuanceForm.issued_date"
                    />
                  </div>
                  <div class="form-group mb-3">
                    <label for="">Google Drive Link:</label>
                    <input
                      type="text"
                      class="form-control"
                      required
                      v-model="issuanceForm.drive_link"
                    />
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
                    <tr v-for="(legal, index) in issuanceLists" :key="index">
                      <td class="align-middle text-center">{{ index + 1 }}</td>
                      <td class="align-middle">
                        {{ legal.benefit_topics?.title }}
                      </td>
                      <td class="align-middle">
                        {{ legal.title }}
                      </td>
                      <td class="align-middle text-center">
                        {{
                          new Date(legal.issued_date).toLocaleDateString(
                            "en-us",
                            {
                              year: "numeric",
                              month: "long",
                              day: "numeric",
                            },
                          )
                        }}
                      </td>
                      <td class="align-middle text-center">
                        <a :href="legal.drive_link" target="_blank">
                          <i
                            class="bi bi-file-earmark-pdf-fill text-danger"
                          ></i>
                          View
                        </a>
                      </td>
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
  </div> -->
</template>
