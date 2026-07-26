<script setup>
import { Link } from "@inertiajs/vue3";
import Navbar from "@/Components/Frontend/Navbar.vue";
import Footer from "@/Components/Frontend/Footer.vue";
</script>

<template>
    <body>
        <Navbar />
        <slot />
        <Footer />
    </body>
</template>
