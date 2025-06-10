<script setup>
import { ref } from 'vue'
defineOptions({ name: 'ContactsInfo' })
const showAllContacts = ref(false)

const toggleContacts = () => {
  showAllContacts.value = !showAllContacts.value
}

const handleSubmit = async (event) => {
  const formData = new FormData(event.target)
  console.log({
    name: formData.get('name'),
    email: formData.get('email'),
    subject: formData.get('subject'),
    message: formData.get('message'),
  })
}
</script>

<template>



  <!-- Message Section -->
  <div class="mt-12 ">
    <div class="bg-gradient-to-br from-green-100 to-green-50 rounded-xl shadow-2xl p-10 border-2 border-green-400">
      <h3 class="text-2xl font-bold text-green-800 mb-6 text-center bg-white/80 px-6 py-2 rounded-lg inline-block drop-shadow">
        Send us a Message
      </h3>
      <form @submit.prevent="handleSubmit" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Name Input -->
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
            <input
              type="text"
              name="name"
              required
              class="block w-full pl-10 pr-3 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white/80"
              placeholder="Your Name"
            />
          </div>
          <!-- Email Input -->
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
              </svg>
            </div>
            <input
              type="email"
              name="email"
              required
              class="block w-full pl-10 pr-3 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white/80"
              placeholder="Your Email"
            />
          </div>
        </div>
        <!-- Subject Input -->
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>
          <input
            type="text"
            name="subject"
            required
            class="block w-full pl-10 pr-3 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white/80"
            placeholder="Subject"
          />
        </div>
        <!-- Message Input -->
        <div class="relative">
          <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
            <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
          </div>
          <textarea
            name="message"
            rows="6"
            required
            class="block w-full pl-10 pr-3 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white/80"
            placeholder="Message"
          ></textarea>
        </div>
        <!-- Submit Button -->
        <div class="flex justify-center">
          <button
            type="submit"
            class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors duration-300 flex items-center"
          >
            Send Message
            <svg class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </button>
        </div>

      </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8 mt-12">
    <!-- Contact Info Cards -->
    <div class="lg:col-span-2">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Address Card -->
        <div class="bg-gradient-to-br from-green-100 to-green-50 p-6 rounded-xl shadow-2xl border-2 border-green-400 contact-card">
          <div class="flex items-center mb-4">
            <svg class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <h3 class="text-xl font-bold ml-2 text-green-800">Address</h3>
          </div>
          <p class="text-green-900 font-semibold">Brgy. San Jose, Tagaytay City, Cavite Philippines</p>
        </div>

        <!-- Phone Card -->
        <div class="bg-gradient-to-br from-green-100 to-green-50 p-6 rounded-xl shadow-2xl border-2 border-green-400 contact-card">
          <div class="flex items-center mb-4">
            <svg class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <h3 class="text-xl font-bold ml-2 text-green-800">Call Us</h3>
          </div>
          <p class="text-green-900 font-semibold">+63 98765432191</p>
        </div>

        <!-- Email Card -->
        <div class="bg-gradient-to-br from-green-100 to-green-50 p-6 rounded-xl shadow-2xl border-2 border-green-400 contact-card">
          <div class="flex items-center mb-4">
            <svg class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <h3 class="text-xl font-bold ml-2 text-green-800">Email Us</h3>
          </div>
          <p class="text-green-900 font-semibold">brgysanjose@gmail.com</p>
        </div>
      </div>
    </div>

    <!-- Emergency Contacts -->
    <div
      class="p-6 rounded-xl bg-gradient-to-br from-green-200 to-green-50 shadow-2xl border-2 border-green-400 contact-card transition-all duration-1000 overflow-hidden"
      :class="showAllContacts ? 'h-[600px]' : 'h-36'"
    >
      <div class="flex items-center mb-6">
        <svg class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
        </svg>
        <h4 class="text-xl font-bold ml-2 text-green-800">EMERGENCY CONTACTS</h4>
      </div>
      <transition-group
        name="fade"
        tag="ul"
        class="space-y-4"
        v-if="showAllContacts"
      >
        <li
          v-for="(contact) in [
            {
              name: 'KAP JOEY',
              phone: ['(0962) 626 8247', '(0966) 487 5472'],
              icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
            },
            {
              name: 'KON CHRISTIAN (BDRRMC)',
              phone: ['(0930) 284 5084'],
              icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
            },
            {
              name: 'HEPE RICO (BPATS)',
              phone: ['(0945) 248 8609'],
              icon: 'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3',
            },
            {
              name: 'KONSI BONG (BPOC)',
              phone: ['(0930) 277 1235'],
              icon: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
            },
            {
              name: 'KUYA ARTHUR (AMBU DRIVER)',
              phone: ['(0991) 439 0179'],
              icon: 'M13 10V3L4 14h7v7l9-11h-7z',
            },
          ]"
          :key="contact.name"
          class="p-3 rounded-lg hover:bg-green-50 transition-colors duration-300"
        >
          <div class="flex items-center">
            <svg
              class="h-5 w-5 text-green-600 mr-2"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                :d="contact.icon"
              />
            </svg>
            <div>
              <span class="font-semibold block text-gray-800">{{ contact.name }}</span>
              <span
                v-for="(number, idx) in contact.phone"
                :key="idx"
                class="text-gray-600 block"
              >
                {{ number }}
              </span>
            </div>
          </div>
        </li>
      </transition-group>
      <button
        @click="toggleContacts"
        class="mt-4 w-full py-2 px-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300 flex items-center justify-center font-bold"
      >
        <span>{{ showAllContacts ? 'Show Less' : 'View Emergency Contacts' }}</span>
        <svg
          class="h-5 w-5 ml-2"
          :class="{ 'rotate-180': showAllContacts }"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M19 9l-7 7-7-7"
          />
        </svg>
      </button>
    </div>
  </div>
  </div>
</template>

