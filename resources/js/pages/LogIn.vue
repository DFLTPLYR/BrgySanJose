<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    username: '',
    password: ''
});

function handleLogin() {
    form.post(route('login'), {
        errorBag: "auth.failed",
    })
}

</script>

<template>
    <div class="flex items-center justify-center min-h-screen bg-transparent">
        <form @submit.prevent="handleLogin" class="bg-white p-6 rounded shadow-md w-full max-w-sm">
            <h2 class="text-xl font-bold mb-4 text-green-700">Barangay Official Login</h2>

            <input v-model="form.username" placeholder="Username"
                :class="!form.errors.username ? 'border-green-400 border' : 'border-red-400 border-2'"
                class="w-full p-2 mb-3 rounded focus:outline-none focus:ring-2 focus:ring-green-500"
                autocomplete="username" required />

            <input v-model="form.password" type="password" placeholder="Password"
                :class="{ 'ring-red-500': form.errors.password }"
                class="w-full p-2 border border-green-400 mb-3 rounded focus:outline-none focus:ring-2 focus:ring-green-500"
                autocomplete="current-password" required />
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white p-2 rounded transition-colors duration-200">
                Login
            </button>
            <p v-if="form.errors" class="text-red-500 mt-2">
                <template v-for="err in form.errors">
                    {{ err }}
                </template>
            </p>
        </form>
    </div>
</template>
