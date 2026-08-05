<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { supabase } from "@/lib/supabase";

const email = ref("");
const password = ref("");
const errorMsg = ref("");
const loading = ref(false);
const router = useRouter();

async function handleLogin() {
  errorMsg.value = "";
  loading.value = true;

  const { error } = await supabase.auth.signInWithPassword({
    email: email.value,
    password: password.value,
  });

  loading.value = false;

  if (error) {
    errorMsg.value = error.message;
    return;
  }

  router.push({ name: "AdminDashboard" });
}
</script>

<template>
  <div
    class="d-flex align-items-center justify-content-center"
    style="min-height: 100vh; background: #eef0f5"
  >
    <div
      class="card border-0 shadow-sm p-4"
      style="width: 100%; max-width: 400px"
    >
      <div class="text-center mb-4">
        <img
          src="/img/capiz-logo.png"
          alt="PBO Logo"
          style="width: 70px; height: 70px"
          class="mb-3"
        />
        <h5 class="fw-bold mb-0" style="color: var(--navy-deep, #0d2436)">
          PBO Admin
        </h5>
        <p class="text-muted small">Provincial Budget Office</p>
      </div>

      <div v-if="errorMsg" class="alert alert-danger py-2">{{ errorMsg }}</div>

      <form @submit.prevent="handleLogin">
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input v-model="email" type="email" class="form-control" required />
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input
            v-model="password"
            type="password"
            class="form-control"
            required
          />
        </div>

        <button
          type="submit"
          class="btn w-100"
          style="background: var(--navy, #123a56); color: #fff"
        >
          {{ loading ? "Logging in..." : "Login" }}
        </button>
      </form>
    </div>
  </div>
</template>
