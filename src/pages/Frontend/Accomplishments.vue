<script setup>
import { supabase } from "@/lib/supabase";
import { computed, onMounted, ref } from "vue";

const selectedYear = ref("all");
const fetchAccomplishData = ref([]);

const filteredAccomplish = computed(() => {
  if (selectedYear.value === "all") {
    return fetchAccomplishData.value;
  }
  return fetchAccomplishData.value.filter(
    (item) => item.year === selectedYear.value,
  );
});
onMounted(async () => {
  const { data } = await supabase
    .from("accomplishments")
    .select("*")
    .order("order", { ascending: false });
  fetchAccomplishData.value = data;
});
const availableYears = computed(() => {
  const years = fetchAccomplishData.value.map((item) => item.year);
  return [...new Set(years)].sort((a, b) => b - a);
});
</script>

<template>
  <section class="py-5 hero">
    <div class="container text-center text-white">
      <h1 class="font-display fw-bold mb-2">Office Accomplishments</h1>
      <p class="mb-0 text-white-50">
        Annual reports and milestones of the Provincial Budget Office
      </p>
    </div>
  </section>
  <section class="py-4 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap gap-2 justify-content-center">
        <button
          class="btn btn-sm"
          :class="
            selectedYear === 'all' ? 'btn-primary' : 'btn-outline-secondary'
          "
          @click="selectedYear = 'all'"
        >
          All
        </button>
        <button
          v-for="year in availableYears"
          :key="year"
          class="btn btn-sm"
          :class="
            selectedYear === year ? 'btn-primary' : 'btn-outline-secondary'
          "
          @click="selectedYear = year"
        >
          {{ year }}
        </button>
      </div>
    </div>
  </section>
  <section class="py-5" style="background: #eef0f5">
    <div class="container">
      <div class="row g-4">
        <div
          class="col-md-4"
          v-for="(row, index) in filteredAccomplish"
          :key="index"
        >
          <div class="news-card h-100">
            <div
              class="news-thumb d-flex align-items-center justify-content-center"
              style="background: #dfe3ea"
            >
              <i
                class="bi bi-file-earmark-pdf-fill text-danger"
                style="font-size: 3rem"
              ></i>
            </div>
            <div class="p-3 d-flex flex-column">
              <div class="news-date">{{ row.year }}</div>
              <h6 class="fw-bold mt-1">{{ row.title }}</h6>
              <a
                :href="row.file"
                target="_blank"
                class="btn btn-outline-primary btn-sm mt-auto"
              >
                <i class="bi bi-eye"></i> View PDF
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- Empty state (shown when no data) -->
      <!--
      <p class="text-muted text-center py-5">No accomplishment reports available yet.</p>
      -->
    </div>
  </section>
</template>
