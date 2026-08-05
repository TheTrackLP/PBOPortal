<script setup>
import Navbar from "@/components/Frontend/Navbar.vue";
import Footer from "@/components/Frontend/Footer.vue";
import { supabase } from "@/lib/supabase";
import { onMounted, provide, ref } from "vue";

const officeSettings = ref(null);

onMounted(async () => {
  const { data, error } = await supabase.from("settings").select("*").single();
  officeSettings.value = data;
});
provide("officeSettings", officeSettings);
</script>

<template>
  <body>
    <Navbar />
    <router-view />
    <Footer />
  </body>
</template>
