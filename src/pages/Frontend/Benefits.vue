<script setup>
import { supabase } from "@/lib/supabase";
import { onMounted, ref } from "vue";

const fetchTopicLists = ref([]);
const fetchIssuanceLists = ref([]);

async function fetchTopicIssuanceData() {
  const { data: topic, error: topicError } = await supabase
    .from("benefit_topics")
    .select("*")
    .order("order", { ascending: true });
  fetchTopicLists.value = topic;

  const { data: issuance, error: issuanceError } = await supabase
    .from("legal_issuances")
    .select("*");
  fetchIssuanceLists.value = issuance;
}

onMounted(fetchTopicIssuanceData);
</script>

<style scoped>
@media (max-width: 767.98px) {
  .page-header {
    padding: 2rem 0 1.75rem;
  }
}

/* Topic accordion */
.accordion-item {
  border: none;
  border-radius: 0.75rem !important;
  overflow: hidden;
  margin-bottom: 1rem;
  box-shadow: 0 2px 10px rgba(11, 37, 69, 0.06);
}
.accordion-button {
  font-weight: 600;
  color: var(--navy-dark);
  background-color: #fff;
}
.accordion-button:not(.collapsed) {
  background-color: var(--navy);
  color: #fff;
}

.accordion-button:focus {
  box-shadow: none;
  border-color: transparent;
}
.accordion-button::after {
  filter: none;
}

.circular-item {
  border: 1px solid #edf0f4;
  border-radius: 0.6rem;
  padding: 0.9rem 1rem;
  margin-bottom: 0.7rem;
  background: #fff;
  transition:
    box-shadow 0.15s ease,
    transform 0.15s ease;
}
.circular-item:hover {
  box-shadow: 0 4px 14px rgba(11, 37, 69, 0.1);
  transform: translateY(-1px);
}
.circular-item:last-child {
  margin-bottom: 0;
}
.circular-title {
  font-weight: 600;
  color: var(--navy-dark);
  font-size: 0.96rem;
}
.circular-desc {
  color: #55627a;
  font-size: 0.87rem;
  margin: 0.2rem 0 0.4rem;
}
.circular-meta {
  font-size: 0.78rem;
  color: #8a94a6;
}
.btn-view {
  border: 1px solid var(--navy);
  color: var(--navy);
  font-size: 0.8rem;
  font-weight: 600;
  border-radius: 0.4rem;
  white-space: nowrap;
}
.btn-view:hover {
  background-color: var(--navy);
  color: #fff;
}
.btn-view i {
  margin-right: 0.3rem;
}

.empty-state {
  text-align: center;
  padding: 3rem 1rem;
  color: #8a94a6;
}
.empty-state i {
  font-size: 2.4rem;
  color: #c7cedb;
}
</style>

<template>
  <section class="py-5 hero">
    <div class="container text-center text-white">
      <h1 class="font-display fw-bold mb-2">
        Legal Bases on Government Employee Benefits
      </h1>
      <p class="mb-0 text-white-50">
        A quick-reference directory of DBM, CSC, and other issuances governing
        employee benefits — arranged by topic for easy lookup.
      </p>
    </div>
  </section>
  <section class="pv-4 mb-4">
    <div class="container">
      <div class="accordion" id="legalBasesAccordion">
        <div
          class="accordion-item"
          v-for="(row, index) in fetchTopicLists"
          :key="row.id"
        >
          <h2 class="accordion-header">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              :data-bs-target="'#collapseTopic' + row.id"
            >
              {{ row.title }}
            </button>
          </h2>

          <div
            :id="'collapseTopic' + row.id"
            class="accordion-collapse collapse"
            data-bs-parent="#legalBasesAccordion"
          >
            <div class="accordion-body bg-light">
              <div
                class="circular-item d-flex justify-content-between align-items-start flex-wrap gap-2"
                v-for="issuance in fetchIssuanceLists.filter(
                  (i) => i.topic_id === row.id,
                )"
                :key="issuance.id"
              >
                <div>
                  <div class="circular-title">{{ issuance.title }}</div>
                  <div class="circular-desc">{{ issuance.description }}</div>
                  <div class="circular-meta">
                    <i class="bi bi-calendar3 me-1"></i
                    >{{ issuance.issued_date }}
                  </div>
                </div>
                <a
                  :href="issuance.drive_link"
                  target="_blank"
                  class="btn btn-view btn-sm"
                >
                  <i class="bi bi-file-earmark-pdf"></i>View Document
                </a>
              </div>

              <p
                v-if="!row.issuances || row.issuances.length === 0"
                class="text-muted small mb-0"
              >
                No issuances yet.
              </p>
            </div>
          </div>
        </div>

        <p
          v-if="!fetchTopicLists || fetchTopicLists.length === 0"
          class="text-muted"
        >
          No legal bases available yet.
        </p>
      </div>
    </div>
  </section>
</template>
