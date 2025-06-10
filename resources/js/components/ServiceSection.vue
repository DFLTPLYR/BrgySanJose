<script setup>
import { animate, inView, spring, stagger } from 'motion'
import { onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'
const services = [
    { route: 'barangay-clearance', name: 'Barangay Clearance' },
    { route: 'working-clearance', name: ' Barangay Working Clearance' },
    { route: 'water-electrical-permit', name: 'Water & Electrical Permit' },
    { route: 'fencing-building-permit', name: 'Fencing/Building Permit' },
    { route: 'business-clearance', name: 'Business Clearance' },
    { route: 'indigency-clearance', name: 'Indigency Clearance' },
]


onMounted(() => {
    inView('.services-grid', () => {
        animate(
            '.service-card',
            {
                opacity: [0, 1],
                y: [100, 0],
            },
            {
                duration: 0.6,
                delay: stagger(0.1),
                easing: spring(),
                bounceStiffness: 300,
            },
        )
    })
})

</script>

<template>
    <div class="relative h-full" id="services">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-[40rem] w-full grid items-center justify-center">
            <ul class="grid grid-cols-1 services-grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <li v-for="service in services" :key="service.route"
                    class="service-card bg-white h-full shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105">
                    <Link :href="route(service.route)" class="block p-6">
                    <h2 class="text-xl font-semibold text-green-600 mb-2">{{ service.name }}</h2>
                    <p class="text-gray-700">
                        Learn more about our {{ service.name.toLowerCase() }} services.
                    </p>
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template>
