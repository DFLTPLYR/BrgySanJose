
<script setup>
import Layout from '@/layouts/Layout.vue';
import { computed, ref, onMounted, onBeforeUnmount } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

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

const activeDropdown = ref(null);

const toggleDropdown = (id) => {
    activeDropdown.value = activeDropdown.value === id ? null : id;
};

const handleClickOutside = (event) => {
    const dropdowns = document.querySelectorAll('[data-dropdown]');
    let clickedInside = false;

    dropdowns.forEach((dropdown) => {
        if (dropdown.contains(event.target)) {
            clickedInside = true;
        }
    });

    if (!clickedInside) {
        activeDropdown.value = null;
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
});



const updateStatus = async (id, newStatus) => {
    const clearanceToUpdate = props.Clearance.find(c => c.id === id);
    if (!clearanceToUpdate) return;

    const originalStatus = clearanceToUpdate.status;

    try {
        const statusMap = {
            approved: 'completed',
            pending: 'pending',
            rejected: 'reject'
        };

        clearanceToUpdate.status = newStatus;
        activeDropdown.value = null;

        // ✅ Use `router.visit` with `X-Inertia: false` to avoid JSON response popup
        await router.visit(route('clearance.updateStatus', { clearance: id }), {
            method: 'put',
            data: { status: statusMap[newStatus.toLowerCase()] },
            onCancelToken: () => {},
            onCancel: () => {},
            onError: () => {
                clearanceToUpdate.status = originalStatus;
                Swal.fire('Error!', 'Failed to update status', 'error');
            },
            onFinish: () => {}
        });
    } catch (error) {
        clearanceToUpdate.status = originalStatus;
        Swal.fire('Error!', 'Unexpected error occurred', 'error');
    }
};



const switchDateSort = () => {
    sort.value.date = sort.value.date === 'Asc' ? 'Desc' : 'Asc';
};

const sortedClearances = computed(() => {
    let sorted = [...props.Clearance].sort((a, b) => {
        const dateA = new Date(a.created_at);
        const dateB = new Date(b.created_at);
        return sort.value.date === 'Asc' ? dateA - dateB : dateB - dateA;
    });

    if (sort.value.search.trim() !== "") {
        const query = sort.value.search.toLowerCase();
        sorted = sorted.filter((clearance) => {
            const fullName = `${clearance.firstName} ${clearance.lastName}`.toLowerCase();
            return fullName.includes(query);
        });
    }

    if (sort.value.type !== 'All') {
        sorted = sorted.filter((paper) => paper.clearance_type === sort.value.type);
    }

    return sorted.map((paper) => {
        let route = null;
        switch (paper.clearance_type) {
            case 'barangay_clearance':
                route = 'barangay-clearance';
                break;
            case 'business_clearance':
                const type = paper.additional_data?.business_clearance_type?.toLowerCase();
                route = {
                    new: 'business-clearance-new',
                    renewal: 'business-clearance-renewal',
                    realestate: 'business-clearance-forrealestate'
                }[type] || null;
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
                route = "indigency-clearance-form";
                break;
        }
        return { ...paper, route };
    });
});

const getEditLink = (clearance) => {
    return clearance.route ? route(clearance.route, { id: clearance.id }) : '#';
};

const showModal = (id) => {
    Swal.fire({
        title: 'Do you want to delete this clearance?',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('clearance.destroy', id), {
                onSuccess: () => {
                    Swal.fire('Deleted!', '', 'success');
                }
            });
        }
    });
};

const formatClearanceType = (type) => {
    switch (type.clearance_type) {
        case "barangay_clearance":
            return "Barangay";
        case "business_clearance":
            switch (type.additional_data?.business_clearance_type) {
                case "new": return "New Business";
                case "renewal": return "Renewal";
                case "RealEstate": return "Real Estate";
                default: return "Business";
            }
        case "fencing_clearance":
            return "Fencing";
        case "indigency_clearance":
            return "Indigency";
        case "water_and_electrical_clearance":
            return "Water & Electrical";
        case "working_clearance":
            return "Working";
        default:
            return type.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
    }
};
</script>

