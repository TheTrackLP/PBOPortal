<script setup>
import { supabase } from "@/lib/supabase";
import { ref, onMounted } from "vue";

const divData = ref([]);
const staffForm = ref({
  name: "",
  position: "",
  designation: "",
  photo: "",
  category: "staff",
  order: "",
  divisionid: "",
  is_active: 1,
});

const submitStaffMode = ref(false);
const successMsg = ref("");
const errorMsg = ref("");

onMounted(async () => {
  const { data, error } = await supabase.from("divisions").select("*");
  divData.value = data;
});

const StaffLists = ref([]);
onMounted(async () => {
  const { data, error } = await supabase.from("staff").select(`
    *,
    divisions (*)
  `);
  StaffLists.value = data;
});

async function submitStaffData() {
  submitStaffMode.value = true;
  successMsg.value = "";
  errorMsg.value = "";

  const { error } = await supabase.from("staff").insert({
    name: staffForm.value.name,
    position: staffForm.value.position,
    designation: staffForm.value.designation,
    photo: staffForm.value.photo,
    category: staffForm.value.category,
    divisionid: staffForm.value.divisionid,
    is_active: 1,
  });

  submitStaffMode.value = false;

  if (error) {
    errorMsg.value = error.message;
    return;
  }

  successMsg.value = "Staff added successfully!";

  staffForm.value = {
    name: "",
    position: "",
    designation: "",
    photo: "",
    category: "",
    order: "",
    divisionid: "",
    is_active: 1,
  };
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
                    <input type="text" v-model="staffForm.id" />
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
                    <option v-for="(div, index) in divData" :value="div.id">
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
                  Create
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
                    <th class="text-center">Position/designation</th>
                    <th class="text-center">Division</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(staff, index) in StaffLists" :key="index">
                    <td class="text-center">Order</td>
                    <td class="text-center">Photo</td>
                    <td class="text-center">
                      <p>{{ staff.name }}</p>
                    </td>
                    <td class="text-center">Position/designation</td>
                    <td class="text-center">
                      <p>
                        {{ staff.divisions?.name }}
                      </p>
                    </td>
                    <td class="text-center">
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
                    <td class="text-center">
                      <button
                        type="button"
                        class="btn btn-success"
                        :class="
                          staff.is_active ? 'btn-success' : btn - secondary
                        "
                        @click="toggleActive(staff)"
                      >
                        {{ staff.is_active ? "Active" : "Inactive" }}
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
