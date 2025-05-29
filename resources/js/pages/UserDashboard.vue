<script setup lang="ts">
import UserCalendar from '@/components/UserCalendar.vue'; // Import your calendar component
import AppLayout from '@/layouts/AppLayout.vue'; // Import your layout component
import { type BreadcrumbItem } from '@/types'; // Import any types you need
import axios from 'axios';
import { onMounted, ref } from 'vue';

// Define breadcrumb data
const breadcrumbs: BreadcrumbItem[] = [{ title: 'Dashboard', href: '/dashboard' }];

// Define user data and events
const user = ref<any>(null); // Initially null
const registeredEvents = ref<Event[]>([]); // Store the registered events
const loadingEvents = ref<boolean>(false); // Track loading state

// Define the Event type
interface Event {
    id: number;
    title: string;
    start: string | Date;  // or Date if you prefer to work with Date objects directly
    end: string | Date;    // or Date if you prefer to work with Date objects
}

// Fetch user data and registered events on component mount
const fetchUserData = async () => {
    try {
        const res = await axios.get('/user'); // Adjust this to your actual user API endpoint
        user.value = res.data; // Store the fetched user data
        await fetchRegisteredEvents();  // Fetch registered events once user is loaded
    } catch (error) {
        console.error('Error fetching user:', error);
    }
};

// Fetch registered events after user data is loaded
const fetchRegisteredEvents = async () => {
    if (!user.value) return; // Ensure user data is loaded before fetching events
    loadingEvents.value = true;  // Start loading events
    try {
        const res = await axios.get('/my-events');
        console.log(res.data); // Log the response
        registeredEvents.value = res.data.map((event: any) => ({
            ...event,
            start: new Date(event.start),  // Convert start to Date
            end: new Date(event.end),      // Convert end to Date
        }));
    } catch (error) {
        console.error('Error fetching registered events:', error);
    } finally {
        loadingEvents.value = false;  // Stop loading after fetching
    }
};

// Unregister from an event
const unregisterEvent = async (eventId: number) => {
    try {
        await axios.delete(`/events/${eventId}/register`);
        await fetchRegisteredEvents();  // Reload events after unregistration
    } catch (error) {
        console.error('Error unregistering from event:', error);
    }
};

// Fetch user data when the component mounts
onMounted(fetchUserData);
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 text-2xl">
            <!-- Display user name or loading message -->
            <h2 v-if="user">{{ user.name }}'i registreeritud üritused</h2>
            <p v-else>Loading user data...</p>

            <!-- Registered Events List -->
            <ul v-if="registeredEvents.length" class="list-disc pl-5">
                <li v-for="event in registeredEvents" :key="event.id" class="flex items-center gap-4">
                    {{ event.title }} - {{ new Date(event.start).toLocaleString() }}
                    <button
                        @click="() => unregisterEvent(event.id)"
                        :disabled="loadingEvents"
                        class="rounded bg-red-500 px-3 py-1 text-sm text-white hover:bg-red-600"
                    >
                        Eemalda registreering
                    </button>
                </li>
            </ul>
            <p v-else>Pole veel ühtegi üritust, millele oled registreerinud.</p>
        </div>

        <!-- Calendar Section -->
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 text-2xl">
            <h2>Kalender</h2>
            <UserCalendar @registerEvent="fetchRegisteredEvents" />
        </div>
    </AppLayout>
</template>
