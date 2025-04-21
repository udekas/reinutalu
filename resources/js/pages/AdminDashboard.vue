<script setup lang="ts">
import AdminCalendar from '@/components/AdminCalendar.vue';
import Calendar from '@/components/Calendar.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin Dashboard',
        href: '/admin/dashboard',
    },
];
</script>

<template>
    <Head title="Admin Dashboard - Reinu Ratsatalu" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 text-2xl">
            Admin Dashboard: Manage events, users, etc.
        </div>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 text-2xl">
            Kalender
            <AdminCalendar />
        </div>
    </AppLayout>
</template>
