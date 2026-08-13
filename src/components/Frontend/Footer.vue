<script setup>
import { inject } from "vue";

const officeSettings = inject("officeSettings");
</script>

<template>
  <footer class="footer-office">
    <div class="container py-5">
      <div class="row g-4">
        <div class="col-md-4">
          <h6 class="font-display mb-3">{{ officeSettings?.name }}</h6>
          <p class="text-muted-light mb-0">
            {{ officeSettings?.address }}
          </p>
          <p class="text-muted-light mb-0">
            {{ officeSettings?.room }}
          </p>
          <p class="text-muted-light mb-0">{{ officeSettings?.contact }}</p>
          <p class="text-muted-light mb-0">{{ officeSettings?.email }}</p>
        </div>
        <div class="col-md-4">
          <h6 class="font-display mb-3">Quick Links</h6>
          <ul class="list-unstyled">
            <li class="mb-2"><router-link to="/">Home</router-link></li>
            <li class="mb-2"><router-link to="/about">About</router-link></li>
            <li class="mb-2">
              <router-link to="/accomplishments">Accomplishments</router-link>
            </li>
            <li class="mb-2"><router-link to="/news">News</router-link></li>
            <li class="mb-2"><router-link to="/staff">Staff</router-link></li>
            <li class="mb-2">
              <router-link to="/citizencharter">Citizen Charter</router-link>
            </li>
            <li class="mb-0">
              <router-link to="/contactus">Contact</router-link>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <h6 class="font-display mb-3">Office Hours</h6>
          <p class="text-muted-light mb-0">Monday – Friday</p>
          <p class="text-muted-light mb-0">8:00 AM – 5:00 PM</p>
        </div>
      </div>
    </div>
    <div class="footer-bottom text-center py-3">
      &copy; {{ new Date().getFullYear() }} Provincial Budget Office. All rights
      reserved.
    </div>
  </footer>
</template>
