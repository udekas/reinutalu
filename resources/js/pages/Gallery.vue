<script setup>
import MasterFooter from '@/components/MasterFooter.vue';
import Navigation from '@/components/Navigation.vue';

</script>

<template>
    <Navigation />

  <div class="gallery">
    <div class="gallery-item" v-for="(photo, index) in photos" :key="index">
      <img :src="photo.src" :alt="photo.alt" class="gallery-photo" />
    </div>
  </div>

  <MasterFooter />
</template>

