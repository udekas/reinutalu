<script setup>
import MasterFooter from '@/components/MasterFooter.vue';
import Navigation from '@/components/Navigation.vue';

const photos = [
  { src: '/assets/DSC_0243.webp', alt: 'Ratsutamine looduses' },
  { src: '/assets/DSC_0978.webp', alt: 'Hobusega mereääres' },
  { src: '/assets/DSC_1078.webp', alt: 'Lapsed ponidega' },
  { src: '/assets/DSC_0243.webp', alt: 'Ratsalaagri tegevused' },
  { src: '/assets/DSC_0243.webp', alt: 'Ratsutamine looduses' },
  { src: '/assets/DSC_0978.webp', alt: 'Hobusega mereääres' },
  { src: '/assets/DSC_1078.webp', alt: 'Lapsed ponidega' },
  { src: '/assets/DSC_0243.webp', alt: 'Ratsalaagri tegevused' },
  { src: '/assets/DSC_0243.webp', alt: 'Ratsutamine looduses' },
  { src: '/assets/DSC_0978.webp', alt: 'Hobusega mereääres' },
  { src: '/assets/DSC_1078.webp', alt: 'Lapsed ponidega' },
  { src: '/assets/DSC_0243.webp', alt: 'Ratsalaagri tegevused' },
  

  

];
</script>

<template>
  <Navigation />

  <section class="bg-secondary py-16">
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap justify-center gap-6">
        <div
          v-for="(photo, index) in photos"
          :key="index"
          class="w-full rounded-lg bg-white p-4 shadow sm:w-[45%] lg:w-[30%]"
        >
          <img
            :src="photo.src"
            :alt="photo.alt"
            class="h-64 w-full rounded-md object-cover"
          />
          <p class="mt-3 text-center text-yellow-950">{{ photo.alt }}</p>
        </div>
      </div>
    </div>
  </section>

  <MasterFooter />
</template>
