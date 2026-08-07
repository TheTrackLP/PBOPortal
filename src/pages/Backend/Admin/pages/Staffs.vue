<script setup>
import { supabase } from "@/lib/supabase";
import { ref, onMounted } from "vue";
import Swal from "sweetalert2";
import draggable from "vuedraggable";

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

onMounted(async () => {
  const { data, error } = await supabase.from("divisions").select("*");
  divData.value = data;
});

const StaffLists = ref([]);
async function fetchStaffLists() {
  const { data, error } = await supabase
    .from("staff")
    .select(
      `
    *,
    divisions (name)
  `,
    )
    .order("order", { ascending: true });
  StaffLists.value = data;
}
onMounted(fetchStaffLists);

async function onDragEnd() {
  const result = await Swal.fire({
    title: "Success!",
    text: "Staff hierarchy has been successfully rearranged",
    icon: "success",
    timer: 1500,
    showConfirmButton: false,
  });
  const updates = StaffLists.value.map((item, index) =>
    supabase.from("staff").update({ order: index }).eq("id", item.id),
  );
  // for (const [index, item] of StaffLists.value.entries()) {
  //   const { data: checkOrder } = await supabase
  //     .from("staff")
  //     .select("*")
  //     .eq("id", item.id)
  //     .single();

  //   if (checkOrder.order === 0 && checkOrder.is_active === true) {
  //     await supabase
  //       .from("staff")
  //       .update({ category: "head" })
  //       .eq("id", item.id)
  //       .single();
  //   }
  //   if (checkOrder.order === 1 && checkOrder.is_active === true) {
  //     await supabase
  //       .from("staff")
  //       .update({ category: "acting_head" })
  //       .eq("id", item.id)
  //       .single();
  //   }
  //   const { error } = await supabase
  //     .from("staff")
  //     .update({ order: index })
  //     .eq("id", item.id);
  // }
  await Promise.all(updates);
  await fetchStaffLists();
}

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

const selectPhotoFile = ref(null);
const previewPhotoFile = ref(null);

const handlePhotoView = (event) => {
  const file = event.target.files[0];
  if (file) {
    selectPhotoFile.value = file;
    previewPhotoFile.value = URL.createObjectURL(file);
    staffForm.value.photo = file;
  }
};

