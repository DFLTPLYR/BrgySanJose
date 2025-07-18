
<script setup>
import { ref, onMounted } from 'vue';
import Swal from 'sweetalert2'
import { Link, router, usePage } from '@inertiajs/vue3';

defineProps({
    isHome: Boolean
});

const { props } = usePage();
const mobileMenu = ref(false);

const scrollToTop = () => {
    if (typeof window !== 'undefined') {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
};

const goToSection = (elementId) => {
    const element = document.getElementById(elementId);
    if (element) {
        const headerHeight = document.querySelector('header')?.offsetHeight || 0;
        const offset = headerHeight + 20;

        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
};

function signOut() {
    router.post(route('logout'), {}, {
        onFinish: () => Swal.fire({
            title: "Logging out!",
            toast: true,
            timer: 1000,
            timerProgressBar: true,
            position: "top-right"
        }).then(() => {
            location.reload()
        })
    });
}
</script>

<template>
    <header
        class="w-full bg-gradient-to-br from-[#79cd37] via-[#b6e89c] to-[#3c9cbc] shadow-2xl sticky top-0 z-50 border-b-4 border-green-600 backdrop-blur-md">
        <nav class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 justify-between items-center">
                <!-- Logo and Title -->
                <div class="flex items-center gap-3">
                    <img src="images/logo/logomain.png" alt="Barangay Logo"
                        class="h-14 w-14 rounded-full border-2 border-green-600 shadow bg-white p-1" />
                    <Link :href="route('home')"
                        class="hidden lg:block text-2xl font-extrabold text-green-800 drop-shadow-lg tracking-wide bg-white/80 px-4 py-2 rounded-lg">
                        Barangay San Jose Tagaytay City
                    </Link>
                </div>

                <!-- Desktop Navigation -->
                <div class="space-x-4 hidden lg:flex">
                    <button v-if="isHome" @click.prevent="scrollToTop"
                        class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg text-lg font-bold shadow">
                        Home
                    </button>
                    <Link v-else :href="route('home')"
                        class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg text-lg font-bold shadow">
                        Home
                    </Link>

                    <template v-if="isHome">
                        <a href="#services" @click.prevent="goToSection('services')"
                            class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg text-lg font-bold shadow">
                            Services
                        </a>
                        <a href="#about" @click.prevent="goToSection('about')"
                            class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg text-lg font-bold shadow">
                            About
                        </a>
                        <a href="#news-events" @click.prevent="goToSection('news-events')"
                            class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg text-lg font-bold shadow">
                            News & Events
                        </a>
                        <a href="#contact" @click.prevent="goToSection('contact')"
                            class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg text-lg font-bold shadow">
                            Contact
                        </a>
                    </template>
                    <template v-else>
                        <Link :href="route('home') + '#services'"
                            class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg text-lg font-bold shadow">
                            Services
                        </Link>
                        <Link :href="route('home') + '#about'"
                            class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg text-lg font-bold shadow">
                            About
                        </Link>
                        <Link :href="route('home') + '#news-events'"
                            class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg text-lg font-bold shadow">
                            News & Events
                        </Link>
                        <Link :href="route('home') + '#contact'"
                            class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg text-lg font-bold shadow">
                            Contact
                        </Link>
                    </template>

                    <!-- Dropdown for Authenticated Users -->
                    <div class="relative group" v-if="props.auth">
                        <button
                            class="text-green-50 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg text-lg font-bold shadow flex items-center">
                            {{ props.auth.username }}
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div
                            class="absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 origin-top-right transition-all duration-300 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 z-50">
                            <div class="py-1">
                                <Link :href="route('dashboard')"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Dashboard
                                </Link>
                                <div class="border-t my-1"></div>
                                <button @click="signOut"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Burger -->
                <button @click="mobileMenu = !mobileMenu"
                    class="lg:hidden flex flex-col justify-center items-center w-12 h-12 rounded-md hover:bg-green-200 transition"
                    aria-label="Toggle Menu">
                    <span class="block w-7 h-1 bg-green-800 rounded transition-all duration-300"
                        :class="{ 'rotate-45 translate-y-2': mobileMenu }"></span>
                    <span class="block w-7 h-1 bg-green-800 rounded my-1 transition-all duration-300"
                        :class="{ 'opacity-0': mobileMenu }"></span>
                    <span class="block w-7 h-1 bg-green-800 rounded transition-all duration-300"
                        :class="{ '-rotate-45 -translate-y-2': mobileMenu }"></span>
                </button>
            </div>

            <!-- Mobile Menu -->
            <transition name="fade">
                <div v-if="mobileMenu"
                    class="lg:hidden absolute top-20 left-0 w-full bg-gradient-to-br from-[#79cd37] via-[#b6e89c] to-[#3c9cbc] shadow-2xl border-b-4 border-green-600 z-40">
                    <div class="flex flex-col items-center py-6 space-y-2">
                        <button v-if="isHome" @click.prevent="scrollToTop"
                            class="w-11/12 text-left text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg text-lg font-bold shadow">
                            Home
                        </button>
                        <Link v-else :href="route('home')" @click="mobileMenu = false"
                            class="w-11/12 text-left text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg text-lg font-bold shadow">
                            Home
                        </Link>

                        <template v-if="isHome">
                            <a href="#services" @click.prevent="goToSection('services'); mobileMenu = false"
                                class="w-11/12 text-left text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg text-lg font-bold shadow">
                                Services
                            </a>
                            <a href="#about" @click.prevent="goToSection('about'); mobileMenu = false"
                                class="w-11/12 text-left text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg text-lg font-bold shadow">
                                About
                            </a>
                            <a href="#news-events" @click.prevent="goToSection('news-events'); mobileMenu = false"
                                class="w-11/12 text-left text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg text-lg font-bold shadow">
                                News & Events
                            </a>
                            <a href="#contact" @click.prevent="goToSection('contact'); mobileMenu = false"
                                class="w-11/12 text-left text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg text-lg font-bold shadow">
                                Contact
                            </a>
                        </template>
                        <template v-else>
                            <Link :href="route('home') + '#services'" @click="mobileMenu = false"
                                class="w-11/12 text-left text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg text-lg font-bold shadow">
                                Services
                            </Link>
                            <Link :href="route('home') + '#about'" @click="mobileMenu = false"
                                class="w-11/12 text-left text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg text-lg font-bold shadow">
                                About
                            </Link>
                            <Link :href="route('home') + '#news-events'" @click="mobileMenu = false"
                                class="w-11/12 text-left text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg text-lg font-bold shadow">
                                News & Events
                            </Link>
                            <Link :href="route('home') + '#contact'" @click="mobileMenu = false"
                                class="w-11/12 text-left text-green-50 hover:bg-green-600 hover:text-white px-4 py-3 rounded-lg text-lg font-bold shadow">
                                Contact
                            </Link>
                        </template>
                    </div>
                </div>
            </transition>
        </nav>
    </header>
</template>

