<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Calendar from './ui/calendar/Calendar.vue'; // Assuming you're using ShadCN Vue Calendar
import Popup from './Popup.vue'; // Assuming Popup is still required for event details
import { CalendarEvent } from './types'; // Define your event type here (adjust path as necessary)

// Variables for events and form state
const events = ref<CalendarEvent[]>([]); // Events for the calendar
const showForm = ref(false); // Control the visibility of the event creation form
const popupVisible = ref(false); // Popup visibility for event details
const selectedEvent = ref<CalendarEvent | null>(null); // Store selected event for popup

// New event object
const newEvent = ref({
    title: '',
    date: '',
    startTime: '',
    endTime: '',
    description: '',
});

// Fetch events from API
const fetchEvents = async () => {
    try {
        const res = await axios.get('/events'); // Fetch events from backend
        events.value = res.data.map((event: any) => {
            const start = new Date(event.start);
            const end = new Date(event.end);

            return {
                ...event,
                start,
                end,
            };
        });
    } catch (error) {
        console.error('Error loading events:', error);
    }
};

onMounted(fetchEvents); // Fetch events when the component is mounted

// Handle adding new event
const handleAddEvent = async () => {
    const { title, date, startTime, endTime, description } = newEvent.value;
    if (!title || !date || !startTime || !endTime) {
        alert('Please fill in all fields');
        return;
    }

    const start = new Date(`${date}T${startTime}`);
    const end = new Date(`${date}T${endTime}`);

    try {
        await axios.post('/events', {
            title,
            description,
            start: start.toISOString(),
            end: end.toISOString(),
        });
        fetchEvents(); // Reload events after adding
        showForm.value = false;

        // Reset the form
        newEvent.value = {
            title: '',
            date: '',
            startTime: '',
            endTime: '',
            description: '',
        };
    } catch (error) {
        console.error('Error adding event:', error);
    }
};

// Handle event click to show details in a popup
const handleEventClick = (event: CalendarEvent) => {
    selectedEvent.value = event; // Set the selected event
    popupVisible.value = true; // Show the popup
};

// Handle closing the popup
const closePopup = () => {
    popupVisible.value = false; // Hide the popup
    selectedEvent.value = null; // Reset the selected event
};

// Handle event update
const handleEventUpdate = async (event: CalendarEvent) => {
    try {
        const res = await axios.put(`/events/${event.id}`, {
            title: event.title,
            start: new Date(event.start).toISOString(),
            end: new Date(event.end).toISOString(),
        });
        // Update the local event list with the updated data
        const index = events.value.findIndex((e) => e.id === event.id);
        if (index !== -1) events.value[index] = res.data;
    } catch (error) {
        console.error('Update failed:', error);
    }
};

// Handle event delete
const handleEventDelete = async (event: CalendarEvent) => {
    try {
        await axios.delete(`/events/${event.id}`);
        events.value = events.value.filter((e) => e.id !== event.id);
    } catch (error) {
        console.error('Delete failed:', error);
    }
};

// Time options for event start and end times
const timeOptions = Array.from({ length: 24 * 2 }, (_, i) => {
    const hour = Math.floor(i / 2);
    const minute = i % 2 === 0 ? '00' : '30';
    return `${String(hour).padStart(2, '0')}:${minute}`;
});
</script>

<template>
  <div class="calendar-container">
    <!-- Button to toggle event form -->
    <button @click="showForm = !showForm" class="add-btn">
      {{ showForm ? 'Cancel' : 'Add Event' }}
    </button>

    <!-- Event creation form -->
    <div v-if="showForm" class="event-form">
      <input v-model="newEvent.title" type="text" placeholder="Title" required />
      <input v-model="newEvent.date" type="date" required />
      <textarea v-model="newEvent.description" placeholder="Description" class="description-input"></textarea>
      <select v-model="newEvent.startTime" required>
        <option disabled value="">Start Time</option>
        <option v-for="time in timeOptions" :key="time" :value="time">{{ time }}</option>
      </select>
      <select v-model="newEvent.endTime" required>
        <option disabled value="">End Time</option>
        <option v-for="time in timeOptions" :key="time" :value="time">{{ time }}</option>
      </select>
      <button @click="handleAddEvent" class="submit-btn">Save</button>
    </div>

    <!-- ShadCN Calendar (Month, Week, and Day views) -->
    <Calendar
      :events="events"
      :views="['month', 'week', 'day']"
      view="week" 
      :time-from="7 * 60"
      :time-to="18 * 60"
      :time-step="30"
      :snap-to-interval="30"
      @event-click="handleEventClick"
      @event-change="handleEventUpdate"
      @event-delete="handleEventDelete"
    >
      <template #event="props">
        <div>
          <strong>{{ props.event.title }}</strong>
          <br />
          <span v-if="props.event.description" style="font-size: 0.8rem; color: #ddd">{{ props.event.description }}</span>
        </div>
      </template>
    </Calendar>

    <!-- Popup for showing event details -->
    <Popup v-if="popupVisible" :event="selectedEvent" :visible="popupVisible" @close="closePopup" />
  </div>
</template>

<style scoped>
/* Style your calendar container */
.calendar-container {
  padding: 1rem;
  font-family: Arial, sans-serif;
  width: 100%;
  height: 80vh; /* Adjust calendar height */
}

/* Add button and styling for form */
.add-btn {
  background-color: #4f46e5;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  margin-bottom: 1rem;
  border-radius: 8px;
  cursor: pointer;
}

/* Event form styling */
.event-form {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  margin-bottom: 1rem;
}

.event-form input,
.event-form select {
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

.description-input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 6px;
  min-height: 60px;
  resize: vertical;
}
</style>
