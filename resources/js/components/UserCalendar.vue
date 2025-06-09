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

// REGISTER/UNREGISTER LOGIC
const isRegistered = (event: any) => {
    return event.users?.some((u: any) => u.id === user.value.id);
};

const register = async (eventId: number) => {
    try {
        await axios.post(`/events/${eventId}/register`);
        await fetchEvents();
        emit('registerEvent');
    } catch (error) {
        console.error('Registration failed:', error);
    }
};

const unregister = async (eventId: number) => {
    try {
        await axios.delete(`/events/${eventId}/register`);
        await fetchEvents();
        emit('unregisterEvent');
    } catch (error) {
        console.error('Unregistration failed:', error);
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
        <VueCal
            style="height: 700px"
            :events="events"
            events-on-month-view
            :editable-events="{ create: false, resize: false, drag: false, delete: false }"
            view="month"
            :views="['month', 'week', 'day']"
            :time-from="7 * 60"
            :time-to="18 * 60"
            :time-step="15"
            :snap-to-interval="30"
        >
            <template #event="props">
                <div class="padding-2 flex flex-col">
                    <strong>{{ props.event.title }}</strong
                        ><br />
                        <span v-if="props.event.description" style="font-size: 0.8rem; color: #ddd; overflow: hidden; white-space: normal; padding-bottom: 0.5rem;"> {{ props.event.description }} </span>
                        <p>{{ props.event._.startTimeFormatted24 }} - {{ props.event._.endTimeFormatted24 }}</p>
                        <br />

                    <button v-if="isRegistered(props.event)" @click="unregister(props.event.id)" class="submit-btn bg-red-500 hover:bg-red-600">
                        Unregister
                    </button>

                    <button v-else @click="register(props.event.id)" class="submit-btn" :disabled="new Date(props.event.start) < new Date()">
                        Registreeri
                    </button>
                </div>
            </template>
        </VueCal>
    </div>
</template>

<style scoped>
/* Your scoped styles here */
.vuecal {
    --vuecal-primary-color: #1f2937;
    --vuecal-secondary-color: #c4bebe;
    --vuecal-base-color: #000000;
    --vuecal-contrast-color: #000000;
    --vuecal-border-color: color-mix(in srgb, var(--vuecal-base-color) 8%, transparent);
    --vuecal-header-color: var(--color-white);
    --vuecal-event-color: rgb(253, 253, 253);
    --vuecal-event-border-color: currentColor;
    --vuecal-border-radius: 6 px;
    --vuecal-height: 500 px;
    --vuecal-transition-duration: 0.25 s;
}

.calendar-container {
    padding: 1rem;
    font-family: Arial, sans-serif;
}
.submit-btn {
    background-color: #008cba;
    color: white;
    border: none;
    padding: 0.5rem;
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
<style>
/* ...your existing styles */
.vuecal--month-view .vuecal__body {
    grid-template-rows: repeat(6, auto) !important;
}

.vuecal__cell {
    min-height: 50px;
}
.vuecal--month-view .vuecal__event {
    width: 100% !important;
    left: 0 !important;
}

.vuecal--default-theme.vuecal--lg .vuecal__scrollable--month-view .vuecal__cell {
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-end;
    height: auto;
}

.vuecal--default-theme .vuecal__scrollable--month-view .vuecal__cell-events {
    overflow: hidden;
    flex-grow: 1;
    width: 100%;
    padding-inline: 4px;
    padding-bottom: 4px;
    height: auto;
}

.vuecal__event-details {
    display: flex;
    flex-direction: column;
    height: auto;
    overflow: break-word;
    white-space: normal;
}
</style>
