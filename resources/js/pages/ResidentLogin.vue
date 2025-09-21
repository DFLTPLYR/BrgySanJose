<script setup>
import Layout from '@/layouts/Layout.vue'
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const form = ref({
    email: '',
    password: ''
})
const errors = ref({})

const submit = () => {
    router.post(route('resident.login.store'), form.value, {
        onError: (e) => { errors.value = e }
    })
}
</script>

<template>
    <Layout>
        <div class="max-w-md mx-auto mt-12 bg-white p-8 rounded-xl shadow">
            <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>
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
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                    Login
                </button>
            </form>
        </div>
    </Layout>
</template>
