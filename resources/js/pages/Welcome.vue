<script setup>
import Layout from '@/layouts/Layout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue'
import { animate, inView } from 'motion'
import ServiceSection from '@/components/ServiceSection.vue';
import About from '@/components/About.vue';
import NewsEvents from '@/components/NewsEvents.vue';
import Gmaps from '@/components/Gmaps.vue';
import Contacts from '@/components/Contacts.vue';
import BarangayOfficials from '@/components/BarangayOfficials.vue';
import { Link } from '@inertiajs/vue3';

const showHero = ref(true);

onMounted(() => {
    // Animate hero section
    animate(
        '.hero-content',
        {
            opacity: [0, 1],
            y: [100, 0],
        },
        { duration: 1 },
    )

    inView('.hero', (el) => {
        animate(
            el,
            { opacity: 1, y: [-100, 0] },
            {
                duration: 0.9,
                easing: [0.17, 0.55, 0.55, 1],
            },
        )

        // Cleanup: animate out when not in view
        return () => animate(el, { opacity: 0, y: -100 }, { duration: 1 })
    })
})

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

</script>

<template>
    <Layout>

        <Head title="Barangay Sanjose Tagaytay City" />
        <div>
            <!-- Hero Section -->
            <div class="hero relative w-full min-h-screen overflow-hidden flex flex-col items-center justify-center">
                <!-- Background Image with Overlay -->
                <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                    <img src="/images/logo/UPDATEDTODAY.svg" alt="Tagaytay Background"
                        class="w-full h-full object-cover" style="object-fit: cover;" draggable="false" />
                </div>
                <div v-if="showHero"
                    class="hero-content relative z-10 text-center px-4 sm:px-8 py-10 sm:py-16 rounded-2xl sm:rounded-3xl bg-white/20 shadow-2xl border-2 sm:border-4 border-green-600 backdrop-blur-md animate-fade-in max-w-full sm:max-w-2xl md:max-w-3xl mx-2">
                    <!-- Exit Button -->
                    <button @click="showHero = false"
                        class="absolute top-3 right-3 text-green-900 hover:text-red-600 text-2xl font-bold bg-white/70 rounded-full px-2 shadow-md"
                        aria-label="Close">
                        &times;
                    </button>

                    <!-- Title and Buttons -->
                    <h1
                        class="text-3xl sm:text-5xl md:text-6xl font-extrabold text-green-700 mb-4 drop-shadow-lg tracking-tight">
                        Welcome to Barangay San Jose
                    </h1>
                    <p class="text-lg sm:text-2xl md:text-3xl text-green-900 font-semibold mb-8 drop-shadow">
                        Tagaytay City • Team Effort • Team Work
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#services" @click.prevent="goToSection('services')"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 sm:px-8 py-3 text-base sm:text-lg font-bold rounded-lg shadow transition-colors duration-300">
                            Our Services
                        </a>
                        <a href="#contact" @click.prevent="goToSection('contact')"
                            class="bg-white hover:bg-gray-100 text-green-700 px-6 sm:px-8 py-3 text-base sm:text-lg font-bold rounded-lg shadow border border-green-600 transition-colors duration-300">
                            Contact Us
                        </a>
                        <Link :href="route('login')"
                            class="bg-white hover:bg-gray-100 text-green-700 px-6 sm:px-8 py-3 text-base sm:text-lg font-bold rounded-lg shadow border border-green-600 transition-colors duration-300 cursor-pointer">
                        Official Login
                        </Link>
                    </div>
                </div>

            </div>

            <!-- Services Section -->
            <div id="services" class="section-animate mt-10 sm:mt-20 relative h-full px-2 sm:px-0">
                <ServiceSection />
            </div>
            <!-- About Section -->
            <div id="about" class="section-animate relative h-full my-8 px-2 sm:px-0">
                <About />
            </div>
            <!-- Barangay Officials -->
            <div class="section-animate relative h-full my-8 px-2 sm:px-0">
                <BarangayOfficials />
            </div>
            <!-- News & Events Section -->
            <div id="news-events" class="section-animate relative h-full my-8 px-2 sm:px-0">
                <NewsEvents />
            </div>
            <!-- Contact Section -->
            <div id="contact" class="section-animate relative py-10 sm:py-16 my-8 px-2 sm:px-0">
                <div class="container mx-auto px-0 sm:px-4">
                    <!-- Google Maps -->
                    <Gmaps />

                    <!-- Contact and Emergency Info -->
                    <Contacts />
                </div>
            </div>
        </div>
    </Layout>
</template>
