<script setup>
import { inject } from "vue";
import { useRouter } from "vue-router";
import { supabase } from "@/lib/supabase";

const router = useRouter();

const adminProfile = inject("adminProfile");

async function handleLogout() {
  await supabase.auth.signOut();
  router.push({ name: "AdminLogin" });
}
</script>

<template>
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <img src="/img/capiz-logo.png" class="seal" />
      <div>
        <div class="name">PBO Admin</div>
        <div class="sub">Control Panel</div>
      </div>
    </div>

    <div>
      <div class="sidebar-section-label">Overview</div>
      <router-link
        to="/admin/dashboard"
        exact-active-class="active"
        class="nav-link-custom"
        ><i class="bi bi-speedometer"></i> Dashboard</router-link
      >
      <div class="sidebar-section-label">Content</div>
      <a href="#" class="nav-link-custom"
        ><i class="fa-solid fa-newspaper"></i> News &amp; Announcements</a
      >
      <router-link
        to="/admin/staff"
        active-class="active"
        class="nav-link-custom"
        ><i class="bi bi-people-fill"></i> Staff Directory</router-link
      >
      <router-link
        to="/admin/accomplishments"
        active-class="active"
        class="nav-link-custom"
        ><i class="bi bi-building"></i> Accomplishments</router-link
      >
      <!-- <a href="#" class="nav-link-custom"
        ><i class="bi bi-tools"></i> Services</a
      > -->
      <router-link
        to="/admin/about"
        active-class="active"
        class="nav-link-custom"
        ><i class="bi bi-info-lg"></i> About</router-link
      >
      <div class="sidebar-section-label">System</div>
      <!-- <a href="#" class="nav-link-custom"
        ><i class="bi bi-person-fill-gear"></i> Users &amp; Roles</a
      > -->

      <router-link
        to="/admin/settings"
        active-class="active"
        class="nav-link-custom"
        ><i class="bi bi-gear-fill"></i> Site Settings</router-link
      >
    </div>

    <div class="sidebar-footer">
      <div class="d-flex gap-4 justify-content-between align-items-center">
        <div class="user">
          <img src="/img/capiz-logo.png" alt="" class="avatar" srcset="" />
          <div>
            <div class="uname">{{ adminProfile?.full_name }}</div>
            <div class="urole">{{ adminProfile?.role }}</div>
          </div>
        </div>
        <button class="btn btn-sm btn-danger" @click="handleLogout">
          <i class="fa-solid fa-power-off"></i>
        </button>
      </div>
    </div>
  </aside>
</template>
