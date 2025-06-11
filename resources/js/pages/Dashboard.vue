<script setup>
import Layout from '@/layouts/Layout.vue';
import { ref } from 'vue';

defineProps({
    Clearance: Array
});
</script>

<template>
    <Layout>
        <div class="bg-white p-6 rounded-lg shadow">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Clearance Dashboard</h1>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Clearance Type</th>
                            <th scope="col" class="px-6 py-3">Date</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="clearance in Clearance || clearances"
                            :key="clearance.id"
                            class="border-b hover:bg-gray-50"
                        >
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ clearance.id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ clearance.firstName + ' ' + clearance.lastName }}
                            </td>
                            <td class="px-6 py-4">
                                {{ clearance.clearance_type }}
                            </td>
                            <td class="px-6 py-4">
                            {{ clearance.created_at ? new Date(clearance.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : 'N/A' }}


                            </td>
                            <td class="px-6 py-4 space-x-3">
                                <a href="#" class="text-blue-600 hover:text-blue-900 hover:underline">
                                    Edit
                                </a>
                                <a href="#" class="text-red-600 hover:text-red-900 hover:underline">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-if="(Clearance || clearances).length === 0" class="text-center py-8 text-gray-500">
                No clearance records found
            </div>
        </div>
    </Layout>
</template>
