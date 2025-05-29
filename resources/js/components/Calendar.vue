<script setup lang="ts">
import axios from 'axios';
import { defineEmits, onMounted, ref } from 'vue';
import { VueCal, type CalendarEvent } from 'vue-cal';
import 'vue-cal/style';


const user = ref({ id: 1 }); // Replace with actual user data from backend
const events = ref<CalendarEvent[]>([]);



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

</script>

<template>
    <div class="calendar-container">
        <VueCal
            style="height: 400px; width: 400px"
            :editable-events="{ create: false, resize: false, drag: false, delete: false }"
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
