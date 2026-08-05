<script setup>
import { supabase } from "@/lib/supabase";
import { onMounted, ref } from "vue";

const aboutUsData = ref(null);
const fetchMandateList = ref([]);

onMounted(async () => {
  const { data, error } = await supabase
    .from("aboutcontents")
    .select("*")
    .eq("id", 1)
    .single();

  aboutUsData.value = data;

  const { data: mandates } = await supabase.from("mandates").select("*");
  fetchMandateList.value = mandates;
});
</script>

<style scoped>
:root {
  --gold: #c9a227;
}
body {
  background: #fff;
}

.card-mvm {
  border: 1px solid #e9e5db;
  transition:
    box-shadow 0.15s ease,
    transform 0.15s ease;
}
.card-mvm:hover {
  box-shadow: 0 0.5rem 1.25rem rgba(0, 0, 0, 0.06);
  transform: translateY(-2px);
}
</style>
<template>
  <section class="hero">
    <div class="container position-relative">
      <h1 class="font-display fw-bold">About the Office</h1>
      <p class="lead mb-4">
        The Provincial Budget Office oversees the preparation, review, and
        monitoring of the province's annual budget — guided by the Local
        Government Code and grounded in transparent, accountable governance.
      </p>
    </div>
  </section>
  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card card-mvm h-100 shadow-sm">
            <div class="card-body p-4">
              <div class="icon-circle mb-3">
                <i class="bi bi-bullseye"></i>
              </div>
              <h5 class="fw-bold">{{ aboutUsData?.mission_title }}</h5>
              <p class="mb-0 text-secondary">
                {{ aboutUsData?.mission_content }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-mvm h-100 shadow-sm">
            <div class="card-body p-4">
              <div class="icon-circle mb-3">
                <i class="bi bi-eye-fill"></i>
              </div>
              <h5 class="fw-bold">{{ aboutUsData?.vision_title }}</h5>
              <p class="mb-0 text-secondary">
                {{ aboutUsData?.vision_content }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-mvm h-100 shadow-sm">
            <div class="card-body p-4">
              <div class="icon-circle mb-3">
                <i class="bi bi-shield-check"></i>
              </div>
              <h5 class="fw-bold">{{ aboutUsData?.org_title }}</h5>
              <p class="mb-0 text-secondary">
                {{ aboutUsData?.org_content }}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="card mt-5 shadow border-0">
        <div class="card-body p-4 p-md-5">
          <div class="text-center mb-4">
            <h5 class="fw-bold mb-2">Mandate</h5>
            <p class="text-secondary mb-0">
              The budget officer shall take charge of the budget office and
              shall:
            </p>
          </div>
          <ol class="list-group list-group-numbered list-group-flush">
            <li
              class="list-group-item px-0 py-3"
              v-for="(item, index) in fetchMandateList"
              :key="index"
            >
              {{ item.content }}
            </li>
          </ol>
        </div>
      </div>
    </div>
  </section>
</template>