async function submitStaffData() {
  if (submitStaffMode.value === "create") {
    submitStaffMode.value = "create";
    if (!selectPhotoFile.value) {
      const resultSuccess = await Swal.fire({
        title: "Error!",
        text: "Please Provide and Image",
        icon: "error",
        timer: 1000,
        showConfirmButton: false,
      });
      return;
    }

    const fileName = `${selectPhotoFile.value.name}`;

    const { error: uploadError } = await supabase.storage
      .from("staff")
      .upload(fileName, selectPhotoFile.value);

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
      .from("staff")
      .getPublicUrl(fileName);

    const publicUrl = urlData.publicUrl;

    const { data, error } = await supabase.from("staff").insert({
      name: staffForm.value.name,
      position: staffForm.value.position,
      designation: staffForm.value.designation,
      photo: publicUrl,
      category: staffForm.value.category,
      divisionid: staffForm.value.divisionid,
      is_active: 1,
    });

    submitStaffMode.value = "create";

    if (error) {
      const resultError = await Swal.fire({
        title: "Error!",
        text: "Error, Try Again inserting an image!",
        icon: "error",
        timer: 1500,
        showConfirmButton: false,
      });
      return;
    }

    const resultSuccess = await Swal.fire({
      title: "Success!",
      text: "Staff has been successfully Added",
      icon: "success",
      timer: 1500,
      showConfirmButton: false,
    });
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
    previewPhotoFile.value = null;
  } else {
    submitStaffMode.value = "edit";

    if (!selectPhotoFile.value) {
      const { error } = await supabase
        .from("staff")
        .update({
          name: staffForm.value.name,
          position: staffForm.value.position,
          designation: staffForm.value.designation,
          category: staffForm.value.category,
          divisionid: staffForm.value.divisionid,
          is_active: 1,
        })
        .eq("id", staffForm.value.id);

      const resultSuccess = await Swal.fire({
        title: "Success!",
        text: "Staff has been successfully Updated",
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
      });
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
      previewPhotoFile.value = null;
      return;
    }

    const newFileUpdate = `${selectPhotoFile.value.name}`;

    const { error: uploadError } = await supabase.storage
      .from("staff")
      .update(newFileUpdate, selectPhotoFile.value);

    if (uploadError) {
      const resultError = await Swal.fire({
        title: "Error!",
        text: "Error, Try Again inserting an image!",
        icon: "error",
        timer: 1500,
        showConfirmButton: false,
      });
      return;
    }

    const { data: urlData } = supabase.storage
      .from("staff")
      .getPublicUrl(newFileUpdate);

    const publicUrl = urlData.publicUrl;

    const { error } = await supabase
      .from("staff")
      .update({
        name: staffForm.value.name,
        position: staffForm.value.position,
        designation: staffForm.value.designation,
        photo: publicUrl,
        category: staffForm.value.category,
        divisionid: staffForm.value.divisionid,
        is_active: 1,
      })
      .eq("id", staffForm.value.id);

    submitStaffMode.value = "";

    if (error) {
      const resultError = await Swal.fire({
        title: "Error!",
        text: "Error, Try Again!",
        icon: "error",
        timer: 1500,
        showConfirmButton: false,
      });
      return;
    }

    const resultSuccess = await Swal.fire({
      title: "Success!",
      text: "Staff has been successfully Updated",
      icon: "success",
      timer: 1500,
      showConfirmButton: false,
    });
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
    previewPhotoFile.value = null;
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

  const resultSuccess = await Swal.fire({
    title: "Success!",
    text: "Staff Status Changed",
    icon: "success",
    timer: 1500,
    showConfirmButton: false,
  });
}
</script>
<template>
  <div>
    <div class="container-fluid">
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
                      @change="handlePhotoView"
                    />
                  </div>
                  <div class="col-md-6 form-group mb-3" v-if="previewPhotoFile">
                    <label for=""></label>
                    <img class="" :src="previewPhotoFile" width="200" />
                  </div>
                  <div class="col-md-6 form-group mb-3" v-else>
                    <label for=""></label>
                    <img class="" src="/img/capiz-logo.png" width="200" />
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
                    <label for="">Designation</label>
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
                <draggable
                  v-model="StaffLists"
                  item-key="id"
                  tag="tbody"
                  @end="onDragEnd"
                  handle=".drag-handle"
                >
                  <template #item="{ element: staff, index }">
                    <tr>
                      <td
                        class="drag-handle text-center align-middle"
                        style="cursor: grab"
                      >
                        ☰
                      </td>
                      <td class="align-middle text-center">
                        <img
                          :src="`${staff.photo}`"
                          alt=""
                          v-if="staff.photo"
                          width="100"
                        />
                        <img
                          src="/img/capiz-logo.png"
                          alt=""
                          width="100"
                          v-else
                        />
                      </td>
                      <td class="align-middle uppercase">
                        {{ staff.name }}
                      </td>
                      <td class="align-middle uppercase">
                        <p class="mb-0">
                          <strong>{{ staff.position }}</strong>
                        </p>
                        <p class="mb-0" v-if="staff.designation">
                          ({{ staff.designation }})
                        </p>
                        <p class="mb-0" v-else></p>
                      </td>
                      <td class="align-middle text-center">
                        {{ staff.divisions?.name }}
                      </td>
                      <td class="align-middle text-center">
                        <span
                          class="badge text-bg-success"
                          v-if="staff.is_active === true"
                          >Active</span
                        >
                        <span
                          class="badge text-bg-danger"
                          v-if="staff.is_active === false"
                          >Inactive</span
                        >
                      </td>
                      <td class="align-middle text-center">
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
                  </template>
                </draggable>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
