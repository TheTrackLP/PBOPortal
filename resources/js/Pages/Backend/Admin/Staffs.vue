<script setup>
import { router, useForm } from "@inertiajs/vue3";
import { computed, ref, watch } from "vue";
import draggable from "vuedraggable";

const staffFormMode = ref("create");
const staffForm = useForm({
    name: "",
    position: "",
    designation: "",
    photo: null,
    divisionid: "",
});

const selectPhotoFile = ref(null);
const previewPhotoFile = ref(null);

const handlePhotoView = (event) => {
    const file = event.target.files[0];
    if (file) {
        selectPhotoFile.value = file;
        previewPhotoFile.value = URL.createObjectURL(file);
        staffForm.photo = file;
    }
};

const staffDate = (staff) => {
    staffFormMode.value = "edit";
    staffForm.id = staff.id;
    staffForm.name = staff.name;
    staffForm.position = staff.position;
    staffForm.designation = staff.designation;
    staffForm.divisionid = staff.divisionid;
    previewPhotoFile.value = staff.photo;
};

const submitStaff = () => {
    if (staffFormMode.value === "create") {
        staffForm.post(route("staff.store"), {
            preserveScroll: true,
            onSuccess: () => {
                staffForm.reset();
                previewPhotoFile.value = null;
            },
        });
    } else {
        staffForm.post(route("staff.update", staffForm.id), {
            preserveScroll: true,
            onSuccess: () => {
                staffForm.reset();
                previewPhotoFile.value = null;
                staffFormMode.value = "create";
            },
        });
    }
};

const changeStatus = (staff) => {
    staffForm.post(route("staff.status", staff.id));
};

const props = defineProps({
    staffs: Array,
    divisions: Array,
});

const staffList = ref([...props.staffs]);
watch(
    () => props.staffs,
    (newVal) => {
        staffList.value = [...newVal];
    },
);

const saveOrder = () => {
    router.post(
        route("staff.update.order"),
        {
            order: staffList.value.map((s) => s.id),
        },
        {
            preserveScroll: true,
            preserveState: true,
        },
    );
};
</script>

<script>
import AdminLayout from "@/Layouts/Backend/AdminLayout.vue";
export default {
    layout: AdminLayout,
};
</script>
<template>
    <div>
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-md-4">
                    <form
                        @submit.prevent="submitStaff"
                        enctype="multipart/form-data"
                    >
                        <div class="card">
                            <div class="card-header">
                                <h3>Staff Form</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <input
                                        type="hidden"
                                        v-model="staffForm.id"
                                    />
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="">Image:</label>
                                        <input
                                            type="file"
                                            accept="/img/staff/*"
                                            class="form-control"
                                            @change="handlePhotoView"
                                        />
                                    </div>
                                    <div
                                        class="col-md-6 form-group mb-3"
                                        v-if="previewPhotoFile"
                                    >
                                        <label for=""></label>
                                        <img
                                            class=""
                                            :src="previewPhotoFile"
                                            width="200"
                                        />
                                    </div>
                                    <div
                                        class="col-md-6 form-group mb-3"
                                        v-else
                                    >
                                        <label for=""></label>
                                        <img
                                            class=""
                                            src="/img/no-image.jpg"
                                            width="200"
                                        />
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
                                        <label for="">Desgination</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="staffForm.designation"
                                        />
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Division</label>
                                    <select
                                        v-model="staffForm.divisionid"
                                        class="form-select"
                                    >
                                        <option value="">
                                            Select an Option
                                        </option>
                                        <option
                                            v-for="(div, index) in divisions"
                                            :value="div.id"
                                        >
                                            {{ div.name }}
                                        </option>
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
                                            : staffFormMode === "create"
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
                                        <th class="text-center">
                                            Position/Desgination
                                        </th>
                                        <th class="text-center">Division</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <draggable
                                    v-model="staffList"
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
                                            <td
                                                class="align-middle text-center"
                                            >
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
                                            <td
                                                class="align-middle text-center"
                                            >
                                                {{ staff.position }} |
                                                {{ staff.designation }}
                                            </td>
                                            <td
                                                class="align-middle text-center"
                                            >
                                                {{ staff.divname }}
                                            </td>
                                            <td
                                                class="align-middle text-center"
                                            >
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
                                            <td
                                                class="align-middle text-center"
                                            >
                                                <button
                                                    type="button"
                                                    class="btn btn-warning"
                                                    @click="staffDate(staff)"
                                                >
                                                    <i
                                                        class="fa-solid fa-pen-to-square"
                                                    ></i>
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-danger"
                                                    @click="changeStatus(staff)"
                                                    v-if="staff.isActive === 0"
                                                >
                                                    <i
                                                        class="fa-solid fa-user-xmark"
                                                    ></i>
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-success"
                                                    @click="changeStatus(staff)"
                                                    v-else-if="
                                                        staff.isActive === 1
                                                    "
                                                >
                                                    <i
                                                        class="fa-solid fa-user-check"
                                                    ></i>
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
