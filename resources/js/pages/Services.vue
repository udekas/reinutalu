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
      <!-- Hero Section -->
      <section class="container aspect-video max-w-screen bg-[url(/assets/DSC_0243.webp)] bg-cover bg-center px-4 text-center">
        <h1 class="hidden sm:block pt-24 mx-auto text-4xl font-bold sm:text-[5vw]"></h1>
      </section>
  
      <!-- Services Table Section -->
      <section class="bg-secondary py-16">
        <div class="container mx-auto px-4">
          <div class="flex flex-col gap-6 px-4">
            <div class="w-full rounded-lg bg-white p-6 shadow">
              <h2 class="mb-4 text-2xl font-semibold md:text-3xl">Teenused ja hinnad</h2>
              <table class="w-full table-auto text-left text-gray-800">
                <thead>
                  <tr class="border-b text-yellow-950">
                    <th class="pb-2 pr-4 text-lg font-semibold">Teenus</th>
                    <th class="pb-2 text-lg font-semibold">Hind</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="border-b">
                    <td class="py-2 pr-4">Ratsutamistund (30 min)</td>
                    <td class="py-2">20 €</td>
                  </tr>
                  <tr class="border-b">
                    <td class="py-2 pr-4">Ratsutamistund (60 min)</td>
                    <td class="py-2">35 €</td>
                  </tr>
                  <tr class="border-b">
                    <td class="py-2 pr-4">Ratsamatk looduses (90 min)</td>
                    <td class="py-2">45 €</td>
                  </tr>
                  <tr class="border-b">
                    <td class="py-2 pr-4">Laste sünnipäev hobustega</td>
                    <td class="py-2">150 €</td>
                  </tr>
                  <tr class="border-b">
                    <td class="py-2 pr-4">Ratsalaager (päev)</td>
                    <td class="py-2">60 €</td>
                  </tr>
                  <tr>
                    <td class="py-2 pr-4">Õppepäev koolidele / lasteaedadele</td>
                    <td class="py-2">Kokkuleppel</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
    <MasterFooter></MasterFooter>
  </template>
  

