<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    isHome: Boolean
})

const emit = defineEmits(['scrollToTop']);

const goToSection = (elementId) => {
    const element = document.getElementById(elementId);
    if (element) {
        // Calculate header height (adjust selector as needed)
        const headerHeight = document.querySelector('header')?.offsetHeight || 0;
        const offset = headerHeight + 20; // Additional 20px padding

        // Get element's position relative to viewport
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
}
</script>


<template>
    <header
        class="w-full bg-gradient-to-br from-[#79cd37] via-[#b6e89c] to-[#3c9cbc] shadow-2xl sticky top-0 left-0 right-0 z-50 border-b-4 border-green-600 backdrop-blur-md">
        <nav class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 justify-between items-center">
                <!-- Logo and Title -->
                <div class="flex items-center gap-3">
                    <img src="images/logo/logomain.png" alt="Barangay Logo"
                        class="h-14 w-14 rounded-full border-2 border-green-600 shadow bg-white p-1" />
                    <Link :href="route('home')"
                        class="flex-shrink-0 text-2xl font-extrabold text-green-800 drop-shadow-lg tracking-wide lg:block hidden bg-white/80 px-4 py-2 rounded-lg">
                    Barangay San Jose Tagaytay City

                    </Link>
                </div>
                <!-- Desktop Navigation links -->
                <div class="space-x-4 hidden lg:flex">
                    <button v-if="isHome" @click="emit('scrollToTop')"
                        class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg transition-all text-lg font-bold shadow">
                        Home
                    </button>
                    <Link v-else :href="route('home')"
                        class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg transition-all text-lg font-bold shadow">
                    Home
                    </Link>
                    <a href="#services" @click.prevent="goToSection('services')"
                        class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg transition-all text-lg font-bold shadow">
                        Services
                    </a>
                    <a href="#about" @click.prevent="goToSection('about')"
                        class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg transition-all text-lg font-bold shadow">
                        About
                    </a>
                    <a href="#news-events" @click.prevent="goToSection('news-events')"
                        class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg transition-all text-lg font-bold shadow">
                        News & Events
                    </a>
                    <a href="#contact" @click.prevent="goToSection('contact')"
                        class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg transition-all text-lg font-bold shadow">
                        Contact
                    </a>
                </div>
                <!-- Burger Button -->
                <button
                    class="lg:hidden flex flex-col justify-center items-center w-12 h-12 rounded-md hover:bg-green-200 transition"
                    @click="mobileMenu = !mobileMenu" aria-label="Open Menu">
                    <span class="block w-7 h-1 bg-green-800 rounded transition-all duration-300"
                        :class="mobileMenu ? 'rotate-45 translate-y-2' : ''"></span>
                    <span class="block w-7 h-1 bg-green-800 rounded my-1 transition-all duration-300"
                        :class="mobileMenu ? 'opacity-0' : ''"></span>
                    <span class="block w-7 h-1 bg-green-800 rounded transition-all duration-300"
                        :class="mobileMenu ? '-rotate-45 -translate-y-2' : ''"></span>
                </button>
            </div>
            <!-- Mobile Menu -->
            <transition name="fade">
                <div v-if="mobileMenu"
                    class="lg:hidden absolute top-20 left-0 w-full bg-gradient-to-br from-[#79cd37] via-[#b6e89c] to-[#3c9cbc] shadow-2xl border-b-4 border-green-600 z-40">
                    <div class="flex flex-col items-center py-6 space-y-2">
                        <button v-if="isHome" @click="emit('scrollToTop'); mobileMenu = false"
                            class="w-11/12 text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg transition-all text-lg font-bold shadow text-left">
                            Home
                        </button>
                        <Link v-else to="/" @click="mobileMenu = false"
                            class="w-11/12 text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg transition-all text-lg font-bold shadow text-left">
                        Home
                        </Link>
                        <a href="#services" @click.prevent="goToSection('services')"
                            class="w-11/12 text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg transition-all text-lg font-bold shadow text-left">
                            Services
                        </a>
                        <a href="#about" @click.prevent="goToSection('about')"
                            class="w-11/12 text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg transition-all text-lg font-bold shadow text-left">
                            About
                        </a>
                        <a href="#news-events" @click.prevent="goToSection('news-events')"
                            class="w-11/12 text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg transition-all text-lg font-bold shadow text-left">
                            News & Events
                        </a>
                        <a href="#contact" @click.prevent="goToSection('contact')"
                            class="w-11/12 text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg transition-all text-lg font-bold shadow text-left">
                            Contact
                        </a>
                    </div>
                </div>
            </transition>
        </nav>
    </header>
</template>
