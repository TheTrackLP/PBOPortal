<script setup>
import { supabase } from "@/lib/supabase";
import { computed, onMounted, ref } from "vue";

const divList = ref([]);

onMounted(async () => {
  const { data, error } = await supabase.from("divisions").select("*");
  divList.value = data;
});

const headcActingList = ref([]);
const staffList = ref([]);
async function fetchHeadActing() {
  const { data, error } = await supabase
    .from("staff")
    .select("*")
    .in("category", ["head", "acting_head"])
    .order("order", { ascending: true })
    .eq("is_active", true);
  headcActingList.value = data;
}
async function fetchStaffs() {
  const { data, error } = await supabase
    .from("staff")
    .select("*")
    .eq("category", "staff")
    .order("order", { ascending: true })
    .eq("is_active", true);

  staffList.value = data;
}

const selectedDivision = ref("all");

function selectDivision(id) {
  selectedDivision.value = id;
}

const filteredStaff = computed(() => {
  if (selectedDivision.value === "all") {
    return staffList.value;
  } else {
    return staffList.value.filter(
      (d) => d.divisionid === selectedDivision.value,
    );
  }
});

onMounted(fetchHeadActing);
onMounted(fetchStaffs);
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
      <div class="container text-center">
        <h1 class="font-display fw-bold">Meet Our Staff</h1>
        <p class="mb-0 text-white-50">
          The people behind the Provincial Budget Office — dedicated to serving
          our Capiznons every day.
        </p>
      </div>
    </section>
    <section class="py-5">
      <div class="container text-center">
        <div
          class="card mb-3 shadow"
          v-for="(lead, index) in headcActingList"
          :key="index"
        >
          <div class="row g-0">
            <div class="col-md-4">
              <div class="profile-section">
                <img :src="lead.photo" v-if="lead.photo" />
                <img src="/img/capiz-logo.png" v-else="" />
              </div>
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title uppercase">{{ lead.name }}</h5>
                <p class="card-text uppercase">
                  <strong>{{ lead.position }}</strong>
                </p>
                <p class="card-text uppercase">{{ lead.designation }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="pb-5">
      <div class="container">
        <div class="filter-pills float-end">
          <button
            @click="selectDivision('all')"
            class="filter-pill"
            :class="{ active: selectedDivision === 'all' }"
          >
            All
          </button>
          <button
            class="filter-pill"
            v-for="(div, index) in divList"
            :key="index"
            @click="selectDivision(div.id)"
            :class="{ active: selectedDivision === div.id }"
          >
            {{ div.name }}
          </button>
        </div>
        <h2 class="font-display" style="font-size: 1.6rem">Staff Directory</h2>
      </div>
    </section>
    <section class="pb-5">
      <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col" v-for="(staff, index) in filteredStaff" :key="index">
            <div class="card shadow">
              <img
                :src="staff.photo"
                class="card-img-top"
                v-if="staff.photo"
                alt="..."
              />
              <img
                src="/img/capiz-logo.png"
                class="card-img-top"
                v-else=""
                alt="..."
              />
              <div class="card-body text-center">
                <h5 class="card-title uppercase">{{ staff.name }}</h5>
                <p class="card-text uppercase">
                  <strong>{{ staff.position }}</strong>
                </p>
                <p class="card-text uppercase">({{ staff.designation }})</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
