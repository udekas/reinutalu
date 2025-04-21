<script setup lang="ts">
import Calendar from '@/components/Calendar.vue'; // assuming this is where your calendar component is located
import UserCalendar from '@/components/UserCalendar.vue';
import AppLayout from '@/layouts/AppLayout.vue'; // assuming this is your layout
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 text-2xl">
            Minu trennid
        </div>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 text-2xl">
            Kalender
            <UserCalendar />
        </div>
    </AppLayout>
</template>
