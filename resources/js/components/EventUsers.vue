<script setup lang="ts">
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';

const props = defineProps<{
  userId: number
}>();

const registeredEvents = ref<any[]>([]);

const fetchRegisteredEvents = async () => {
  try {
    const res = await axios.get(`/users/${props.userId}/events/registered`);
    registeredEvents.value = res.data;
  } catch (error) {
    console.error('Error fetching registered events:', error);
  }
};

onMounted(fetchRegisteredEvents);

// Allow parent to trigger refresh manually if needed
defineExpose({ fetchRegisteredEvents });
</script>

<template>
  <div class="mt-6">
    <h3 class="text-xl font-semibold mb-2">Minu trennid</h3>
    <ul v-if="registeredEvents.length" class="list-disc pl-5 space-y-1">
      <li v-for="event in registeredEvents" :key="event.id">
        {{ event.title }} – {{ new Date(event.start).toLocaleDateString() }}
      </li>
    </ul>
    <p v-else class="text-gray-500">No registered events.</p>
  </div>
</template>
