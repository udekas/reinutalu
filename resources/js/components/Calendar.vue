<script setup lang="ts">
import axios from 'axios';
import { onMounted, ref } from 'vue';
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
    <VueCal
        :editable-events="{ create: false, resize: false, drag: false, delete: false }"
        :events="events"
        events-on-month-view
        :views="{ month: {} }"
        view="month"
        :time-from="7 * 60"
        :time-to="21 * 60"
        :time-step="15"
        :snap-to-interval="15"
    >
        <template #event="props">
            <div class="flex flex-col">
                <strong>{{ props.event.title }}</strong>
                <p>{{ props.event._.startTimeFormatted24 }} - {{ props.event._.endTimeFormatted24 }}</p>
                <!-- <span v-if="props.event.description" style="font-size: 0.8rem"> {{ props.event.description }} </span><br /> -->
            </div>
        </template>
    </VueCal>
</template>

<style scoped>
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
</style>

<style >
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
</style>
