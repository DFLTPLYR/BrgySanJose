
<script setup>
import { onMounted } from 'vue'
import { animate, inView } from 'motion'

defineOptions({ name: 'HomeAbout' })

onMounted(() => {
  // Animate the background container
  inView('.about-sect', (el) => {
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
  inView('.about', (el) => {
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
  <div class="about rounded-3xl shadow-2xl p-10 mx-2 md:mx-10 my-8 opacity-10 backdrop-blur-md">
    <div class="about-sect mb-50 service-sect max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 w-full" id="about-us">
      <div class="text-center mb-12">
        <h2 class="drop-shadow-lg text-4xl font-extrabold text-green-700 mb-4 select-none bg-white/80 px-6 py-2 rounded-lg inline-block">
          About Us
        </h2>
      </div>
    <div class="max-w-4xl mx-auto px-6 sm:px-10 lg:px-16 min-h-96 w-full select-none bg-white/90 rounded-3xl shadow-2xl p-10">

      <div class="flex justify-center mb-6">
        <img
          src="/images/logo/logomain.png"
          alt="Barangay Logo"
          class="h-36 w-36 rounded-full border-4 border-green-600 shadow-lg bg-white p-2"
          draggable="false"
        />
      </div>
      <p class="bg-[#3c9cbc] bg-gradient-to-br from-[#3c9cbc] to-[#79cd37] rounded-xl drop-shadow-lg text-white font-bold text-xl text-center max-w-3xl mx-auto mb-6 p-6 border-2 border-green-200">
        Barangay San Jose, Tagaytay City is a charming and serene community that blends urban
        convenience with a countryside ambiance. Situated in the cool and breezy uplands of Cavite,
        it offers picturesque views of lush greenery and the iconic Taal Lake. The barangay is a
        vibrant area, home to local businesses, cozy residential neighborhoods, and welcoming
        establishments catering to tourists and residents.
      </p>
      <p class="bg-[#3c9cbc] bg-gradient-to-br from-[#3c9cbc] to-[#79cd37] rounded-xl drop-shadow-lg text-white font-bold text-xl text-center max-w-3xl mx-auto mb-6 p-6 border-2 border-green-200">
        Under the leadership of Barangay Captain Hon. Joey Desingaño, the community has thrived,
        focusing on development initiatives that enhance the quality of life for its residents. His
        dedication to service and community engagement has further strengthened the bond among the
        residents.
      </p>
    </div>
  </div>
    </div>
</template>
