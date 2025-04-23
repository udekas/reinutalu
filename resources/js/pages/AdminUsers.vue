<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { type BreadcrumbItem } from '@/types';
import axios from 'axios';

interface Event {
  id: number;
  title: string;
}

interface User {
  id: number;
  name: string;
  email: string;
  events_count: number; // The count of registered events
}

// Declare the users prop passed by Inertia
const props = defineProps({
    users: {
        type: Array as () => User[],
        required: true,
    },
});

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Users', href: '/users' },
];

// You can now directly use the `props.users` instead of fetching it manually
const users = ref(props.users);
const loading = ref(false);

// Edit modal logic
const selectedUser = ref<User | null>(null);
const showEditModal = ref(false);

const openEditModal = (user: User) => {
  selectedUser.value = { ...user }; // Clone to avoid mutating original
  showEditModal.value = true;
};

const closeEditModal = () => {
  selectedUser.value = null;
  showEditModal.value = false;
};

const saveUser = async () => {
  if (!selectedUser.value) return;
  try {
    await axios.put(`/admin/users/${selectedUser.value.id}`, {
      name: selectedUser.value.name,
      email: selectedUser.value.email,
    });
    showEditModal.value = false;
    // Optionally, you could refresh users if needed
    users.value = await axios.get('/admin/users');
  } catch (error) {
    console.error('Error saving user:', error);
  }
};
</script>

<template>
  <Head title="Reinu Ratsatalu" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 text-xl">
      <h2 class="text-2xl font-semibold mb-4">Kasutajad</h2>

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
          <tr v-for="user in users" :key="user.id">
            <td class="border px-4 py-2">{{ user.name }}</td>
            <td class="border px-4 py-2">{{ user.email }}</td>
            <td class="border px-4 py-2">{{ user.events_count }}</td>
            <td class="border px-4 py-2">
              <button
                @click="openEditModal(user)"
                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"
              >
                Muuda
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Edit Modal -->
    <div
      v-if="showEditModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
      <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
        <h3 class="text-xl font-semibold mb-4">Muuda kasutajat</h3>

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Nimi</label>
          <input
            v-model="selectedUser!.name"
            type="text"
            class="w-full mt-1 px-3 py-2 border rounded"
          />
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input
            v-model="selectedUser!.email"
            type="email"
            class="w-full mt-1 px-3 py-2 border rounded"
          />
        </div>

        <div class="flex justify-end gap-2">
          <button
            @click="closeEditModal"
            class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500"
          >
            Tühista
          </button>
          <button
            @click="saveUser"
            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600"
          >
            Salvesta
          </button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
