<script setup>
defineProps({
    showScrollTop: Boolean
});
const emit = defineEmits(['scrollToTop']);
</script>

<template>
    <footer class="bg-gray-800 text-white py-8 mt-auto">
        <div class="container mx-auto px-4">
            <!-- Copyright -->
            <div class="text-center">
                <p class="text-gray-400">
                    <span>Copyright of 2025</span>
                    <strong class="px-1 text-green-500">Barangay San Jose</strong>
                    <span>All Rights Reserved</span>
                </p>
            </div>
        </div>

        <!-- Scroll Top Button -->
        <button @click="emit('scrollToTop')"
            class="fixed bottom-8 right-8 bg-green-600 text-white p-3 rounded-full shadow-lg hover:bg-green-700 transition-all duration-300"
            :class="{
                'opacity-0 translate-y-10': !showScrollTop,
                'opacity-100 translate-y-0': showScrollTop,
            }">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </footer>
</template>
