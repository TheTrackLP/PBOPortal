<script setup></script>

<template>
  <router-view>
    <div class="container-fluid">
      <div class="mb-4">
        <h3 class="fw-bold" style="color: var(--navy-deep, #0d2436)">
          Welcome back, Admin
        </h3>
        <p class="text-muted">
          Here's what's happening with your office portal.
        </p>
      </div>

      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <p class="mb-0">Dashboard content goes here.</p>
        </div>
      </div>
    </div>
  </router-view>
</template>
