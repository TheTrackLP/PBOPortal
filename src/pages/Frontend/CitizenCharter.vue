<script setup>
import { supabase } from "@/lib/supabase";
import { onMounted, ref } from "vue";

const currentCharter = ref(null);

async function fetchCurrentCharter() {
  const { data, error } = await supabase
    .from("citizens_charter")
    .select("*")
    .eq("is_current", true)
    .single();
  currentCharter.value = data;
}
onMounted(fetchCurrentCharter);
</script>

<template>
  <section class="py-5" style="background: var(--navy, #123a56)">
    <div class="container text-center text-white">
      <h1 class="font-display fw-bold mb-2">Citizen's Charter</h1>
      <p class="mb-0 text-white-50">
        A guide to our office's services, requirements, and processing times
      </p>
    </div>
  </section>
  <section class="py-5" style="background: #eef0f5">
    <div class="container">
      <iframe
        :src="currentCharter?.file_url"
        width="100%"
        height="800px"
        style="border: none"
      ></iframe>
    </div>
  </section>
</template>
