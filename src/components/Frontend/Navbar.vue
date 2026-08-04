<script setup>
import Home from "../../pages/Frontend/Home.vue";
import { supabase } from "@/lib/supabase";
import { onMounted, ref } from "vue";

const aboutContents = ref(null);

onMounted(async () => {
  const { data, error } = await supabase
    .from("aboutcontents")
    .select("*")
    .eq("id", 1)
    .single();
  aboutContents.value = data;
});
</script>

<template>
  <div class="topbar py-1">
    <div
      class="container d-flex justify-content-between align-items-center flex-wrap"
    >
      <div>
        <span class="me-3"
          ><i class="fa-solid fa-phone"></i>{{ aboutContents?.name }}</span
        >
        <span><i class="fa-solid fa-envelope"></i> {{}}</span>
      </div>
      <div
        class="small text-uppercase"
        style="letter-spacing: 0.04em; opacity: 0.8"
      >
        Republic of the Philippines
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-office py-3">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="/img/capiz-logo.png" class="brand-seal" alt="..." />
        <span class="brand-text">
          <strong class="font-display text-white"
            >Provincial Budget Office</strong
          >
          <small>Provincial Capitol, Roxas City, Capiz</small>
        </span>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#mainNav"
      >
        <i class="fa-solid fa-bars text-white"></i>
      </button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link to="/" exact-active-class="active" class="nav-link"
              >Home</router-link
            >
          </li>
          <li class="nav-item">
            <router-link to="/about" active-class="active" class="nav-link"
              >About</router-link
            >
          </li>
          <li class="nav-item">
            <router-link
              to="/accomplishments"
              active-class="active"
              class="nav-link"
              >Accomplishments</router-link
            >
          </li>
          <li class="nav-item">
            <router-link to="/staff" active-class="active" class="nav-link"
              >Staff</router-link
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">News</a>
          </li>
          <li class="nav-item">
            <router-link to="/contactus" active-class="active" class="nav-link"
              >Contact Us</router-link
            >
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
