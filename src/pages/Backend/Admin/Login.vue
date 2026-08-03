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
    class="container d-flex justify-content-center align-items-center"
    style="min-height: 100vh"
  >
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px">
      <h4 class="mb-3 text-center">Admin Login</h4>

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
        <button type="submit" class="btn btn-primary w-100" :disabled="loading">
          {{ loading ? "Logging in..." : "Login" }}
        </button>
      </form>
    </div>
  </div>
</template>
