<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { VueCal, type CalendarEvent } from 'vue-cal';
import 'vue-cal/style';

const events = ref<CalendarEvent[]>([]);

const showForm = ref(false);
const newEvent = ref({
  title: '',
  start: '',
  end: ''
});

const fetchEvents = async () => {
  try {
    const res = await axios.get('/events');

    events.value = res.data.map((event: any) => {
      const start = new Date(event.start);
      const end = new Date(event.end);

      // Avoid invalid date errors
      if (isNaN(start.getTime()) || isNaN(end.getTime())) {
        console.warn('Skipping invalid event:', event);
        return null;
      }

      return {
        ...event,
        start,
        end
      };
    }).filter(e => e !== null);

  } catch (error) {
    console.error('Error loading events:', error);
  }
};


onMounted(fetchEvents);

const handleAddEvent = async () => {
  if (!newEvent.value.title || !newEvent.value.start || !newEvent.value.end) {
    alert('Please fill in all fields');
    return;
  }

  try {
    const res = await axios.post('/events', {
      title: newEvent.value.title,
      start: new Date(newEvent.value.start).toISOString(),
      end: new Date(newEvent.value.end).toISOString()
    });

    await fetchEvents();
    showForm.value = false;

    newEvent.value = {
      title: '',
      start: '',
      end: ''
    };
  } catch (error) {
    console.error('Error adding event:', error);
  }
};




const handleEventChange = async ({ event }: { event: CalendarEvent }) => {
  try {
    const res = await axios.put(`/events/${event.id}`, {
      title: event.title,
      start: new Date(event.start).toISOString(),
      end: new Date(event.end).toISOString()
    });
    const index = events.value.findIndex((e) => e.id === event.id);
    if (index !== -1) events.value[index] = res.data;
  } catch (error) {
    console.error('Update failed:', error);
  }
};

const handleEventDelete = async ({ event }: { event: CalendarEvent }) => {
  try {
    await axios.delete(`/events/${event.id}`);
    events.value = events.value.filter((e) => e.id !== event.id);
  } catch (error) {
    console.error('Delete failed:', error);
  }
};
</script>

<template>
  <div class="calendar-container">
    <button @click="showForm = !showForm" class="add-btn">
      {{ showForm ? 'Cancel' : 'Add Event' }}
    </button>

    <div v-if="showForm" class="event-form">
      <input v-model="newEvent.title" type="text" placeholder="Title" required />
      <input v-model="newEvent.start" type="datetime-local" step="1800" required />
      <input v-model="newEvent.end" type="datetime-local" step="1800" required />
      <button @click="handleAddEvent" class="submit-btn">Save</button>
    </div>

    <VueCal
      style="height: 700px;"
      :events="events"
      :editable-events="{ create: false, resize: true, drag: true, delete: true }"
      @event-change="handleEventChange"
      @event-delete="handleEventDelete"
      view="week"
      :views="['month', 'week', 'day']"
      :time-from="7 * 60"
      :time-to="18 * 60"
      :time-step="30"
      :snap-to-interval="30"
    />
  </div>
</template>


<style scoped>
.calendar-container {
  padding: 1rem;
  font-family: Arial, sans-serif;
}

.add-btn {
  background-color: #4f46e5;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  margin-bottom: 1rem;
  border-radius: 8px;
  cursor: pointer;
}

.event-form {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  margin-bottom: 1rem;
}

.event-form input {
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 6px;
}

.submit-btn {
  background-color: #10b981;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  cursor: pointer;
}
</style>
