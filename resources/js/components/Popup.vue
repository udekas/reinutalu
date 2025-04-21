<script setup lang="ts">
import { defineProps, defineEmits, ref, onMounted, watch } from 'vue';
import axios from 'axios';

const props = defineProps({
  event: {
    type: Object,
    required: true,
  },
  visible: {
    type: Boolean,
    required: true,
  },
});

const emit = defineEmits<{
  (event: 'close'): void;
}>();

const users = ref<any[]>([]);
const loading = ref(true);

// Watch for changes in the event prop to fetch users when the event is selected
watch(() => props.event.id, (newId) => {
  if (newId) {
    fetchUsers();
  }
});

// Fetch the registered users for the event
const fetchUsers = async () => {
  if (!props.event.id) {
    console.error('Event ID is missing:', props.event);
    return;
  }

  loading.value = true;
  try {
    const res = await axios.get(`/events/${props.event.id}/users`);
    users.value = res.data;
  } catch (error) {
    console.error('Error fetching users:', error);
  } finally {
    loading.value = false;
  }
};

// Close the popup
const closePopup = () => {
  emit('close');
};

// Unregister a user from the event
const unregisterUser = async (userId: number) => {
  try {
    await axios.delete(`/events/${props.event.id}/users/${userId}`);
    users.value = users.value.filter((user) => user.id !== userId);
  } catch (error) {
    console.error('Unregister failed:', error);
  }
};

// Initial fetch on mount if the event ID is already set
onMounted(() => {
  if (props.event.id) {
    fetchUsers();
  }
});
</script>

<template>
  <div v-if="visible" class="popup-overlay">
    <div class="popup-content">
      <div class="popup-header">
        <h3>Registered Users for "{{ props.event.title }}"</h3>
        <button @click="closePopup" class="close-btn">×</button>
      </div>

      <div class="popup-body">
        <div v-if="loading" class="loading-spinner">Loading...</div>
        
        <ul v-if="!loading && users.length" class="user-list">
          <li v-for="user in users" :key="user.id" class="user-item">
            <div class="user-info">
              <strong>{{ user.name }}</strong>
              <p>{{ user.email }}</p>
            </div>
            <button @click="unregisterUser(user.id)" class="unregister-btn">Unregister</button>
          </li>
        </ul>

        <p v-if="!loading && users.length === 0">No users registered for this event.</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.popup-content {
  background: white;
  padding: 20px;
  border-radius: 8px;
  max-width: 400px;
  width: 100%;
}

.popup-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 1.2rem;
}

.close-btn {
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
}

.popup-body {
  margin-top: 10px;
}

.loading-spinner {
  text-align: center;
  color: #888;
}

.user-list {
  list-style-type: none;
  padding: 0;
}

.user-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

.user-info {
  flex-grow: 1;
}

.unregister-btn {
  background-color: #f44336;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  cursor: pointer;
}

.unregister-btn:hover {
  background-color: #d32f2f;
}

p {
  text-align: center;
  color: #666;
}
</style>
