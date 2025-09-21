<script setup>
import { animate, inView } from 'motion'
import { onMounted, ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import RegisterModal from './RegisterModal.vue'

const page = usePage()
const showRegisterModal = ref(false)

const services = [
    { route: 'barangay-clearance', name: 'Barangay Clearance' },
    { route: 'working-clearance', name: 'Barangay Working Clearance' },
    { route: 'water-electrical-permit', name: 'Water & Electrical Permit' },
    { route: 'fencing-building-permit', name: 'Fencing/Building Permit' },
    { route: 'business-clearance', name: 'Business Clearance' },
    { route: 'indigency-clearance', name: 'Indigency Clearance' },
]

const handleServiceClick = (service) => {
    if (!page.props.auth) {
        showRegisterModal.value = true
    } else {
        router.visit(route(service.route))
    }
}

onMounted(() => {
    inView('.service-bg-animate', (el) => {
        animate(
            el,
            { opacity: [0, 1], y: [-50, 0] },
            { duration: 1, easing: [0.17, 0.55, 0.55, 1] },
        )
        return () => {
            el.style.opacity = 0
            el.style.transform = 'translateY(-100px)'
        }
    })

    inView('.service-sect', (el) => {
        animate(
            el,
            { opacity: [0, 1], y: [-50, 0] },
            { duration: 1, easing: [0.1, 0.1, 0.1, 0.9] },
        )
        return () => {
            el.style.opacity = 0
            el.style.transform = 'translateY(-100px)'
        }
    })
})
</script>

<template>
    <div
        class="service-bg-animate opacity-10 backdrop-blur-md rounded-3xl shadow-2xl p-4 sm:p-8 md:p-10 mx-1 sm:mx-2 md:mx-10 my-6 sm:my-8">
        <div class="mb-50 service-sect max-w-7xl mx-auto px-2 sm:px-6 md:px-10 lg:px-16 w-full">
            <div class="text-center mb-8 sm:mb-12">
                <h2
                    class="drop-shadow-lg text-2xl sm:text-3xl md:text-4xl font-extrabold text-green-700 mb-4 select-none bg-white/80 px-4 sm:px-6 py-2 rounded-lg inline-block">
                    Our Services
                </h2>
                <br />
                <p
                    class="drop-shadow-lg text-base sm:text-xl text-green-900 select-none bg-white/70 px-3 sm:px-4 py-2 rounded-lg inline-block">
                    Explore our available services below
                </p>
            </div>
            <div class="bg-white/90 backdrop-blur-md rounded-2xl sm:rounded-3xl p-4 sm:p-8 md:p-10 shadow-2xl">
                <ul
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8 select-none">
                    <li v-for="service in services" :key="service.route" draggable="false"
                        class="service-card bg-gradient-to-br from-green-100 via-white to-[#b6e89c] h-full shadow-xl rounded-xl overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl border-2 border-green-300">
                        <button type="button"
                            class="block w-full text-left p-4 sm:p-6 md:p-8 bg-transparent border-none outline-none"
                            @click="handleServiceClick(service)">
                            <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-green-700 mb-2">
                                {{ service.name }}
                            </h2>
                            <p class="text-green-900 text-sm sm:text-base">
                                Learn more about our {{ service.name.toLowerCase() }} services.
                            </p>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <RegisterModal :show="showRegisterModal" @close="showRegisterModal = false" />
    </div>
</template>
