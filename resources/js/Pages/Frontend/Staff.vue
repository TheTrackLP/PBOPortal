<script setup>
import { ref, computed } from "vue";

const selectedDivision = ref("all");

const filteredStaff = computed(() => {
    if (selectedDivision.value === "all") {
        return props.staffs;
    }
    return props.staffs.filter((s) => s.divisionid === selectedDivision.value);
});
function selectDivision(id) {
    selectedDivision.value = id;
}

const props = defineProps({
    leadership: Array,
    staffs: Array,
    divisions: Array,
});
</script>

<script>
import AppLayout from "@/Layouts/Frontend/AppLayout.vue";
import { defineAsyncComponent } from "vue";
export default {
    layout: AppLayout,
};
</script>
<style scoped>
img {
    width: 200px;
    height: 200px;
    object-fit: cover;
    margin: 0 auto 0.5rem;
}
.card {
    border: 0px !important;
}
.filter-pills {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}
.filter-pill {
    border: 1px solid #d7dce6;
    background: #fff;
    color: #4b5468;
    padding: 0.4rem 1rem;
    border-radius: 999px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.15s ease;
}
.filter-pill:hover {
    border-color: var(--gold);
    color: var(--navy);
}
.filter-pill.active {
    background: var(--navy);
    border-color: var(--navy);
    color: #fff;
}
</style>
<template>
    <div>
        <section class="hero">
            <div class="container position-relative">
                <h1 class="font-display fw-bold">Meet Our Staff</h1>
                <p class="lead mb-0">
                    The people behind the Provincial Budget Office — dedicated
                    to serving our Capiznons every day.
                </p>
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                <div
                    class="card mb-3"
                    v-for="(lead, index) in leadership"
                    :key="index"
                >
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="profile-section">
                                <img src="/img/no-image.jpg" />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ lead.name }}</h5>
                                <p class="card-text">
                                    {{ lead.position }}
                                </p>
                                <p class="card-text">
                                    {{
                                        lead.designation ? lead.designation : ""
                                    }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pb-5">
            <div class="container">
                <div class="filter-pills float-end">
                    <button @click="selectDivision('all')" class="filter-pill">
                        All
                    </button>
                    <button
                        class="filter-pill"
                        v-for="(div, index) in divisions"
                        :key="index"
                        @click="selectDivision(div.id)"
                    >
                        {{ div.name }}
                    </button>
                </div>
                <h2 class="font-display" style="font-size: 1.6rem">
                    Staff Directory
                </h2>
            </div>
        </section>
        <section class="pb-5">
            <div class="container">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div
                        class="col"
                        v-for="(staff, index) in filteredStaff"
                        :key="index"
                    >
                        <div class="card">
                            <img
                                src="/img/no-image.jpg"
                                class="card-img-top"
                                alt="..."
                            />
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ staff.name }}</h5>
                                <p class="card-text">
                                    {{ staff.position }}
                                </p>
                                <p class="card-text">
                                    {{
                                        staff.designation
                                            ? staff.designation
                                            : ""
                                    }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
