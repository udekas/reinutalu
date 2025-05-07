<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
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
  events_count: number;
  events: Event[]; // List of events the user is registered for
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

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Users', href: '/users' },
];

const users = ref<User[]>(props.users);
const totalUsers = ref(props.totalUsers);
const perPage = ref(props.perPage);
const currentPage = ref(1);
const loading = ref(false);
const searchQuery = ref('');

// Edit modal
const selectedUser = ref<User | null>(null);
const showEditModal = ref(false);
const availableEvents = ref<Event[]>(props.events);

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

// Search filter for users
const filteredUsers = computed(() => {
  if (!searchQuery.value.trim()) return users.value;
  return users.value.filter(user =>
    user.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    user.email.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

// Open the edit modal
const openEditModal = async (user: User) => {
  selectedUser.value = { ...user };
  showEditModal.value = true;

  // Fetch events for the selected user
  await fetchEventsForUser(user.id);
};

// Close the edit modal
const closeEditModal = () => {
  selectedUser.value = null;
  showEditModal.value = false;
};

// Save the updated user event registrations
const saveUser = async () => {
  if (!selectedUser.value) return;

  try {
    await axios.put(`/admin/users/${selectedUser.value.id}/events`, {
      event_ids: selectedUser.value.events.map(event => event.id),
    });

    showEditModal.value = false;
    fetchUsers(currentPage.value);
  } catch (error) {
    console.error('Error saving user event registrations:', error);
  }
};

// Delete a user
const deleteUser = async () => {
  if (!selectedUser.value) return;

  try {
    await axios.delete(`/admin/users/${selectedUser.value.id}`);
    users.value = users.value.filter(u => u.id !== selectedUser.value?.id);
    showEditModal.value = false;
    fetchUsers(currentPage.value);
  } catch (error) {
    console.error('Error deleting user:', error);
  }
};

// Add an event to the user
const addEventToUser = (event: Event) => {
  if (!selectedUser.value?.events.find(e => e.id === event.id)) {
    selectedUser.value!.events.push(event);
  }
};

// Remove an event from the user
const removeEventFromUser = (event: Event) => {
  if (selectedUser.value) {
    selectedUser.value!.events = selectedUser.value!.events.filter(e => e.id !== event.id);
  }
};

// Fetch events for a user
const fetchEventsForUser = async (userId: number) => {
  try {
    const response = await axios.get(`/admin/users/${userId}/events`);
    selectedUser.value!.events = response.data.events;
  } catch (error) {
    console.error('Error fetching events for user:', error);
  }
};

// Pagination handlers
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

      <input
        v-model="searchQuery"
        type="text"
        placeholder="Otsi nime või emaili järgi..."
        class="w-full px-3 py-2 border rounded shadow-sm"
      />

      <div v-if="loading">Laen kasutajaid...</div>

      <table v-else class="w-full border border-gray-300 table-auto">
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

      <div class="flex justify-between mt-4">
        <button
          :disabled="currentPage <= 1"
          @click="goToPage(currentPage - 1)"
          class="px-4 py-2 bg-gray-300 text-white rounded hover:bg-gray-400"
        >
          Eelmine
        </button>

        <span>{{ currentPage }} / {{ totalPages }}</span>

        <button
          :disabled="currentPage >= totalPages"
          @click="goToPage(currentPage + 1)"
          class="px-4 py-2 bg-gray-300 text-white rounded hover:bg-gray-400"
        >
          Järgmine
        </button>
      </div>
    </div>

    <!-- Edit Modal -->
    <div
      v-if="showEditModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
      <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
        <h3 class="text-xl font-semibold mb-4">Muuda kasutaja üritusi</h3>

        <div class="mb-4">
          <h4 class="font-semibold mb-2">Registreeritud üritused</h4>
          <div>
            <div v-for="event in selectedUser?.events" :key="event.id" class="flex justify-between mb-2">
              <span>{{ event.title }}</span>
              <button
                @click="removeEventFromUser(event)"
                class="px-2 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600"
              >
                Eemalda
              </button>
            </div>
          </div>
        </div>

        <div class="mb-4">
          <h4 class="font-semibold mb-2">Registreeri üritusele</h4>
          <div>
            <div v-for="event in availableEvents" :key="event.id" class="flex justify-between mb-2">
              <span>{{ event.title }}</span>
              <button
                @click="addEventToUser(event)"
                class="px-2 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600"
              >
                Lisa
              </button>
            </div>
          </div>
        </div>

        <div class="flex justify-between">
          <button
            @click="deleteUser"
            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
          >
            Kustuta
          </button>

          <div class="flex gap-2">
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
    </div>
  </AppLayout>
</template>
