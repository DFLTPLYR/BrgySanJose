<template>
    <div v-if="show" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 shadow-lg max-w-sm w-full">
            <h2 class="text-xl font-bold mb-4">Register Required</h2>
            <p class="mb-6">You need to register an account to access this service.</p>
            <div class="flex justify-end gap-2">
                <button @click="$emit('close')" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
                <button @click="goToRegister"
                    class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Register</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
const props = defineProps({ show: Boolean })
const goToRegister = () => router.visit(route('register'))
</script>
