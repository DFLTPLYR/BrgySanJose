<script setup>
import Layout from '@/layouts/Layout.vue';
import { computed, ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();

const props = defineProps({
    Clearance: Array
});

const sort = ref({
    type: 'All',
    date: 'Asc',
    name: '',
    status: 'All',
    search: ''
});

const switchDateSort = () => {
    sort.value.date = sort.value.date === 'Asc' ? 'Desc' : 'Asc';
};

const sortedClearances = computed(() => {
    // Clone and sort
    let sorted = [...props.Clearance].sort((a, b) => {
        const dateA = new Date(a.created_at);
        const dateB = new Date(b.created_at);

        if (sort.value.date === 'Asc') {
            return dateA - dateB;
        } else if (sort.value.date === 'Desc') {
            return dateB - dateA;
        }

        return 0;
    });

    // Search by full name
    if (sort.value.search.trim() !== "") {
        const query = sort.value.search.toLowerCase();
        sorted = sorted.filter((clearance) => {
            const fullName = `${clearance.firstName} ${clearance.lastName}`.toLowerCase();
            return fullName.includes(query);
        });
    }

    // Filter by type
    if (sort.value.type !== 'All') {
        sorted = sorted.filter((paper) => paper.clearance_type === sort.value.type);
    }

    sorted = sorted.map((paper) => {
        let route = null;

        switch (paper.clearance_type) {
            case 'barangay_clearance':
                route = 'barangay-clearance';
                break;
            case 'business_clearance':
                const businessType = paper.additional_data?.business_clearance_type?.toLowerCase();
                switch (businessType) {
                    case 'new':
                        route = 'business-clearance-new';
                        break;
                    case 'renewal':
                        route = 'business-clearance-renewal';
                        break;
                    case 'realestate':
                        route = 'business-clearance-forrealestate';
                        break;
                    default:
                        return;
                }
                break;
            case 'working_clearance':
                route = 'working-clearance-form';
                break;
            case 'water_and_electrical_clearance':
                route = "water-electrical-permit-form";
                break;
            case 'fencing_clearance':
                route = "fencing-building-permit-form";
                break;
            case 'indigency_clearance':
                route = "indigency-clearance-form'";
                break;
            default:
                route = null;
        }

        return { ...paper, route };
    });

    return sorted;
});

const getEditLink = (clearance) => {
    return clearance.route
        ? route(clearance.route, { id: clearance.id })
        : '#';
};

</script>

<template>
    <Layout>
        <div class="bg-white p-6 rounded-lg shadow w-full space-y-3.5">
            <h1 class="text-2xl font-bold text-gray-800">Clearance Dashboard</h1>

            <div class="flex w-full flex-row gap-10">
                <button>
                    {{ sort.status }}
                </button>

                <button @click="switchDateSort">
                    {{ sort.date }}
                </button>

                <input type="text" v-model="sort.search">
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg" v-if="sortedClearances.length > 0">
                <table class="w-full text-sm text-left text-gray-500 max-h-96">
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
                        <tr v-for="clearance in sortedClearances" :key="clearance.id" class="border-b hover:bg-gray-50">
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
                                {{ clearance.created_at ? new Date(clearance.created_at).toLocaleDateString('en-US', {
                                    month: 'short', day: 'numeric', year: 'numeric'
                                }) : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 space-x-3">
                                <Link :href="getEditLink(clearance)"
                                    class="text-blue-600 hover:text-blue-900 hover:underline">
                                Edit
                                </Link>

                                <a href="#" class="text-red-600 hover:text-red-900 hover:underline"
                                    v-if="page.props.auth.role === 'Admin'">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-else class="text-center py-8 text-gray-500">
                No clearance records found
            </div>
        </div>
    </Layout>
</template>
