<script setup lang="ts">
import axios from 'axios';
import { defineEmits, onMounted, ref } from 'vue';
import { VueCal, type CalendarEvent } from 'vue-cal';
import 'vue-cal/style';

const emit = defineEmits(['registerEvent', 'unregisterEvent']);

const user = ref({ id: 1 }); // Replace with actual user data from backend
const events = ref<CalendarEvent[]>([]);
const showForm = ref(false);

const newEvent = ref({
    title: '',
    date: '',
    startTime: '',
    endTime: '',
    description: '',
});

const fetchEvents = async () => {
    try {
        const res = await axios.get('/events'); // Fetch all events created by the admin
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
        await axios.post('/events', {
            title,
            description,
            start: start.toISOString(),
            end: end.toISOString(),
        });

        await fetchEvents();

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
        const res = await axios.put(`/events/${event.id}`, {
            title: event.title,
            start: new Date(event.start).toISOString(),
            end: new Date(event.end).toISOString(),
        });
        const index = events.value.findIndex((e:any) => e.id === event.id);
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

    if (!event || !event.id) {
        console.error('Event object or event.id is missing:', event);
        return;
    }

    try {
        await axios.delete(`/events/${event.id}`);
        events.value = events.value.filter((e:any) => e.id !== event.id);
    } catch (error) {
        console.error('Delete failed:', error);
    }
};

const timeOptions = Array.from({ length: 24 * 2 }, (_, i) => {
    const hour = Math.floor(i / 2);
    const minute = i % 2 === 0 ? '00' : '30';
    return `${String(hour).padStart(2, '0')}:${minute}`;
});
</script>

<template>
    <div class="calendar-container">
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

        <VueCal
            style="height: 400px; width: 400px"
            :editable-events="{ create: false, resize: false, drag: false, delete: false }"
            @event-change="handleEventChange"
            @event-delete="handleEventDelete"
            :events="events"
            events-on-month-view
            :views="{ days: { cols: 5, rows: 1 }, month: {} }"
            view="month"
            :time-from="7 * 60"
            :time-to="21 * 60"
            :time-step="15"
            :snap-to-interval="15"
        >
            <template #event="props">
                <div>
                    <strong>{{ props.event.title }}</strong
                    ><br />
                    <span v-if="props.event.description" style="font-size: 0.8rem; color: #ddd"> {{ props.event.description }} </span><br />
                </div>
            </template>
        </VueCal>
    </div>
</template>

<style scoped>
.calendar-container {
    height: 441px;
    width: 400px;
    padding: 1rem;
    font-family: Arial, sans-serif;
}

.vuecal__scrollable--month-view {
    .vuecal__cell {
        height: 50px;
    }
    .vuecal__event {
        height: 48px;
        margin-top: 1px;
    }
    .vuecal__event-details {
        font-size: 11px;
        white-space: nowrap;
        padding: 0;
    }
    .vuecal__cell--has-events {
        flex-direction: row-reverse;
        overflow: hidden;
        justify-content: flex-start;
    }
}
.vuecal__cell--has-events {
    background-color: #00dbff1c;
}
.vuecal {
    --vuecal-primary-color: #a14619;
    --vuecal-secondary-color: #2e2e2e;
    --vuecal-base-color: #ffffff;
    --vuecal-contrast-color: #000000;
    --vuecal-border-color: color-mix(in srgb, var(--vuecal-base-color) 8%, transparent);
    --vuecal-header-color: var(--vuecal-base-color);
    --vuecal-event-color: rgb(253, 253, 253);
    --vuecal-event-border-color: currentColor;
    --vuecal-border-radius: 6 px;
    --vuecal-height: 500 px;
    --vuecal-min-schedule-width: 0 px;
    --vuecal-min-cell-width: 0 px;
    --vuecal-transition-duration: 0.25 s;
}
/* Your scoped styles here */
/* .calendar-container {
    padding: 1rem;
    font-family: Arial, sans-serif;
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

.event-form input {
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 6px;
}

.event-form select {
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 6px;
    background-color: white;
    font-size: 1rem;
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 6px;
    background-color: white;
    font-size: 1rem;
}

.submit-btn {
    background-color: #10b981;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    cursor: pointer;
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
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 6px;
    min-height: 60px;
    resize: vertical;
}
.vuecal {
    --vuecal-primary-color: #a14619;
    --vuecal-secondary-color: #2e2e2e;
    --vuecal-base-color: #ffffff;
    --vuecal-contrast-color: #000000;
    --vuecal-border-color: color-mix(in srgb, var(--vuecal-base-color) 8%, transparent);
    --vuecal-header-color: var(--vuecal-base-color);
    --vuecal-event-color: red;
    --vuecal-event-border-color: currentColor;
    --vuecal-border-radius: 6 px;
    --vuecal-height: 500 px;
    --vuecal-min-schedule-width: 0 px;
    --vuecal-min-cell-width: 0 px;
    --vuecal-transition-duration: 0.25 s;
} */
</style>
