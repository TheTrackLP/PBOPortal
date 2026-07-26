<script setup>
import { Link, usePage } from "@inertiajs/vue3";
const page = usePage();
</script>

<template>
    <!-- Topbar -->
    <div class="topbar py-1">
        <div
            class="container d-flex justify-content-between align-items-center flex-wrap"
        >
            <div>
                <span class="me-3"
                    ><i class="fa-solid fa-phone"></i>(036) 000-0000</span
                >
                <span
                    ><i class="fa-solid fa-envelope"></i>
                    oca@example.gov.ph</span
                >
            </div>
            <div
                class="small text-uppercase"
                style="letter-spacing: 0.04em; opacity: 0.8"
            >
                Republic of the Philippines
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-office py-3">
        <div class="container">
            <a class="navbar-brand" href="#">
                <div class="brand-seal">O</div>
                <span class="brand-text">
                    <strong class="font-display text-white"
                        >Provincial Budget Office</strong
                    >
                    <small>Provincial Capitol, Roxas City, Capiz</small>
                </span>
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNav"
            >
                <i class="fa-solid fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :class="{ active: page.url === '/' }"
                            :href="route('home')"
                            >Home</Link
                        >
                    </li>
                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :class="{ active: page.url.startsWith('/about') }"
                            :href="route('about')"
                            >About</Link
                        >
                    </li>
                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :class="{ active: page.url.startsWith('/staff') }"
                            :href="route('staff')"
                            >Staff</Link
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
