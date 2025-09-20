<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
const isSideBarOpen = ref(false);

const toggleSidebar = () => { isSideBarOpen.value = !isSideBarOpen.value }
</script>

<template>
    <aside class="transition-all duration-500 p-2" :class="isSideBarOpen ? 'w-56 ' : 'w-12'" @click="toggleSidebar">
        <Section class="flex flex-col gap-2">
            <Link :href="route('dashboard')" class="w-full rounded-md bg-white hover:grayscale-25 truncate">
            Home
            </Link>
            <Link :href="route('clearance')" class="w-full rounded-md bg-white hover:grayscale-25 truncate">
            Clearance
            </Link>
            <Link :href="route('accounts')" class="w-full rounded-md bg-white hover:grayscale-25 truncate">
            Accounts
            </Link>
        </Section>
    </aside>
</template>
s
