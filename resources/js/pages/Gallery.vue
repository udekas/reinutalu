<script setup>
import MasterFooter from '@/components/MasterFooter.vue';
import Navigation from '@/components/Navigation.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const images = ref([
  { id: 1, src: '/images/image1.jpg', alt: 'Image 1' },
  { id: 2, src: '/images/image2.jpg', alt: 'Image 2' },
  { id: 3, src: '/images/image3.jpg', alt: 'Image 3' },
  { id: 4, src: '/images/image4.jpg', alt: 'Image 4' },
  { id: 5, src: '/images/image5.jpg', alt: 'Image 5' },
  { id: 6, src: '/images/image6.jpg', alt: 'Image 6' },
  { id: 7, src: '/images/image7.jpg', alt: 'Image 7' },
  { id: 8, src: '/images/image8.jpg', alt: 'Image 8' },
  { id: 9, src: '/images/image9.jpg', alt: 'Image 9' },
  { id: 10, src: '/images/image10.jpg', alt: 'Image 10' },
  { id: 11, src: '/images/image11.jpg', alt: 'Image 11' },
  { id: 12, src: '/images/image12.jpg', alt: 'Image 12' },
  // Add more images as needed
]);
</script>

<template>
    <Head>
  <title>Your page title</title>
  <meta name="description" content="Your page description">
</Head>
  <Navigation />

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4">
    <div
      v-for="image in images"
      :key="image.id"
      class="overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300"
    >
      <img
        :src="image.src"
        :alt="image.alt"
        class="w-full h-60 object-cover hover:scale-105 transition-transform duration-300"
      />
    </div>
  </div>

  <MasterFooter />
</template>

