<style scoped>
@media (max-width: 767.98px) {
  .page-header {
    padding: 2rem 0 1.75rem;
  }
}

.btn-view {
  border: 1px solid var(--navy);
  color: var(--navy);
  white-space: nowrap;
}
.btn-view:hover {
  background-color: var(--navy);
  color: #fff;
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
      <div class="row mt-4 g-4">
        <div class="col-lg-3">
          <div class="card filter-card sticky-top" style="top: 1rem">
            <div class="card-header py-3">
              <i class="bi bi-funnel-fill me-1"></i> Browse by Topic
            </div>
            <div class="list-group list-group-flush">
              <a
                href="#topic-pera"
                class="list-group-item list-group-item-action active-topic d-flex justify-content-between align-items-center"
              >
                PERA
                <span class="badge badge-count rounded-pill">2</span>
              </a>
              <a
                href="#topic-rata"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
              >
                RATA
                <span class="badge badge-count rounded-pill">3</span>
              </a>
              <a
                href="#topic-myb"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
              >
                Mid-Year Bonus
                <span class="badge badge-count rounded-pill">2</span>
              </a>
              <a
                href="#topic-yeb"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
              >
                Year-End Bonus &amp; Cash Gift
                <span class="badge badge-count rounded-pill">2</span>
              </a>
              <a
                href="#topic-cna"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
              >
                CNA Incentive
                <span class="badge badge-count rounded-pill">3</span>
              </a>
              <a
                href="#topic-uca"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
              >
                Uniform / Clothing Allowance
                <span class="badge badge-count rounded-pill">2</span>
              </a>
              <a
                href="#topic-tlb"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
              >
                Terminal Leave Benefits
                <span class="badge badge-count rounded-pill">4</span>
              </a>
              <a
                href="#topic-loyalty"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
              >
                Loyalty Pay
                <span class="badge badge-count rounded-pill">2</span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="accordion" id="legalBasesAccordion">
            <div class="accordion-item" id="topic-pera" v-for="value in 5">
              <h2 class="accordion-header">
                <button
                  class="accordion-button"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapsePera"
                >
                  Personal Economic Relief Allowance (PERA)
                  <span class="badge topic-badge rounded-pill"
                    >2 issuances</span
                  >
                </button>
              </h2>
              <div
                id="collapsePera"
                class="accordion-collapse collapse show"
                data-bs-parent="#legalBasesAccordion"
              >
                <div class="accordion-body bg-light">
                  <div class="card">
                    <div>
                      <div class="card-header">
                        <a href="#" class="btn btn-view btn-sm float-end"
                          ><i class="bi bi-file-earmark-pdf"></i>View
                        </a>
                        <h6>DBM Budget Circular No. 2011-2</h6>
                      </div>
                      <div class="card-body">
                        Amendatory Rules on the Grant of Personal Economic
                        Relief Allowance (PERA)
                        <div class="text-muted small">
                          <i class="fa-solid fa-calendar-days"></i> September
                          26, 2011
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
