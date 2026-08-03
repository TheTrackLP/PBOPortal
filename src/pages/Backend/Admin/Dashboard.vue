<script setup>
import { useRouter } from "vue-router";
import { supabase } from "@/lib/supabase";

const router = useRouter();

async function handleLogout() {
  await supabase.auth.signOut();
  router.push({ name: "AdminLogin" });
}
</script>

<template>
  <router-view />
</template>
