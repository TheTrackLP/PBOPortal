<script setup>
import { supabase } from "@/lib/supabase";
import { ref, onMounted } from "vue";

const divData = ref([]);
const staffForm = ref({
  id: "",
  name: "",
  position: "",
  designation: "",
  photo: "",
  category: "staff",
  divisionid: null,
  is_active: 1,
});

const submitStaffMode = ref("create");
const successMsg = ref("");
const errorMsg = ref("");

onMounted(async () => {
  const { data, error } = await supabase.from("divisions").select("*");
  divData.value = data;
});

const StaffLists = ref([]);
async function fetchStaffLists() {
  const { data, error } = await supabase.from("staff").select(`
    *,
    divisions (name)
  `);
  StaffLists.value = data;
}
onMounted(fetchStaffLists);

async function fetchStaff(staff) {
  const { data, error } = await supabase
    .from("staff")
    .select("*")
    .eq("id", staff.id)
    .single();

  if (error) {
    console.error(error);
    return;
  }
  staffForm.value = data;
  submitStaffMode.value = "edit";
}

async function submitStaffData() {
  if (submitStaffMode.value === "create") {
    submitStaffMode.value = "create";
    successMsg.value = "";
    errorMsg.value = "";

    const { data, error } = await supabase.from("staff").insert({
      name: staffForm.value.name,
      position: staffForm.value.position,
      designation: staffForm.value.designation,
      photo: staffForm.value.photo,
      category: staffForm.value.category,
      divisionid: staffForm.value.divisionid,
      is_active: 1,
    });

    submitStaffMode.value = "create";

    if (error) {
      errorMsg.value = error.message;
      return;
    }

    successMsg.value = "Staff added successfully!";
    await fetchStaffLists();

    staffForm.value = {
      id: "",
      name: "",
      position: "",
      designation: "",
      photo: "",
      category: "staff",
      divisionid: null,
      is_active: 1,
    };
  } else {
    submitStaffMode.value = "edit";
    successMsg.value = "";
    errorMsg.value = "";

    const { error } = await supabase
      .from("staff")
      .update({
        name: staffForm.value.name,
        position: staffForm.value.position,
        designation: staffForm.value.designation,
        photo: staffForm.value.photo,
        category: staffForm.value.category,
        divisionid: staffForm.value.divisionid,
        is_active: 1,
      })
      .eq("id", staffForm.value.id);

    submitStaffMode.value = "";

    if (error) {
      errorMsg.value = error.message;
      return;
    }

    successMsg.value = "Staff Updated successfully!";

    staffForm.value = {
      id: "",
      name: "",
      position: "",
      designation: "",
      photo: "",
      category: "staff",
      divisionid: null,
      is_active: 1,
    };
  }
}
async function toggleActive(staff) {
  const newStatus = !staff.is_active;

  const { error } = await supabase
    .from("staff")
    .update({ is_active: newStatus })
    .eq("id", staff.id);

  if (error) {
    console.error(error.message);
    return;
  }

  staff.is_active = newStatus;
}
</script>
<template>
  <div>
    <div class="container-fluid">
      <div v-if="successMsg" class="alert alert-success">{{ successMsg }}</div>
      <div v-if="errorMsg" class="alert alert-danger">{{ errorMsg }}</div>
      <div class="row mt-4">
        <div class="col-md-4">
          <form @submit.prevent="submitStaffData" enctype="multipart/form-data">
            <div class="card">
              <div class="card-header">
                <h3>Staff Form</h3>
              </div>
              <div class="card-body">
                <div class="row mb-3">
                  <input type="hidden" />
                  <div class="col-md-6 form-group mb-3">
                    <input type="hidden" v-model="staffForm.id" />
                    <label for="">Image:</label>
                    <input
                      type="file"
                      accept="/img/staff/*"
                      class="form-control"
                    />
                  </div>
                  <div class="col-md-6 form-group mb-3">
                    <label for=""></label>
                    <img class="" width="200" />
                  </div>
                </div>
                <div class="form-group mb-3">
                  <label for="">Name:</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="staffForm.name"
                  />
                </div>
                <div class="row mb-3">
                  <div class="col-md-6 form-group">
                    <label for="">Position</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="staffForm.position"
                    />
                  </div>
                  <div class="col-md-6 form-group">
                    <label for="">designation</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="staffForm.designation"
                    />
                  </div>
                </div>
                <div class="form-group mb-3">
                  <label for="">Division</label>
                  <select v-model="staffForm.divisionid" class="form-select">
                    <option value="">Select an Option</option>
                    <option
                      v-for="(div, index) in divData"
                      :key="index"
                      :value="div.id"
                    >
                      {{ div.name }}
                    </option>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label">Category</label>
                  <select v-model="staffForm.category" class="form-select">
                    <option value="head">Head</option>
                    <option value="acting_head">Acting Head</option>
                    <option value="staff">Staff</option>
                  </select>
                </div>
              </div>
              <div class="card-footer">
                <button
                  type="submit"
                  class="btn btn-success px-5 m-2 float-end"
                >
                  {{
                    staffForm.processing
                      ? "Saving..."
                      : submitStaffMode === "create"
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
              <h3>Staff Directory</h3>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-hover">
                <thead class="table-dark">
                  <tr>
                    <th class="text-center">Order</th>
                    <th class="text-center">Photo</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Position/Designation</th>
                    <th class="text-center">Division</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(staff, index) in StaffLists" :key="index">
                    <td class="text-center align-middle">Order</td>
                    <td class="text-center align-middle">Photo</td>
                    <td class="text-center align-middle">
                      {{ staff.name }}
                    </td>
                    <td class="">
                      <p>{{ staff.position }}</p>
                      <p>{{ staff.designation }}</p>
                    </td>
                    <td class="text-center align-middle">
                      {{ staff.divisions?.name }}
                    </td>
                    <td class="text-center align-middle">
                      <span
                        class="badge rounded-pill text-bg-success"
                        v-if="staff.is_active === true"
                        >Active</span
                      >
                      <span
                        class="badge rounded-pill text-bg-danger"
                        v-else-if="staff.is_active === false"
                        >Inactive</span
                      >
                    </td>
                    <td class="text-center align-middle">
                      <button
                        type="button"
                        class="btn btn-warning"
                        @click="fetchStaff(staff)"
                      >
                        <i class="fa-solid fa-pen-to-square"></i>
                      </button>
                      <button
                        type="button"
                        class="btn btn-success"
                        @click="toggleActive(staff)"
                        v-if="staff.is_active === true"
                      >
                        <i class="fa-solid fa-circle-check"></i>
                      </button>
                      <button
                        type="button"
                        class="btn btn-danger"
                        @click="toggleActive(staff)"
                        v-else-if="staff.is_active === false"
                      >
                        <i class="fa-solid fa-circle-xmark"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
                <!-- <draggable
                  item-key="id"
                  tag="tbody"
                  @end="saveOrder"
                  handle=".drag-handle"
                >
                  <template #item="{ element: staff, index }">
                    <tr>
                      <td
                        class="drag-handle text-center align-middle"
                        style="cursor: grab"
                      >
                        ☰ {{ staff.order }}
                      </td>
                      <td class="align-middle text-center">
                        <img
                          :src="`${staff.photo}`"
                          alt=""
                          v-if="staff.photo"
                          width="100"
                        />
                        <img
                          src="/img/no-image.jpg"
                          alt=""
                          width="100"
                          v-else
                        />
                      </td>
                      <td class="align-middle">
                        {{ staff.name }}
                      </td>
                      <td class="align-middle text-center">
                        {{ staff.position }} |
                        {{ staff.designation }}
                      </td>
                      <td class="align-middle text-center">
                        {{ staff.divname }}
                      </td>
                      <td class="align-middle text-center">
                        <span
                          class="badge text-bg-success"
                          v-if="staff.isActive === 1"
                          >Active</span
                        >
                        <span
                          class="badge text-bg-danger"
                          v-if="staff.isActive === 0"
                          >Inactive</span
                        >
                      </td>
                      <td class="align-middle text-center">
                        <button
                          type="button"
                          class="btn btn-warning"
                          @click="staffDate(staff)"
                        >
                          <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button
                          type="button"
                          class="btn btn-danger"
                          @click="changeStatus(staff)"
                          v-if="staff.isActive === 0"
                        >
                          <i class="fa-solid fa-user-xmark"></i>
                        </button>
                        <button
                          type="button"
                          class="btn btn-success"
                          @click="changeStatus(staff)"
                          v-else-if="staff.isActive === 1"
                        >
                          <i class="fa-solid fa-user-check"></i>
                        </button>
                      </td>
                    </tr>
                  </template>
                </draggable> -->
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
