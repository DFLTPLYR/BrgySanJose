<script setup>
import Footer from '@/components/Footer.vue';
import Header from '@/components/Header.vue';
import { usePage } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted, computed } from 'vue'

const page = usePage();
const isHome = computed(() => { return page.url === "/" })
</script>

<template>
    <div class="min-h-screen flex flex-col">
        <!-- Header slot -->
        <Header :is-home="isHome" />


        <main class="flex-grow flex">
            <slot />
        </main>


        <Footer :is-home="isHome" />
    </div>
</template>
