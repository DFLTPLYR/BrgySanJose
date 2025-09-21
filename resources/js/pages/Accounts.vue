<script setup>
import Layout from '@/layouts/Layout.vue';
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const page = usePage();

const props = defineProps({
    pendingUser: {
        type: Array,
        default: () => []
    }
});

const sort = ref({
    search: '',
    date: 'Asc'
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

const switchDateSort = () => {
    sort.value.date = sort.value.date === 'Asc' ? 'Desc' : 'Asc';
};

const capitalize = (s) => s ? s.charAt(0).toUpperCase() + s.slice(1) : '';

const sortedUsers = computed(() => {
    let sorted = [...props.pendingUser].sort((a, b) => {
        const dateA = new Date(a.created_at);
        const dateB = new Date(b.created_at);
        return sort.value.date === 'Asc' ? dateA - dateB : dateB - dateA;
    });

    if (sort.value.search.trim()) {
        const query = sort.value.search.trim().toLowerCase();
        sorted = sorted.filter((user) => {
            const fullName = user.name ? user.name.toLowerCase() : '';
            return fullName.includes(query);
        });
    }

    return sorted;
});

const updateStatus = async (id, newStatus) => {
    const userToUpdate = props.pendingUser.find(u => u.id === id);
    if (!userToUpdate) return;

    const originalStatus = userToUpdate.status;

    try {
        userToUpdate.status = newStatus;
        activeDropdown.value = null;

        await router.visit(route('user.updateStatus', { user: id }), {
            method: 'put',
            data: { status: newStatus },
            onError: (errors) => {
                userToUpdate.status = originalStatus;
                console.error('Update status errors:', errors);

                // Show specific error message
                const errorMessage = errors.message || errors.error || 'Failed to update status';
                Swal.fire('Error!', errorMessage, 'error');
            },
            onSuccess: () => {
                Swal.fire('Success!', `User status updated to ${newStatus}`, 'success');
            }
        });
    } catch (error) {
        userToUpdate.status = originalStatus;
        console.error('Update status catch error:', error);
        Swal.fire('Error!', 'Unexpected error occurred', 'error');
    }
};

const showModal = (id) => {
    Swal.fire({
        title: 'Do you want to delete this user?',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('user.destroy', id), {
                onSuccess: () => {
                    Swal.fire('Deleted!', '', 'success');
                }
            });
        }
    });
};
</script>

<template>
    <Layout>
        <div class="bg-white p-8 rounded-xl shadow w-full space-y-6">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Accounts Dashboard</h1>

            <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-8">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Sort by Date</label>
                    <button @click="switchDateSort"
                        class="px-4 py-2 bg-blue-100 rounded-md border border-blue-200 text-blue-700 font-medium shadow-sm hover:bg-blue-200 transition">
                        {{ sort.date === 'Asc' ? '↑ Oldest First' : '↓ Newest First' }}
                    </button>
                </div>
                <div class="flex-1">
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Search Name</label>
                    <input type="text" v-model="sort.search" placeholder="Search by name..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-200 focus:outline-none transition">
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4" v-if="sortedUsers.length > 0">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3 cursor-pointer" @click="switchDateSort">
                                Date Registered
                                <span v-if="sort.date === 'Asc'">▲</span>
                                <span v-else>▼</span>
                            </th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in sortedUsers" :key="user.id" class="border-b hover:bg-gray-100 transition">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ user.id }}</td>
                            <td class="px-6 py-4">{{ user.name || 'N/A' }}</td>
                            <td class="px-6 py-4">{{ user.email || 'N/A' }}</td>
                            <td class="px-6 py-4">
                                {{ user.created_at ? new Date(user.created_at).toLocaleDateString('en-US', {
                                    month: 'short', day: 'numeric', year: 'numeric'
                                }) : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 relative" data-dropdown>
                                <div @click.stop="toggleDropdown(user.id)" :class="{
                                    'cursor-pointer inline-block px-2 py-1 rounded text-xs font-bold transition': true,
                                    'bg-yellow-100 text-yellow-700 hover:bg-yellow-200': user.status === 'pending',
                                    'bg-green-100 text-green-700 hover:bg-green-200': user.status === 'approved',
                                    'bg-red-100 text-red-700 hover:bg-red-200': user.status === 'rejected'
                                }">
                                    {{ capitalize(user.status) }}
                                </div>
                                <div v-if="activeDropdown === user.id"
                                    class="absolute mt-2 bg-white border rounded shadow z-20 px-4 py-2 flex gap-2"
                                    style="left: 50%; transform: translateX(-50%);">
                                    <button @click.stop="updateStatus(user.id, 'approved')"
                                        class="px-2 py-1 bg-green-500 text-white text-xs rounded hover:bg-green-600 transition"
                                        :class="{ 'opacity-50': user.status === 'approved' }">
                                        Approve
                                    </button>
                                    <button @click.stop="updateStatus(user.id, 'rejected')"
                                        class="px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600 transition"
                                        :class="{ 'opacity-50': user.status === 'rejected' }">
                                        Reject
                                    </button>
                                </div>
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <button @click="showModal(user.id)"
                                    class="inline-block px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-else class="text-center py-12 text-gray-400 text-lg font-medium">
                No pending user registrations found.
            </div>
        </div>
    </Layout>
</template>
