<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
const props = defineProps({
    about: Object,
    mandate: Array,
});

const aboutForm = useForm({
    id: props.about?.id ?? "",
    mission_title: props.about?.mission_title ?? "",
    mission_content: props.about?.mission_content ?? "",
    vision_title: props.about?.vision_title ?? "",
    vision_content: props.about?.vision_content ?? "",
    org_outcome_title: props.about?.org_outcome_title ?? "",
    org_outcome_content: props.about?.org_outcome_content ?? "",
});

const mandateForm = useForm({
    mandateArray: [],
});

const submitAbout = () => {
    aboutForm.post(route("about.change"));
};

const addMandate = () => {
    mandateForm.mandateArray.push({
        content: "",
    });
};

const submitMandate = () => {
    mandateForm.post(route("about.mandate"));
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
        <div class="container-fluid py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-0 fw-bold">Edit About Content</h4>
                    <p class="text-muted small mb-0">
                        Update the Mission, Vision, and Mandate shown on the
                        public About page.
                    </p>
                </div>
            </div>
            <form @submit.prevent="submitAbout">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm mb-3">
                            <input type="hidden" v-model="aboutForm.id" />
                            <div class="card-header bg-white border-bottom">
                                <h6 class="mb-0 fw-semibold">Mission</h6>
                            </div>
                            <div class="card-body">
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
                                        v-model="aboutForm.mission_title"
                                        value="Our Mission"
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
                                        v-model="aboutForm.mission_content"
                                        rows="6"
                                        placeholder="Enter the mission statement..."
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
                                    <label
                                        for="vision_title"
                                        class="form-label small fw-semibold"
                                        >Title</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="vision_title"
                                        v-model="aboutForm.vision_title"
                                        value="Our Vision"
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
                                        v-model="aboutForm.vision_content"
                                        rows="6"
                                        placeholder="Enter the vision statement..."
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-header bg-white border-bottom">
                                <h6 class="mb-0 fw-semibold">
                                    Organization Outcome
                                </h6>
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
                                        v-model="aboutForm.org_outcome_title"
                                        value="org_outcome"
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
                                        v-model="aboutForm.org_outcome_content"
                                        rows="6"
                                        placeholder="Enter the organization outcome..."
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
                            <i class="bi bi-list-check me-2 text-warning"></i
                            >Mandate Points
                        </h6>
                    </div>

                    <div class="card-body">
                        <div id="mandate-items" v-if="mandate">
                            <div
                                class="row g-2 align-items-start mandate-item mb-3"
                                v-for="(
                                    item, index
                                ) in mandateForm.mandateArray"
                                :key="index"
                            >
                                <div class="col-auto pt-2">
                                    <span
                                        class="badge bg-secondary rounded-circle p-2"
                                        >{{ index + 1 }}</span
                                    >
                                </div>
                                <div class="col">
                                    <textarea
                                        class="form-control"
                                        v-model="item.content"
                                        rows="2"
                                        placeholder="Enter mandate point..."
                                    ></textarea>
                                </div>
                                <div class="col-auto">
                                    <button
                                        type="button"
                                        class="btn btn-outline-danger btn-sm remove-item"
                                    >
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button
                            type="button"
                            class="btn btn-outline-warning btn-sm mt-2"
                            @click="addMandate"
                        >
                            <i class="bi bi-plus-lg me-1"></i>Add Mandate Point
                        </button>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
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
