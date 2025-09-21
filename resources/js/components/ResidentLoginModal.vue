<template>
    <div v-if="show" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 shadow-lg max-w-sm w-full">
            <h2 class="text-xl font-bold mb-4">Resident Login</h2>
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label>Email</label>
                    <input v-model="form.email" type="email" required class="w-full border rounded px-3 py-2" />
                    <div v-if="errors.email" class="text-red-500 text-xs mt-1">{{ errors.email }}</div>
                </div>
                <div>
                    <label>Password</label>
                    <input v-model="form.password" type="password" required class="w-full border rounded px-3 py-2" />
                    <div v-if="errors.password" class="text-red-500 text-xs mt-1">{{ errors.password }}</div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="$emit('close')"
                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
                    <button type="submit" :disabled="processing"
                        class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700 disabled:opacity-50">
                        {{ processing ? 'Logging in...' : 'Login' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({ show: Boolean })
const emit = defineEmits(['close'])

const form = ref({
    email: '',
    password: ''
})
const errors = ref({})
const processing = ref(false)

const submit = () => {
    processing.value = true
    errors.value = {}

    router.post(route('resident.login.store'), form.value, {
        onError: (e) => {
            errors.value = e
            processing.value = false
        },
        onSuccess: () => {
            // Clear form
            form.value = { email: '', password: '' }
            processing.value = false

            // Close modal first
            emit('close')

            // IMPORTANT: Force page refresh to update auth state
            // Try these in order until one works:

            // Option 1: Full page reload (most reliable)
            setTimeout(() => location.reload(), 100)

            // Option 2: If you don't want full reload, try this instead:
            // router.reload()

            // Option 3: Visit current page to refresh state
            // router.visit(window.location.pathname, { preserveState: false })
        },
        onFinish: () => {
            processing.value = false
        }
    })
}
</script>
