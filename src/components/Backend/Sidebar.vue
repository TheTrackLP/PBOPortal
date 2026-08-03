<script setup></script>

<template>
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <img class="seal" />
      <div>
        <div class="name">PBO Admin</div>
        <div class="sub">Control Panel</div>
      </div>

      asdasd
    </div>

    <div>
      <div class="sidebar-section-label">Overview</div>
      <router-link
        to="/admin/staff"
        exact-active-class="active"
        class="nav-link-custom"
        ><i class="bi bi-speedometer"></i> Dashboard</router-link
      >
      <div class="sidebar-section-label">Content</div>
      <a href="#" class="nav-link-custom"> News &amp; Announcements</a>
      <router-link
        to="/admin/staff"
        active-class="active"
        class="nav-link-custom"
        ><i class="bi bi-people-fill"></i> Staff Directory</router-link
      >
      <router-link
        to="/admin/division"
        active-class="active"
        class="nav-link-custom"
        ><i class="bi bi-building"></i> Division</router-link
      >
      <a href="#" class="nav-link-custom"
        ><i class="bi bi-tools"></i> Services</a
      >
      <a class="nav-link-custom"><i class="bi bi-info-lg"></i> About</a>
      <div class="sidebar-section-label">System</div>
      <a href="#" class="nav-link-custom"
        ><i class="bi bi-person-fill-gear"></i> Users &amp; Roles</a
      >
      <a href="#" class="nav-link-custom"
        ><i class="bi bi-clock"></i> Activity Log</a
      >
      <a class="nav-link-custom"
        ><i class="bi bi-gear-fill"></i> Site Settings</a
      >
    </div>

    <div class="sidebar-footer">
      <div class="user">
        <div class="avatar">EC</div>
        <div>
          <div class="uname">Echo Cruz</div>
          <div class="urole">Administrator</div>
        </div>
      </div>
    </div>
  </aside>
</template>