<template>
    <Layout>
        <div class="bg-white p-8 rounded-xl shadow w-full space-y-6">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Clearance Dashboard</h1>

            <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-8">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Status</label>
                    <button
                        class="px-4 py-2 bg-gray-100 rounded-md border border-gray-200 text-gray-700 font-medium shadow-sm hover:bg-gray-200 transition">
                        {{ sort.status }}
                    </button>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Sort by Date</label>
                    <button @click="switchDateSort"
                        class="px-4 py-2 bg-blue-100 rounded-md border border-blue-200 text-blue-700 font-medium shadow-sm hover:bg-blue-200 transition">
                        {{ sort.date === 'Asc' ? 'Oldest First' : 'Newest First' }}
                    </button>
                </div>
                <div class="flex-1">
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Search Name</label>
                    <input type="text" v-model="sort.search" placeholder="Search by name..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-200 focus:outline-none transition">
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4" v-if="sortedClearances.length > 0">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Clearance Type</th>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="clearance in sortedClearances" :key="clearance.id"
                            class="border-b hover:bg-gray-100 transition">
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ clearance.id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ clearance.firstName + ' ' + clearance.lastName }}
                            </td>
                            <td class="px-6 py-4">
                                {{ formatClearanceType(clearance) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ clearance.created_at ? new Date(clearance.created_at).toLocaleDateString('en-US', {
                                    month: 'short', day: 'numeric', year: 'numeric'
                                }) : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 relative" data-dropdown>
                                <template v-if="['pending', 'approved', 'rejected'].includes(clearance.status.toLowerCase())">
                                    <div
                                        @click.stop="toggleDropdown(clearance.id)"
                                        :class="{
                                            'cursor-pointer inline-block px-2 py-1 rounded text-xs font-bold transition': true,
                                            'bg-yellow-100 text-yellow-700 hover:bg-yellow-200': clearance.status.toLowerCase() === 'pending',
                                            'bg-green-100 text-green-700 hover:bg-green-200': clearance.status.toLowerCase() === 'approved',
                                            'bg-red-100 text-red-700 hover:bg-red-200': clearance.status.toLowerCase() === 'rejected'
                                        }"
                                    >
                                        {{ clearance.status.charAt(0).toUpperCase() + clearance.status.slice(1) }}
                                    </div>
                                    <div
                                        v-if="activeDropdown === clearance.id"
                                        class="absolute mt-2 bg-white border rounded shadow z-20 px-4 py-2 flex gap-2"
                                        style="left: 50%; transform: translateX(-50%);"
                                    >
                                        <button
                                            @click.stop="updateStatus(clearance.id, 'approved')"
                                            class="px-2 py-1 bg-green-500 text-white text-xs rounded hover:bg-green-600 transition"
                                            :class="{'opacity-50': clearance.status.toLowerCase() === 'approved'}"
                                        >
                                            Approve
                                        </button>
                                        <button
                                            @click.stop="updateStatus(clearance.id, 'rejected')"
                                            class="px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600 transition"
                                            :class="{'opacity-50': clearance.status.toLowerCase() === 'rejected'}"
                                        >
                                            Decline
                                        </button>
                                    </div>
                                </template>
                                <template v-else>
                                    <span :class="{
                                        'px-2 py-1 rounded text-xs font-bold': true,
                                        'bg-gray-100 text-gray-700': true
                                    }">
                                        {{ clearance.status.charAt(0).toUpperCase() + clearance.status.slice(1) }}
                                    </span>
                                </template>
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <Link :href="getEditLink(clearance)"
                                    class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                Edit
                                </Link>
                                <button @click="showModal(clearance.id)"
                                    class="inline-block px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition"
                                    v-if="['Admin', 'SuperAdmin'].includes(page.props.auth.role)">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-else class="text-center py-12 text-gray-400 text-lg font-medium">
                No clearance records found.
            </div>
        </div>
    </Layout>
</template>
