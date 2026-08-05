<script setup>
import { supabase } from "@/lib/supabase";
import { onMounted, ref } from "vue";

const fetchAbout = ref(null);
const fetchAccomplishList = ref([]);

onMounted(async () => {
  const { data, error } = await supabase
    .from("aboutcontents")
    .select("*")
    .single();
  fetchAbout.value = data;

  const { data: accomplish } = await supabase
    .from("accomplishments")
    .select("*")
    .limit("3")
    .order("order", { ascending: false });
  fetchAccomplishList.value = accomplish;
});
</script>
<style scoped>
img {
  width: 300px;
  height: 200px;
  object-fit: cover;
  margin: 0 auto 0.5rem;
}
.card {
  border: 0px !important;
}
</style>
<template>
  <section class="hero">
    <div class="container position-relative">
      <h1 class="font-display fw-bold">Provincial Budget Office</h1>
      <p class="lead mb-4">
        Ensuring efficient, transparent, and responsive local governance for
        every resident of Roxas City.
      </p>
    </div>
  </section>
  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <i class="bi bi-bullseye mb-2 d-block"></i>
              <h5 class="font-display">{{ fetchAbout?.mission_title }}</h5>
              <p class="text-secondary small mb-0">
                {{ fetchAbout?.mission_content }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <i class="bi bi-eye-fill mb-2 d-block"></i>
              <h5 class="font-display">{{ fetchAbout?.vision_title }}</h5>
              <p class="text-secondary small mb-0">
                {{ fetchAbout?.vision_content }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <i class="bi bi-shield-check mb-2 d-block"></i>
              <h5 class="font-display">{{ fetchAbout?.org_title }}</h5>
              <p class="text-secondary small mb-0">
                {{ fetchAbout?.org_content }}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center mt-4">
        <router-link to="/about" class="text-decoration-none fw-semibold"
          >Read more about our office <i class="bi bi-arrow-right"></i
        ></router-link>
      </div>
    </div>
  </section>
  <section class="py-5" style="background: #eef0f5">
    <div class="container">
      <div
        class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-2"
      >
        <div>
          <h2 class="font-display section-title mb-0">Accomplishments</h2>
        </div>
        <router-link
          to="/accomplishments"
          class="text-decoration-none fw-semibold"
          style="color: var(--navy)"
          >View all <i class="bi bi-arrow-right"></i
        ></router-link>
      </div>
      <div class="row g-4">
        <div
          class="col-md-4"
          v-for="(row, index) in fetchAccomplishList"
          :key="index"
        >
          <div class="news-card">
            <div
              class="news-thumb d-flex align-items-center justify-content-center"
              style="background: #dfe3ea"
            >
              <i
                class="bi bi-file-earmark-pdf-fill text-danger"
                style="font-size: 3rem"
              ></i>
            </div>
            <div class="p-3">
              <div class="news-date">{{ row.year }}</div>
              <h6 class="fw-bold mt-1">{{ row.title }}</h6>
              <a :href="row.file" target="_blank" class="small">
                <i class="bi bi-eye"></i> View PDF
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5">
    <div class="container">
      <div class="text-center mb-5">
        <div class="section-eyebrow">What We Offer</div>
        <h2 class="font-display section-title">Our Services</h2>
      </div>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col services-hover">
          <div class="card">
            <img class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="text-secondary">
                This is a longer card with supporting text below as a natural
                lead-in to additional content. This content is a little bit
                longer.
              </p>
            </div>
          </div>
        </div>
        <div class="col services-hover">
          <div class="card">
            <img class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="text-secondary">
                This is a longer card with supporting text below as a natural
                lead-in to additional content.
              </p>
            </div>
          </div>
        </div>
        <div class="col services-hover">
          <div class="card">
            <img class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="text-secondary">
                This is a longer card with supporting text below as a natural
                lead-in to additional content. This content is a little bit
                longer.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5" style="background: #eef0f5">
    <div class="container">
      <div
        class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-2"
      >
        <div>
          <div class="section-eyebrow">Stay Updated</div>
          <h2 class="font-display section-title mb-0">
            Latest News & Announcements
          </h2>
        </div>
        <a
          href="#"
          class="text-decoration-none fw-semibold"
          style="color: var(--navy)"
          >View all <i class="bi bi-arrow-right"></i
        ></a>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="news-card">
            <div class="news-thumb"></div>
            <div class="p-3">
              <div class="news-date">July 20, 2026</div>
              <h6 class="fw-bold mt-1">Example</h6>
              <p class="text-secondary small mb-0">Example</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="news-card">
            <div class="news-thumb"></div>
            <div class="p-3">
              <div class="news-date">July 12, 2026</div>
              <h6 class="fw-bold mt-1">Example</h6>
              <p class="text-secondary small mb-0">Example.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="news-card">
            <div class="news-thumb"></div>
            <div class="p-3">
              <div class="news-date">July 3, 2026</div>
              <h6 class="fw-bold mt-1">Example</h6>
              <p class="text-secondary small mb-0">Example.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5">
    <div class="container">
      <div
        class="spotlight d-flex flex-column flex-md-row align-items-center gap-4"
      >
        <div class="spotlight-photo flex-shrink-0">
          <i class="bi bi-person-fill"></i>
        </div>
        <div class="">
          <div class="fw-bold">ATTY. KAREN L. LIPARDO</div>
          <div class="text-secondary small">
            ACTING PROVINCIAL BUDGET OFFICER
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="cta-strip py-4">
    <div
      class="container d-flex justify-content-between align-items-center flex-wrap gap-3"
    >
      <div>
        <h5 class="fw-bold mb-0">Need assistance from our office?</h5>
        <div class="small">We're here Monday to Friday, 8:00 AM – 5:00 PM.</div>
      </div>
      <a href="#" class="btn btn-dark px-4">Get in Touch</a>
    </div>
  </section>
</template>
