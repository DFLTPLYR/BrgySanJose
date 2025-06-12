<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link :href="route('home')"
        class="absolute top-4 left-4 px-3 py-1 bg-white/80 rounded shadow text-sm text-gray-700 hover:bg-[#0D98BA] transition">
    ← Back
    </Link>
</template>
