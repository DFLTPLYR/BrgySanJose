<script setup>
import Layout from '@/layouts/Layout.vue';

defineProps({
    Clearance: Array
});
</script>

<template>
    <Layout>
        <div class="bg-white">
            <h1>This is the dashboard!!!</h1>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                id type
                            </th>
                            <th scope="col" class="px-6 py-3">
                                tite
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="clearance in Clearance"
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ clearance.id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ clearance.firstName + ' ' + clearance.lastName }}
                            </td>
                            <td class="px-6 py-4">
                                {{ clearance.clearance_type }}
                            </td>
                            <td class="px-6 py-4">
                                {{ clearance.id }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </Layout>
</template>
