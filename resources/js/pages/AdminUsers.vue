<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { computed, ref } from 'vue';

interface Event {
    id: number;
    title: string;
}

interface User {
    id: number;
    name: string;
    email: string;
    events_count: number;
    events: Event[];
}

const props = defineProps({
    users: {
        type: Array as () => User[],
        required: true,
    },
    events: {
        type: Array as () => Event[],
        required: true,
    },
    totalUsers: {
        type: Number,
        required: true,
    },
    perPage: {
        type: Number,
        required: true,
    },
});

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Users', href: '/users' }];

const users = ref<User[]>(props.users);
const totalUsers = ref(props.totalUsers);
const perPage = ref(props.perPage);
const currentPage = ref(1);
const loading = ref(false);
const searchQuery = ref('');

// Fetch paginated users
const fetchUsers = async (page: number) => {
    loading.value = true;

    try {
        const response = await axios.get('/admin/users', {
            params: {
                page,
                per_page: perPage.value,
                search: searchQuery.value,
            },
            
        });
        
        users.value = response.data.users;
        totalUsers.value = response.data.total;
        currentPage.value = page;
    } catch (error) {
        console.error('Error fetching users:', error);
    } finally {
        loading.value = false;
    }
};

// Delete a user
const deleteUser = async (user: User) => {
    if (!confirm(`Oled kindel, et soovid kustutada kasutaja "${user.name}"?`)) return;

    try {
        await axios.delete(`/admin/users/${user.id}`);
      // await fetchUsers(currentPage.value);
        location.reload();
    } catch (error) {
        console.error('Kasutaja kustutamine ebaõnnestus:', error);
    }
};

// Filtered search
const filteredUsers = computed(() => {
    if (!searchQuery.value.trim()) return users.value;
    return users.value.filter(
        (user) =>
            user.name.toLowerCase().includes(searchQuery.value.toLowerCase()) || user.email.toLowerCase().includes(searchQuery.value.toLowerCase()),
    );
});

// Pagination
const totalPages = computed(() => Math.ceil(totalUsers.value / perPage.value));

const goToPage = (page: number) => {
    if (page > 0 && page <= totalPages.value) {
        fetchUsers(page);
    }
};
</script>

<template>
    <Head title="Reinu Ratsatalu" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4">
            <h2 class="text-2xl font-semibold">Kasutajad</h2>

            <input v-model="searchQuery" type="text" placeholder="Otsi nime või emaili järgi..." class="w-full rounded border px-3 py-2 shadow-sm" />

            <div v-if="loading">Laen kasutajaid...</div>

            <table v-else class="w-full table-auto border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">Nimi</th>
                        <th class="border px-4 py-2 text-left">Email</th>
                        <th class="border px-4 py-2 text-left">Registreeritud üritused</th>
                        <th class="border px-4 py-2 text-left">Tegevused</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in filteredUsers" :key="user.id">
                        <td class="border px-4 py-2">{{ user.name }}</td>
                        <td class="border px-4 py-2">{{ user.email }}</td>
                        <td class="border px-4 py-2">{{ user.events_count }}</td>
                        <td class="border px-4 py-2">
                            <button @click="deleteUser(user)" class="rounded bg-red-500 px-3 py-1 text-white hover:bg-red-600">Kustuta</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4 flex justify-between">
                <button
                    :disabled="currentPage <= 1"
                    @click="goToPage(currentPage - 1)"
                    class="rounded bg-gray-300 px-4 py-2 text-white hover:bg-gray-400"
                >
                    Eelmine
                </button>

                <span>{{ currentPage }} / {{ totalPages }}</span>

                <button
                    :disabled="currentPage >= totalPages"
                    @click="goToPage(currentPage + 1)"
                    class="rounded bg-gray-300 px-4 py-2 text-white hover:bg-gray-400"
                >
                    Järgmine
                </button>
            </div>
        </div>
    </AppLayout>
</template>
