<script setup lang="ts">
defineProps<{
    users: Array<{ id: number; name: string; email: string }>;
}>();
</script>

<template>
    <div v-if="users.length" class="mt-2 text-sm text-gray-700">
        <h4 class="font-semibold mb-1">Registered Users:</h4>
        <ul class="list-disc pl-5">
            <li v-for="user in users" :key="user.id">
                {{ user.name }} <span class="text-gray-500 text-xs">({{ user.email }})</span>
            </li>
        </ul>
    </div>
    <p v-else class="text-sm text-gray-500">No users registered.</p>
</template>
