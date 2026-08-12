<script setup>
import { supabase } from "@/lib/supabase";
import { onMounted, ref } from "vue";

const newsLists = ref([]);

onMounted(async () => {
  const { data } = await supabase
    .from("news")
    .select("*")
    .order("published_date", { ascending: false })
    .eq("is_published", true);
  newsLists.value = data;
});
</script>

<template>
  <section class="hero">
    <div class="container text-center text-white">
      <h1 class="font-display fw-bold mb-2">News & Announcements</h1>
      <p class="mb-0 text-white-50">
        Latest updates from the Provincial Budget Office
      </p>
    </div>
  </section>

  <section class="py-5" style="background: #eef0f5">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4" v-for="(news, index) in newsLists" :key="index">
          <div class="news-card">
            <div class="news-thumb">
              <img
                :src="news.cover_image"
                :alt="news.title"
                class="w-100 h-100"
                style="object-fit: fill"
                v-if="news.cover_image"
              />
              <img
                src="/img/capiz-logo.png"
                :alt="news.title"
                class="w-100 h-100"
                style="object-fit: fill"
                v-else
              />
            </div>
            <div class="p-3">
              <div class="news-date">
                {{
                  new Date(news.published_date).toLocaleDateString("en-us", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                  })
                }}
              </div>
              <h6 class="fw-bold mt-1">{{ news.title }}</h6>
              <p class="text-secondary small mb-0 text-truncate-3">
                {{ news.content }}
              </p>
              <router-link
                :to="{ name: 'NewsView', params: { title: news.title } }"
                class="small fw-semibold"
                style="color: var(--navy, #123a56)"
                >Read more →</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.text-truncate-3 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
