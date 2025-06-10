<script setup>
import SGLGB from '@/../../public/images/news/SGLGB.jpg'
import KALINISA from '@/../../public/images/news/KALINISA.jpg'
import HAPAG from '@/../../public/images/news/HAPAG.jpg'
const newsItems = [
    {
        id: 1,
        title: 'Barangay San Jose, Tagaytay City: 2024 SGLGB National Passer! 🌠🏆',
        image: SGLGB,
        link: 'https://www.facebook.com/share/p/12GGatYmEGV/',
    },
    {
        id: 2,
        title: 'Barangay San Jose receives Kalinisan, Barco, and Hapag awards! 🌟🏆',
        image: KALINISA,
        link: 'https://www.facebook.com/share/p/1DCsGEgrCA/',
    },
    {
        id: 3,
        title: '🌱✨ Congratulations, Barangay San Jose! ✨🌱',
        image: HAPAG,
        link: 'https://www.facebook.com/share/p/19z1Tz9cFr/',
    },
]
</script>

<template>
    <div class="section-animate relative py-16 bg-[#79cd37]" id="news-events">
        <div class="container mx-auto px-4">
            <!-- Section Title -->
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-white mb-4">News & Events</h2>
                <p class="text-xl text-white">Stay updated with our latest news and events</p>
            </div>

            <!-- News Grid -->
            <div class="news-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                <div v-for="item in newsItems" :key="item.id"
                    class="news-card bg-white rounded-lg overflow-hidden shadow-lg transition-transform hover:scale-105">
                    <div class="relative group">
                        <img :src="item.image" :alt="item.title" class="w-full h-64 object-cover" draggable="false" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <div class="flex space-x-4">
                                <a :href="item.image"
                                    class="text-white bg-green-600 p-2 rounded-full hover:bg-green-700"
                                    title="View Image">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </a>
                                <a :href="item.link" target="_blank"
                                    class="text-white bg-green-600 p-2 rounded-full hover:bg-green-700"
                                    title="More Details">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-800 mb-2">{{ item.title }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
