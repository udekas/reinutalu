      <script setup>
      import { ref } from 'vue'
      import { router } from '@inertiajs/vue3'
      import Navigation from '@/components/Navigation.vue'
      import MasterFooter from '@/components/MasterFooter.vue'
      
      const sending = ref(false)
      
      const form = ref({
        name: '',
        email: '',
        datetime: '',
        message: '',
      })
      
      function submitBooking() {
        sending.value = true
      
        router.post('/booking/send', form.value, {
          onFinish: () => {
            sending.value = false
            alert('Broneerimine saadetud!')
          },
          onError: () => {
            sending.value = false
            alert('Midagi läks valesti.')
          },
        })
      }
      </script>
<template>
    <Navigation></Navigation>
    
  <div class="min-h-screen bg-white flex items-center justify-center p-6">
    <form @submit.prevent="submitBooking" class="w-full max-w-lg bg-white rounded-lg shadow-md p-8">
      <h2 class="text-2xl font-bold mb-6">Broneeri hobusesõit</h2>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Nimi</label>
        <input v-model="form.name" type="text" required class="mt-1 block w-full border rounded-md p-2" />
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">E-post</label>
        <input v-model="form.email" type="email" required class="mt-1 block w-full border rounded-md p-2" />
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Soovitud aeg</label>
        <input v-model="form.datetime" type="datetime-local" required class="mt-1 block w-full border rounded-md p-2" />
      </div>

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700">Lisainfo</label>
        <textarea v-model="form.message" rows="4" class="mt-1 block w-full border rounded-md p-2"></textarea>
      </div>

      <button
        type="submit"
        class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded"
        :disabled="sending"
      >
        {{ sending ? 'Saadan...' : 'Saada broneering' }}
      </button>
    </form>
  </div>
 <MasterFooter></MasterFooter>
</template>

