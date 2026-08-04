<script setup>
// Your Supabase fetch logic goes here
</script>

<template>
  <section class="py-5" style="background: var(--navy, #123a56)">
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
        <button class="btn btn-primary btn-sm">All</button>
        <button class="btn btn-sm btn-outline-secondary">2026</button>
        <button class="btn btn-sm btn-outline-secondary">2025</button>
        <button class="btn btn-sm btn-outline-secondary">2024</button>
      </div>
    </div>
  </section>
  <section class="py-5" style="background: #eef0f5">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
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
              <div class="news-date">2026</div>
              <h6 class="fw-bold mt-1">Annual Budget Utilization Report</h6>
              <p class="text-secondary small mb-3">
                Summary of budget allocation and utilization for the fiscal
                year.
              </p>
              <a
                href="#"
                target="_blank"
                class="btn btn-outline-primary btn-sm mt-auto"
              >
                <i class="bi bi-eye"></i> View PDF
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
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
              <div class="news-date">2025</div>
              <h6 class="fw-bold mt-1">Mid-Year Accomplishment Report</h6>
              <p class="text-secondary small mb-3">
                Overview of key accomplishments for the first half of the year.
              </p>
              <a
                href="#"
                target="_blank"
                class="btn btn-outline-primary btn-sm mt-auto"
              >
                <i class="bi bi-eye"></i> View PDF
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
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
              <div class="news-date">2025</div>
              <h6 class="fw-bold mt-1">Year-End Financial Summary</h6>
              <p class="text-secondary small mb-3">
                Comprehensive year-end summary of financial performance.
              </p>
              <a
                href="#"
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
