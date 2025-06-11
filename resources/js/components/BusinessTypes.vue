<script setup>
import { onMounted } from 'vue'
import { animate, inView } from 'motion'

const items = [
  { route: '/business-clearance-new', name: 'Business Clearance New' },
  { route: '/business-clearance-renewal', name: 'Business Clearance Renewal' },
  { route: '/business-clearance-forrealestate', name: 'Business Clearance For Real Estate' },
]

onMounted(() => {
  // Animate the background container
  inView('.business-bg', (el) => {
    animate(
      el,
      { opacity: [0,1], y: [-50, 0] },
      { duration: 1, easing: [0.17, 0.55, 0.55, 1] },
    )
    return () => {
      el.style.opacity = 0
      el.style.transform = 'translateY(-100px)'
    }
  })

  // Animate the content as before
  inView('.service-sect', (el) => {
    animate(
      el,
      { opacity: [0,1], y: [-50, 0] },
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
  <div>
    <section>
      <div class="business-bg bg-animate opacity-10 backdrop-blur-md rounded-3xl shadow-2xl p-4 sm:p-8 md:p-10 mx-1 sm:mx-2 md:mx-10 my-6 sm:my-8">
        <div class="mb-50 business-sect max-w-7xl mx-auto px-2 sm:px-6 md:px-10 lg:px-16 w-full justify-between items-center">
          <div class="text-center mb-8 sm:mb-12">
            <h2 class="drop-shadow-lg text-2xl sm:text-3xl md:text-4xl font-extrabold text-green-700 mb-4 select-none bg-white/80 px-4 sm:px-6 py-2 rounded-lg inline-block justify-between">
              Our Business Clearance Services
            </h2>
            <br />
            <p class="drop-shadow-lg text-base sm:text-xl text-green-900 select-none bg-white/70 px-3 sm:px-4 py-2 rounded-lg inline-block">
              Explore our available services below
            </p>
          </div>
          <div class="bg-white/90 backdrop-blur-md rounded-2xl sm:rounded-3xl p-4 sm:p-8 md:p-10 shadow-2xl">
            <div class="flex justify-center">
              <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 md:gap-8 select-none">
                <li
                  v-for="item in items"
                  :key="item.route"
                  draggable="false"
                  class="service-card bg-gradient-to-br from-green-100 via-white to-[#b6e89c] h-full shadow-xl rounded-xl overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl border-2 border-green-300"
                >
                  <Link :href="route(item.route)" class="block p-4 sm:p-6 md:p-8">
                    <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-green-700 mb-2">
                      {{ item.name }}
                    </h2>
                    <p class="text-green-900 text-sm sm:text-base">
                      Learn more about our {{ item.name.toLowerCase() }} services.
                    </p>
                  </Link>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
