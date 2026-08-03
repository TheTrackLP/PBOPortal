<script setup>
import Navbar from "@/components/Frontend/Navbar.vue";
import Footer from "@/components/Frontend/Footer.vue";
</script>

<template>
  <body>
    <Navbar />
    <router-view />
    <Footer />
  </body>
</template>
