<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const selectedPreview = ref(null);
const previewPhoto = ref(null);

const props = defineProps({
    settings: Object,
});

const form = useForm({
    id: props.settings?.id ?? "",
    name: props.settings?.name ?? "",
    address: props.settings?.address ?? "",
    contact: props.settings?.contact ?? "",
    email: props.settings?.email ?? "",
    map_url: props.settings?.map_url ?? "",
    photo: props.settings?.photo ?? "",
});

const preview = (event) => {
    const file = event.target.files[0];
    if (file) {
        selectedPreview.value = file;
        previewPhoto.value = URL.createObjectURL(file);
        form.photo = file;
    }
};

function submit() {
    if (props.settings?.id === null) {
        form.post(route("settings.update"), {
            preserveScroll: true,
        });
    }
    form.post(route("settings.update", props.settings.id), {
        preserveScroll: true,
    });
}
</script>
<script>
import AdminLayout from "@/Layouts/Backend/AdminLayout.vue";

export default {
    layout: AdminLayout,
};
</script>
<template>
    <div>
        <div class="container py-4">
            <h3 class="mb-4">Office Settings</h3>
            <form @submit.prevent="submit">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" v-model="form.id" />
                                <label class="form-label">Office Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.name,
                                    }"
                                    v-model="form.name"
                                />
                                <div
                                    class="invalid-feedback"
                                    v-if="form.errors.name"
                                >
                                    {{ form.errors.name }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Office Address</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.address,
                                    }"
                                    v-model="form.address"
                                />
                                <div
                                    class="invalid-feedback"
                                    v-if="form.errors.address"
                                >
                                    {{ form.errors.address }}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Map Embed URL</label>
                            <input
                                type="text"
                                class="form-control"
                                :class="{
                                    'is-invalid': form.errors.map_url,
                                }"
                                v-model="form.map_url"
                                placeholder="Paste Google Maps embed src here"
                            />
                            <div
                                class="invalid-feedback"
                                v-if="form.errors.map_url"
                            >
                                {{ form.errors.map_url }}
                            </div>
                            <small class="text-muted">
                                Google Maps → Share → Embed a map → copy the src
                                URL.
                            </small>
                        </div>
                        <div class="mb-4" v-if="form.map_url">
                            <label class="form-label d-block">Preview</label>
                            <iframe
                                :src="form.map_url"
                                width="100%"
                                height="300"
                                style="border: 0"
                                loading="lazy"
                            ></iframe>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Number</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.contact,
                                    }"
                                    v-model="form.contact"
                                />
                                <div
                                    class="invalid-feedback"
                                    v-if="form.errors.contact"
                                >
                                    {{ form.errors.contact }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Address</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    :class="{ 'is-invalid': form.errors.email }"
                                    v-model="form.email"
                                />
                                <div
                                    class="invalid-feedback"
                                    v-if="form.errors.email"
                                >
                                    {{ form.errors.email }}
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="mb-3">
                            <label class="form-label">Office Photo</label>
                            <input
                                type="file"
                                class="form-control"
                                accept="/img/settings"
                                :class="{
                                    'is-invalid': form.errors.photo,
                                }"
                                @change="preview"
                            />
                            <div
                                class="invalid-feedback"
                                v-if="form.errors.photo"
                            >
                                {{ form.errors.photo }}
                            </div>
                        </div>
                        <div class="mb-4" v-if="previewPhoto">
                            <label class="form-label d-block">Preview</label>
                            <iframe
                                :src="previewPhoto"
                                width="100%"
                                height="300"
                                style="border: 0"
                                loading="lazy"
                            ></iframe>
                        </div>
                        <div class="mb-4" v-else>
                            <label class="form-label d-block">Preview</label>
                            <iframe
                                :src="form.photo"
                                width="100%"
                                height="300"
                                style="border: 0"
                                loading="lazy"
                            ></iframe>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end gap-2">
                        <button
                            type="submit"
                            class="btn btn-primary"
                            :disabled="form.processing"
                        >
                            <span
                                v-if="form.processing"
                                class="spinner-border spinner-border-sm me-1"
                            ></span>
                            Save Settings
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
