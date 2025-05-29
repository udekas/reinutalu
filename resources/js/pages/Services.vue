<script setup lang="ts">
import MasterFooter from '@/components/MasterFooter.vue';
import Navigation from '@/components/Navigation.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    // Define your form fields here, e.g., name: '', email: ''
});

const submit = () => {
    post(route('services'));
};

function post(arg0: string) {
    throw new Error('Function not implemented.');
}
</script>

<template>
    <Navigation></Navigation>
    <div class="font-sans text-gray-800">
        
        <section class="flex h-screen items-center justify-center bg-cover bg-center text-center text-white">
            <div
                class="justify-top container mx-auto flex h-full flex-col items-center bg-[url(/assets/DSC_1078.webp)] bg-cover bg-center px-4 text-center"
            >
                <h1 class="mx-auto mt-24 text-4xl font-bold text-yellow-950 md:text-5xl lg:text-6xl">Koge vabadust hobuse seljas</h1>
                

                >
            </div>
        </section>
    </div>
    <MasterFooter></MasterFooter>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

.nav-links {
    clip-path: circle(0px at 90% -10%);
}

.nav-links.active {
    clip-path: circle(1000px at 90% -10%);
}

.toggle .line1 {
    transform: rotate(-45deg) translate(-5px, 6px);
}
.toggle .line2 {
    opacity: 0;
}
.toggle .line3 {
    transform: rotate(45deg) translate(-5px, -6px);
}
</style>
