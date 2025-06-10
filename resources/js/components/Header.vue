<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    isHome: Boolean
})

const emit = defineEmits(['scrollToTop']);
const scrollToSection = (elementId) => {
    const element = document.getElementById(elementId)
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'start',
        })
    }
}
</script>


<template>
    <header class="w-screen bg-green-500 shadow-lg top-0 left-0 right-0 z-50">
        <nav class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 justify-between items-center">
                <!-- Group logo and title together -->
                <div class="flex items-center gap-2">
                    <img src="/images/logo/logomain.png" alt="" class="h-14 w-14" />
                    <Link :href="route('home')" class="flex-shrink-0">
                    <h1 class="text-2xl font-bold text-white lg:block hidden">
                        Barangay San Jose Tagaytay
                    </h1>
                    </Link>
                </div>

                <!-- Navigation links -->
                <div class="space-x-8 hidden lg:flex">
                    <Link :href="route('home')"
                        class="text-white hover:text-yellow-400 px-4 py-2 transition-colors text-lg font-bold"
                        v-if="!isHome">
                    Home
                    </Link>
                    <button @click="emit('scrollToTop')" v-else
                        class="text-white hover:text-yellow-400 px-4 py-2 transition-colors text-lg font-bold">
                        Home
                    </button>
                    <a href="#services" @click.prevent="scrollToSection('services')"
                        class="text-white hover:text-yellow-400 px-4 py-2 transition-colors text-lg font-bold">
                        Services
                    </a>
                    <a href="#about" @click.prevent="scrollToSection('about')"
                        class="text-white hover:text-yellow-400 px-4 py-2 transition-colors text-lg font-bold">About</a>
                    <a href="#news-events" @click.prevent="scrollToSection('news-events')"
                        class="text-white hover:text-yellow-400 px-4 py-2 transition-colors text-lg font-bold">News &
                        Events
                    </a>
                    <a href="#contact" @click.prevent="scrollToSection('contact')"
                        class="text-white hover:text-yellow-400 px-4 py-2 transition-colors text-lg font-bold">Contact
                    </a>
                </div>
            </div>
        </nav>
    </header>
</template>
