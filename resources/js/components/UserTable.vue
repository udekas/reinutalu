<script setup lang="ts">
import { Table } from '@/components/ui/table';
import { ref, onMounted } from 'vue';
import { columns } from '../pages/columns';
import axios from 'axios';

const users = ref([]);

// Load users from API (adjust this URL as needed)
const fetchUsers = async () => {
    try {
        const response = await axios.get('/admin/registered-users');
        users.value = response.data;
    } catch (error) {
        console.error('Failed to fetch users:', error);
    }
};

onMounted(fetchUsers);
</script>

<template>
    <Table :columns="columns" :data="users" class="rounded-md border" />
</template>
