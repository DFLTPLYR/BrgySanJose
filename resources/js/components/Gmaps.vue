<script setup>
import { onMounted } from 'vue'
import { animate, inView } from 'motion'


onMounted(() => {
    // Animate the background container
    inView('.gmaps-bg', (el) => {
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

    // Animate the content as before
    inView('.gmaps-sect', (el) => {
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
    <div class="gmaps-bg opacity-10 backdrop-blur-md rounded-2xl shadow-2xl p-8 mb-12">
        <div class="text-center mb-8">
            <h2
                class="text-3xl font-extrabold text-green-800 mb-4 bg-white/80 px-8 py-3 rounded-lg drop-shadow-lg inline-block">
                Contact Us
            </h2>
            <br />
            <p class="text-xl text-green-900 bg-white/70 px-6 py-2 rounded-lg inline-block">
                Get in touch with Barangay San Jose Tagaytay City
            </p>
        </div>
        <div class="rounded-lg overflow-hidden shadow-xl border-4 border-green-600">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d309.7167040518458!2d120.96167489459084!3d14.119700762392236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd7939cb07c587%3A0x2421678061f81976!2sPamahalaang%20Barangay%20ng%20San%20Jose!5e0!3m2!1sen!2sph!4v1744002656209!5m2!1sen!2sph"
                width="100%" height="450" style="border:0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</template>
