
<script setup>
import Layout from '@/layouts/Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, defineAsyncComponent } from 'vue';
import { animate, inView } from 'motion';

// Lazy-loaded components
const ServiceSection = defineAsyncComponent(() => import('@/components/ServiceSection.vue'));
const About = defineAsyncComponent(() => import('@/components/About.vue'));
const NewsEvents = defineAsyncComponent(() => import('@/components/NewsEvents.vue'));
const Gmaps = defineAsyncComponent(() => import('@/components/Gmaps.vue'));
const Contacts = defineAsyncComponent(() => import('@/components/Contacts.vue'));
const BarangayOfficials = defineAsyncComponent(() => import('@/components/BarangayOfficials.vue'));

const showHero = ref(true);

onMounted(() => {
    animate('.hero-content', {
        opacity: [0, 1],
        y: [100, 0],
    }, { duration: 1 });

    inView('.hero', (el) => {
        animate(el, { opacity: 1, y: [-100, 0] }, {
            duration: 0.9,
            easing: [0.17, 0.55, 0.55, 1],
        });
        return () => animate(el, { opacity: 0, y: -100 }, { duration: 1 });
    });
});

const goToSection = (elementId) => {
    const element = document.getElementById(elementId);
    if (element) {
        const headerHeight = document.querySelector('header')?.offsetHeight || 0;
        const offset = headerHeight + 20;
        const offsetPosition = element.getBoundingClientRect().top + window.pageYOffset - offset;
        window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
    }
};




onMounted(() => {
  const hash = window.location.hash?.substring(1)
  if (hash) {
    // wait for DOM to load
    setTimeout(() => {
      const el = document.getElementById(hash)
      const headerOffset = document.querySelector('header')?.offsetHeight || 0
      if (el) {
        const elementPosition = el.getBoundingClientRect().top + window.pageYOffset
        const offsetPosition = elementPosition - headerOffset - 20

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth',
        })
      }
    }, 300) // delay so Inertia page fully mounts
  }
})
</script>

<template>
    <Layout>
        <Head>
            <title>Barangay San Jose, Tagaytay City</title>
            <meta name="description" content="Official website of Barangay San Jose, Tagaytay City." />
        </Head>

        <main>
            <!-- Hero -->
            <div class="hero relative w-full min-h-screen overflow-hidden flex flex-col items-center justify-center">
                <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                    <img src="/images/logo/UPDATEDTODAY.svg" alt="Tagaytay Background"
                        class="w-full h-full object-cover" draggable="false" />
                </div>

                <Transition name="fade">
                    <div v-if="showHero"
                        class="hero-content relative z-10 text-center px-4 sm:px-8 py-10 sm:py-16 rounded-2xl sm:rounded-3xl bg-white/20 shadow-2xl border-2 sm:border-4 border-green-600 backdrop-blur-md max-w-full sm:max-w-2xl md:max-w-3xl mx-2">
                        <button @click="showHero = false"
                            class="absolute top-3 right-3 text-green-900 hover:text-red-600 text-2xl font-bold bg-white/70 rounded-full px-2 shadow-md">
                            &times;
                        </button>

                        <h1 class="text-3xl sm:text-5xl md:text-6xl font-extrabold text-green-700 mb-4">
                            Welcome to Barangay San Jose
                        </h1>
                        <p class="text-lg sm:text-2xl md:text-3xl text-green-900 font-semibold mb-8">
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
                                class="bg-white hover:bg-gray-100 text-green-700 px-6 sm:px-8 py-3 text-base sm:text-lg font-bold rounded-lg shadow border border-green-600 transition-colors duration-300">
                                Official Login
                            </Link>
                        </div>
                    </div>
                </Transition>
            </div>

            <!-- Sections -->
            <section id="services" class="section-animate mt-10 sm:mt-20 px-2 sm:px-0">
                <ServiceSection />
            </section>

            <section id="about" class="section-animate my-8 px-2 sm:px-0">
                <About />
            </section>

            <section class="section-animate my-8 px-2 sm:px-0">
                <BarangayOfficials />
            </section>

            <section id="news-events" class="section-animate my-8 px-2 sm:px-0">
                <NewsEvents />
            </section>

            <section id="contact" class="section-animate py-10 sm:py-16 my-8 px-2 sm:px-0">
                <div class="container mx-auto">
                    <Gmaps />
                    <Contacts />
                </div>
            </section>
        </main>
    </Layout>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s ease;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>

