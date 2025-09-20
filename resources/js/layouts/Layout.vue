<script setup>
import Footer from '@/components/Footer.vue';
import Header from '@/components/Header.vue';
import Sidebar from '@/components/Sidebar.vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue'

const page = usePage();
const isHome = computed(() => { return page.url === "/" })
const isDashboard = computed(() => { return page.url.includes('/dashboard') })
</script>

<template>
    <div class="min-h-screen flex flex-col">
        <!-- Header slot -->
        <Header :is-home="isHome" />


        <main class="flex-grow" :class="isDashboard ? 'flex flex-row' : ''">
            <Sidebar v-if="isDashboard" />
            <slot />
        </main>


        <Footer :is-home="isHome" />
    </div>
</template>
