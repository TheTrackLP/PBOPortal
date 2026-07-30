<script setup>
import { Link, usePage } from "@inertiajs/vue3";
const page = usePage();
</script>

<template>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="img/capiz-logo.png" class="seal" />
            <div>
                <div class="name">PBO Admin</div>
                <div class="sub">Control Panel</div>
            </div>
        </div>

        <div>
            <div class="sidebar-section-label">Overview</div>
            <Link
                :class="{ active: page.url === '/admin' }"
                :href="route('admin.dash')"
                class="nav-link-custom"
                ><i class="fa-solid fa-gauge"></i> Dashboard</Link
            >
            <div class="sidebar-section-label">Content</div>
            <a href="#" class="nav-link-custom"
                ><i class="fa-solid fa-newspaper"></i> News &amp;
                Announcements</a
            >
            <Link
                :class="{ active: page.url.startsWith('/admin/staff') }"
                :href="route('admin.staff')"
                class="nav-link-custom"
                ><i class="fa-solid fa-users"></i> Staff Directory</Link
            >
            <Link
                :class="{ active: page.url.startsWith('/admin/division') }"
                :href="route('admin.div')"
                class="nav-link-custom"
                ><i class="fa-solid fa-building"></i> Division</Link
            >
            <a href="#" class="nav-link-custom"
                ><i class="fa-solid fa-toolbox"></i> Services</a
            >
            <div class="sidebar-section-label">System</div>
            <a href="#" class="nav-link-custom"
                ><i class="fa-solid fa-user-gear"></i> Users &amp; Roles</a
            >
            <a href="#" class="nav-link-custom"
                ><i class="fa-solid fa-clock"></i> Activity Log</a
            >
            <Link
                :class="{ active: page.url.startsWith('/admin/settings') }"
                :href="route('admin.settings')"
                class="nav-link-custom"
                ><i class="fa-solid fa-gear"></i> Site Settings</Link
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
