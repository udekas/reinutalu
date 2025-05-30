<script setup lang="ts">
import AdminCalendar from '@/components/AdminCalendar.vue';
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
    <Head title="Administraator - Reinu Ratsatalu" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="dashboard-container">
            <h1 class="section-title">Administraator</h1>
            <p class="section-description">Tee, lisa või muuda üritusi.</p>

            <div class="calendar-section">
                <h2 class="calendar-header-title">Kalender</h2>
                <p class="calendar-header-description">Loo või muuda üritusi ja treeninguid.</p>
                <AdminCalendar />
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.dashboard-container {
    padding: 2rem;
    font-family: 'Arial', sans-serif;
    background-color: #f7f7f7; /* Soft gray background */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Light shadow */
}

.section-title {
    font-size: 2rem;
    font-weight: bold;
    color: #333; /* Dark gray for the title */
    margin-bottom: 0.5rem;
}

.section-description {
    font-size: 1rem;
    color: #666; /* Slightly lighter gray for descriptions */
    margin-bottom: 2rem;
}

.calendar-section {
    background-color: #ffffff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); /* Soft shadow */
}

.calendar-header-title {
    font-size: 1.5rem;
    color: #1f2937; /* Soft blue for header */
}

.calendar-header-description {
    color: #555; /* Medium gray for text */
    margin-top: 0.5rem;
}
</style>
