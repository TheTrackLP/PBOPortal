<script setup>
import { supabase } from "@/lib/supabase";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const newsView = ref(null);

onMounted(async () => {
  const { data } = await supabase
    .from("news")
    .select("*")
    .eq("title", route.params.title)
    .single();
  newsView.value = data;
});
</script>

<template>
  <section class="hero">
    <div class="container text-white">
      <h1 class="font-display fw-bold mt-3 mb-2">{{ newsView?.title }}</h1>
      <p class="text-white-50 mb-0">
        <i class="bi bi-calendar3"></i>
        {{
          new Date(newsView?.published_date).toLocaleDateString("en-us", {
            year: "numeric",
            month: "long",
            day: "numeric",
          })
        }}
      </p>
    </div>
  </section>
  <section class="py-5" style="background: #eef0f5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card border-0 shadow-sm">
            <img
              :src="newsView?.cover_image"
              alt="News cover"
              class="w-100"
              style="max-height: 420px; object-fit: fill"
              v-if="newsView?.cover_image"
            />
            <img
              src="/img/capiz-logo.png"
              alt="News cover"
              class="w-100"
              style="max-height: 420px; object-fit: fill"
              v-else
            />
            <div class="card-body p-4 p-md-5">
              <p class="mb-0" style="white-space: pre-line; line-height: 1.8">
                {{ newsView?.content }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
