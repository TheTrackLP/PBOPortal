<script setup>
import { supabase } from "@/lib/supabase";
import { onMounted, ref } from "vue";

const contactData = ref(null);

onMounted(async () => {
  const { data, error } = await supabase
    .from("settings")
    .select("*")
    .eq("id", 5)
    .single();

  contactData.value = data;
});
</script>

<style>
.contact-img {
  width: 100%;
  max-width: 50rem;
  height: auto;
  object-fit: cover;
  border-radius: 0.5rem;
}
</style>

<template>
  <div>
    <section class="hero">
      <div class="container text-center">
        <h1 class="font-display fw-bold">Contact Us</h1>
        <p class="mb-0 text-white-50">We would love to speak with you.</p>
        <p class="mb-0 text-white-50">
          Feel free to reach out using the below details.
        </p>
      </div>
    </section>
    <div class="">
      <div class="row mx-3 my-3 mb-4 g-4">
        <div class="col-md-6 text-center">
          <img
            src="/img/capiz.jpg"
            alt="Capiz Provincial Seal"
            class="contact-img img-fluid"
          />
        </div>
        <div class="col-md-6 d-flex align-items-center">
          <ul class="list-unstyled mx-5">
            <li class="d-flex align-items-center mb-3">
              <div>
                <strong>Phone</strong><br />
                <i class="fa-solid fa-phone"></i>{{ contactData?.contact }}
              </div>
            </li>
            <li class="d-flex align-items-center mb-3">
              <div>
                <strong>Email</strong><br />
                <i class="fa-solid fa-at"></i> {{ contactData?.email }}
              </div>
            </li>
          </ul>
        </div>
      </div>
      <hr />
      <div class="row mx-3 mt-5 g-4 d-flex align-items-center">
        <div class="col-md-6">
          <ul class="list-unstyled mx-5">
            <li class="d-flex align-items-center mb-3">
              <div>
                <strong>Address</strong><br />
                <i class="fa-solid fa-location-dot"></i>
                {{ contactData?.address }}
              </div>
            </li>
          </ul>
        </div>
        <div class="col-md-6 d-flex align-items-center">
          <iframe
            :src="contactData?.map_url"
            width="1000"
            height="600"
            style="border: 0"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="strict-origin-when-cross-origin"
          ></iframe>
        </div>
      </div>
    </div>
  </div>
</template>
