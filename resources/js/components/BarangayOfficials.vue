<script setup>
import { animate, inView } from 'motion'
import { onMounted } from 'vue'
onMounted(() => {
    // Animate the background container
    inView('.photo-bg', (el) => {
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
    inView('.photo-sec', (el) => {
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


    inView('.photo-sect', (el) => {
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
    <div class="photo-bg opacity-10 backdrop-blur-md rounded-3xl shadow-2xl p-10 mx-2 md:mx-10 my-8 text-center">
        <h2
            class="photo-sect drop-shadow-lg text-4xl font-extrabold text-green-700 mb-4 select-none bg-white/80 px-6 py-2 rounded-lg inline-block text-center">
            Barangay Officials
        </h2>
        <div class="photo-sec flex justify-center rounded-lg">
            <img src="images/logo/officials/BarangayOfficials(Final).svg" alt="Barangay San Jose Tagaytay"
                class="w-full max-w-6xl rounded-xl shadow-2xl border-4 border-green-600 bg-white/90 p-4 r"
                style="min-height: 400px;" draggable="false" />
        </div>
    </div>
</template>
