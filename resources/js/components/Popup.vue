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
const isEditing = ref(false);

// Editable form fields for event editing
const editForm = ref({
  title: '',
  description: '',
  start: '',
  end: ''
});

watch(() => props.event.id, (newId) => {
  if (newId) {
    fetchUsers();
    resetEditForm();
  }
});

const fetchUsers = async () => {
  if (!props.event.id) return;

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

const closePopup = () => {
  emit('close');
};

const unregisterUser = async (userId: number) => {
  if (!props.event.id) return;

  const url = `/events/${props.event.id}/users/${userId}/unregister`; // NEW URL
  console.log('Unregister URL:', url);

  try {
    const response = await axios.delete(url);
    if (response.status === 200) {
      users.value = users.value.filter((user) => user.id !== userId);
    } else {
      console.error('Unregister failed with status:', response.status);
    }
  } catch (error) {
    console.error('Unregister failed:', error);
  }
};

const deleteEvent = async () => {
  try {
    await axios.delete(`/events/${props.event.id}`);
    closePopup(); // Close popup after deletion
  } catch (error) {
    console.error('Failed to delete event:', error);
  }
};

const resetEditForm = () => {
  editForm.value = {
    title: props.event.title,
    description: props.event.description || '',
    start: props.event.start,
    end: props.event.end,
  };
};

const saveChanges = async () => {
  try {
    const res = await axios.put(`/events/${props.event.id}`, editForm.value);
    // Update event in the parent
    props.event.title = res.data.title;
    props.event.description = res.data.description;
    props.event.start = res.data.start;
    props.event.end = res.data.end;
    isEditing.value = false;
  } catch (error) {
    console.error('Failed to update event:', error);
  }
};

onMounted(() => {
  if (props.event.id) {
    fetchUsers();
    resetEditForm();
  }
});
</script>

<template>
  <div v-if="visible" class="popup-overlay">
    <div class="popup-content">
      <div class="popup-header">
        <h3 v-if="!isEditing">{{ props.event.title }}</h3>
        <h3 v-else>Edit Event</h3>
        <button @click="closePopup" class="close-btn">×</button>
      </div>

      <div class="popup-body">
        <!-- Edit form -->
        <div v-if="isEditing">
          <label>Title:</label>
          <input v-model="editForm.title" class="input" />
          <label>Description:</label>
          <textarea v-model="editForm.description" class="input" />
          <label>Start:</label>
          <input type="datetime-local" v-model="editForm.start" class="input" />
          <label>End:</label>
          <input type="datetime-local" v-model="editForm.end" class="input" />
          <div class="btn-row">
            <button @click="saveChanges" class="save-btn">Save</button>
            <button @click="isEditing = false" class="cancel-btn">Cancel</button>
          </div>
        </div>

        <!-- View Event Details -->
        <div v-else>
          <p><strong>Description:</strong> {{ props.event.description }}</p>

          <h4>Who are attending:</h4>
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

      <!-- Footer with Edit and Delete Buttons -->
      <div v-if="!isEditing" class="popup-footer">
        <button @click="isEditing = true" class="edit-btn">Edit Event</button>
        <button @click="deleteEvent" class="delete-btn">Delete Event</button>
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
  max-width: 500px;
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
.edit-btn, .save-btn, .cancel-btn, .delete-btn {
  background-color: #1976d2;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  margin-top: 10px;
  border-radius: 4px;
  cursor: pointer;
}
.cancel-btn {
  background-color: #999;
  margin-left: 10px;
}
.delete-btn {
  background-color: #f44336;
  margin-left: 10px;
}
.input {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
}
.btn-row {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}
</style>
