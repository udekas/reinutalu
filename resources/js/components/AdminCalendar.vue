<script setup lang="ts">
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { VueCal, type CalendarEvent } from 'vue-cal';
import 'vue-cal/style';
import Popup from './Popup.vue';

const events = ref<CalendarEvent[]>([]);
const showForm = ref(false);
const popupVisible = ref(false);
const selectedEvent = ref<CalendarEvent | null>(null);

const newEvent = ref({
    title: '',
    date: '',
    startTime: '',
    endTime: '',
    description: '',
});

const fetchEvents = async () => {
    try {
        const res = await axios.get('/events');
        events.value = res.data
            .map((event: any) => {
                const start = new Date(event.start);
                const end = new Date(event.end);

                if (isNaN(start.getTime()) || isNaN(end.getTime())) {
                    console.warn('Skipping invalid event:', event);
                    return null;
                }

                return {
                    ...event,
                    start,
                    end,
                };
            })
            .filter((e) => e !== null);
    } catch (error) {
        console.error('Error loading events:', error);
    }
};

onMounted(fetchEvents);

const handleAddEvent = async () => {
    const { title, date, startTime, endTime, description } = newEvent.value;

    if (!title || !date || !startTime || !endTime) {
        alert('Please fill in all fields');
        return;
    }

    const start = new Date(`${date}T${startTime}`);
    const end = new Date(`${date}T${endTime}`);

    try {
        await axios.post('/admin/events', {
            title,
            description,
            start: `${date}T${startTime}`,
            end: `${date}T${endTime}`,
        });

        await fetchEvents();
        showForm.value = false;

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

const handleEventChange = async ({ event }: { event: CalendarEvent }) => {
    try {
        const res = await axios.put(`/admin/events/${event.id}`, {
            title: event.title,
            start: new Date(event.start).toISOString(),
            end: new Date(event.end).toISOString(),
        });
        const index = events.value.findIndex((e) => e.id === event.id);
        if (index !== -1) events.value[index] = res.data;
    } catch (error) {
        console.error('Update failed:', error);
    }
};

const handleEventDelete = async (event: CalendarEvent) => {
    if (!event || !event.id) {
        console.error('Event object or event.id is missing:', event);
        return;
    }

    try {
        await axios.delete(`/admin/events/${event.id}`);
        events.value = events.value.filter((e) => e.id !== event.id);
    } catch (error) {
        console.error('Delete failed:', error);
    }
};

const handleEventClick = (props: { event: CalendarEvent }) => {
    const event = props.event;
    if (event && event.id) {
        selectedEvent.value = event;
        popupVisible.value = true;
    } else {
        console.error('Event is invalid:', event);
    }
};

const closePopup = () => {
    popupVisible.value = false;
    selectedEvent.value = null;
};

const timeOptions = Array.from({ length: 24 * 2 }, (_, i) => {
    const hour = Math.floor(i / 2);
    const minute = i % 2 === 0 ? '00' : '30';
    return `${String(hour).padStart(2, '0')}:${minute}`;
});
</script>

<template>
    <div class="calendar-container">
        <button @click="showForm = !showForm" class="add-btn">
            {{ showForm ? 'Cancel' : 'Add Event' }}
        </button>

        <div v-if="showForm" class="event-form">
            <input v-model="newEvent.title" type="text" placeholder="Title" required class="input-field" />
            <input v-model="newEvent.date" type="date" required class="input-field" />
            <textarea v-model="newEvent.description" placeholder="Description" class="description-input"></textarea>
            <div class="time-select">
                <select v-model="newEvent.startTime" required class="time-field">
                    <option disabled value="">Start Time</option>
                    <option v-for="time in timeOptions" :key="time" :value="time">{{ time }}</option>
                </select>
                <select v-model="newEvent.endTime" required class="time-field">
                    <option disabled value="">End Time</option>
                    <option v-for="time in timeOptions" :key="time" :value="time">{{ time }}</option>
                </select>
            </div>
            <button @click="handleAddEvent" class="submit-btn">Save</button>
        </div>

        <VueCal
            style="height: 700px"
            :events="events"
            :editable-events="{ create: false, resize: false, drag: false, delete: true }"
            @event-change="handleEventChange"
            @event-delete="handleEventDelete"
            view="week"
            :views="['month', 'week', 'day']"
            :time-from="7 * 60"
            :time-to="18 * 60"
            :time-step="30"
            :snap-to-interval="30"
            @event-click="handleEventClick"
        >
            <template #event="props">
                <div class="calendar-event">
                    <strong class="event-title">{{ props.event.title }}</strong>
                    <br />
                    <span v-if="props.event.description" class="event-description">
                        {{ props.event.description }}
                    </span>
                </div>
            </template>
        </VueCal>

        <Popup
            v-if="selectedEvent"
            :event="selectedEvent"
            :visible="popupVisible"
            @close="closePopup"
            @updated="fetchEvents"
            @deleted="
                () => {
                    fetchEvents();
                    closePopup();
                }
            "
        />
    </div>
</template>

<style scoped>
.calendar-container {
    padding: 1rem;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.add-btn {
    background-color: #4f46e5; /* Match with Admin Dashboard header color */
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    margin-bottom: 1rem;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-weight: bold;
}

.add-btn:hover {
    background-color: #3b3bdb;
}

.event-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1rem;
}

.input-field,
.time-field,
.description-input {
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 1rem;
    width: 100%;
}

.description-input {
    resize: vertical;
    min-height: 80px;
}

.time-select {
    display: flex;
    gap: 1rem;
}

.submit-btn {
    background-color: #10b981; /* Green for confirmation actions */
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-weight: bold;
}

.submit-btn:hover {
    background-color: #0ea774;
}

.calendar-event {
    font-size: 1rem;
    color: white; /* White text for event titles */
}

.event-title {
    font-weight: bold;
    color: white; /* White title for events */
}

.event-description {
    font-size: 0.9rem;
    color: #e0e0e0; /* Light gray for event descriptions */
}
</style>
