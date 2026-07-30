<script setup>
import { useForm } from "@inertiajs/vue3";
const diviForm = useForm({
    name: "",
});

const submitDiv = () => {
    diviForm.post(route("div.add"), {
        onSuccess: () => {
            diviForm.reset();
        },
    });
};

const props = defineProps({
    divisions: Array,
});
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
                    <form @submit.prevent="submitDiv">
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
                                        v-model="diviForm.name"
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
                                        <th class="text-center">No. Staff/s</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(div, index) in divisions"
                                        :key="index"
                                    >
                                        <td class="align-middle text-center">
                                            {{ index + 1 }}
                                        </td>
                                        <td class="align-middle">
                                            {{ div.name }}
                                        </td>
                                        <td class="align-middle text-center">
                                            exam[le]
                                        </td>
                                        <td class="align-middle text-center">
                                            <button class="btn btn-warning">
                                                <i
                                                    class="fa-solid fa-pen-to-square"
                                                ></i>
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
