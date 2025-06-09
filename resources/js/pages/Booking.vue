<script setup>
import MasterFooter from '@/components/MasterFooter.vue';
import Navigation from '@/components/Navigation.vue';
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
const errors = usePage().props.errors;

const sending = ref(false);

const form = ref({
    name: '',
    email: '',
    datetime: '',
    message: '',
});

function submitBooking() {
    sending.value = true;

    router.post('/booking/send', form.value, {
        preserveScroll: true,
        onFinish: () => {
            sending.value = false;
        },
        onSuccess: () => {
            alert('Broneerimine saadetud!');
            form.value = { name: '', email: '', datetime: '', message: '' }; // Clear form
        },
        onError: (errors) => {
            console.error(errors);
            alert('Midagi läks valesti. Kontrolli väljasid.');
        },
    });
}
</script>
<template>
    <Navigation />

    <div class="flex min-h-screen items-center justify-center bg-white p-6">
        <form @submit.prevent="submitBooking" class="w-full max-w-lg rounded-lg bg-white p-8 shadow-md">
            <h2 class="mb-6 text-2xl font-bold">Broneeri hobusesõit</h2>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nimi</label>
                <input v-model="form.name" type="text" required class="mt-1 block w-full rounded-md border p-2" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">E-post</label>
                <input v-model="form.email" type="email" required class="mt-1 block w-full rounded-md border p-2" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Soovitud aeg</label>
                <input v-model="form.datetime" type="datetime-local" required class="mt-1 block w-full rounded-md border p-2" />
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Lisainfo</label>
                <textarea v-model="form.message" rows="4" class="mt-1 block w-full rounded-md border p-2"></textarea>
            </div>

            <button type="submit" class="rounded bg-yellow-600 px-4 py-2 font-bold text-white hover:bg-yellow-700" :disabled="sending">
                {{ sending ? 'Saadan...' : 'Saada broneering' }}
            </button>
        </form>
    </div>
    <MasterFooter />
</template>
