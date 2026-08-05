<script setup>
import Navbar from "@/components/Backend/Navbar.vue";
import Sidebar from "@/components/Backend/Sidebar.vue";
import { supabase } from "@/lib/supabase";
import { onMounted, provide, ref } from "vue";

const adminProfile = ref(null);

onMounted(async () => {
  const { data } = await supabase.from("profiles").select("*").single();
  adminProfile.value = data;
});

provide("adminProfile", adminProfile);
</script>
<style>
:root {
  --navy-deep: #0d2436;
  --navy: #123a56;
  --navy-light: #1c5478;
  --gold: #c99a3c;
  --gold-soft: #e8c877;
  --paper: #f5f3ee;
  --ink: #1c2733;
  --ink-soft: #5b6b7a;
  --line: #e2ddd0;
  --ok: #2f7a53;
  --warn: #b9791f;
  --danger: #a4342a;
  --font-display: "Lora", serif;
  --font-body: "Inter", sans-serif;
  --font-mono: "JetBrains Mono", monospace;
}
* {
  box-sizing: border-box;
}
body {
  background: var(--paper);
  color: var(--ink);
  margin: 0;
}
a {
  text-decoration: none;
}

/* ---------- Sidebar ---------- */
.sidebar {
  width: 250px;
  min-height: 100vh;
  background: var(--navy-deep);
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  display: flex;
  flex-direction: column;
  z-index: 1030;
}
.sidebar-brand {
  padding: 1.4rem 1.25rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  display: flex;
  align-items: center;
  gap: 0.7rem;
}
.sidebar-brand .seal {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  background: radial-gradient(
    circle at 35% 30%,
    var(--gold-soft),
    var(--gold) 70%
  );
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--navy-deep);
  font-weight: 700;
  font-size: 0.95rem;
  flex-shrink: 0;
}
.sidebar-brand .name {
  color: #fff;
  font-size: 0.92rem;
  line-height: 1.2;
  font-weight: 700;
}
.sidebar-brand .sub {
  color: rgba(255, 255, 255, 0.5);
  font-size: 0.68rem;
  letter-spacing: 0.06em;
  text-transform: uppercase;
}
.sidebar-section-label {
  color: rgba(255, 255, 255, 0.35);
  font-size: 0.66rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  padding: 1.1rem 1.25rem 0.4rem;
  font-weight: 600;
}
.nav-link-custom {
  color: rgba(255, 255, 255, 0.72);
  text-decoration: none;
  padding: 0.8rem 1.25rem;
  display: flex;
  align-items: center;
  gap: 1rem;
  font-size: 1rem;
  font-weight: 500;
  border-left: 3px solid transparent;
  transition: 0.15s;
}

.nav-link-custom:hover {
  background: rgba(255, 255, 255, 0.05);
  color: #fff;
}
.nav-link-custom.active {
  color: #fff;
  background: rgba(201, 154, 60, 0.14);
  border-left-color: var(--gold);
}
.sidebar-footer {
  margin-top: auto;
  padding: 1rem 1.25rem 1.4rem;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
}
.sidebar-footer .user {
  display: flex;
  align-items: center;
  gap: 0.6rem;
}
.sidebar-footer .avatar {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  background: var(--navy-light);
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.8rem;
  font-weight: 600;
}
.sidebar-footer .uname {
  color: #fff;
  font-size: 0.82rem;
  font-weight: 600;
}
.sidebar-footer .urole {
  color: rgba(255, 255, 255, 0.45);
  font-size: 0.7rem;
}

/* ---------- Main ---------- */
.main {
  margin-left: 250px;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}
.topbar {
  background: #fff;
  border-bottom: 1px solid var(--line);
  padding: 0.85rem 1.75rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: sticky;
  top: 0;
  z-index: 1020;
}
.topbar .page-title {
  font-weight: 700;
  font-size: 1.15rem;
  color: var(--navy-deep);
  margin: 0;
}
.topbar .page-eyebrow {
  font-size: 0.7rem;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--gold);
  font-weight: 700;
}
.content {
  padding: 1.75rem;
}

@media (max-width: 991.98px) {
  .sidebar {
    transform: translateX(-100%);
    transition: 0.2s;
  }
  .sidebar.show {
    transform: translateX(0);
  }
  .main {
    margin-left: 0;
  }
}
</style>

<template>
  <Sidebar />
  <div class="main">
    <Navbar />

    <router-view />
  </div>
</template>
