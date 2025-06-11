<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import { onMounted } from 'vue'

const username = ref('')
const password = ref('')
const error = ref('')
const router = useRouter()

const handleLogin = async () => {
  error.value = ''
  try {
    const res = await axios.post('/api/login', {
      username: username.value,
      password: password.value
    }, {
      headers: { 'Content-Type': 'application/json' }
    })

    if (res.data.success) {
      localStorage.setItem('token', res.data.token)
      localStorage.setItem('role', res.data.role)
      // Redirect based on role
      if (res.data.role === 'admin') {
        router.push('/admin-dashboard')
      } else if (res.data.role === 'official') {
        router.push('/official-dashboard')
      } else {
        router.push('/dashboard')
      }
    } else {
      error.value = res.data.message || 'Invalid credentials.'
    }
  } catch (err) {
    error.value = 'Server error. Try again.'
    console.error(err)
  }
}
onMounted(async() => {
  const res = await axios.get('/api/test');
const data = await res.data;
  console.log(data);

  console.log(data.message);
});

</script>

<template>
  <div class="flex items-center justify-center min-h-screen bg-transparent">
    <form @submit.prevent="handleLogin" class="bg-white p-6 rounded shadow-md w-full max-w-sm">
      <h2 class="text-xl font-bold mb-4 text-green-700">Barangay Official Login</h2>
      <input
        v-model="username"
        placeholder="Username"
        class="w-full p-2 border border-green-400 mb-3 rounded focus:outline-none focus:ring-2 focus:ring-green-500"
        autocomplete="username"
        required
      />
      <input
        v-model="password"
        type="password"
        placeholder="Password"
        class="w-full p-2 border border-green-400 mb-3 rounded focus:outline-none focus:ring-2 focus:ring-green-500"
        autocomplete="current-password"
        required
      />
      <button
        type="submit"
        class="w-full bg-green-600 hover:bg-green-700 text-white p-2 rounded transition-colors duration-200"
      >
        Login
      </button>
      <p v-if="error" class="text-red-500 mt-2">{{ error }}</p>
    </form>
  </div>
</template>
