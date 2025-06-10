<script setup>
import Footer from '@/components/Footer.vue';
import Header from '@/components/Header.vue';
</script>

<template>
    <div class="min-h-screen flex flex-col">
        <!-- Header slot -->
        <Header />


        <main class="flex-grow">
            <slot />
        </main>


        <Footer />
    </div>
</template>
