<template>
  <AuthenticatedLayout>
    <main class="text-center text-white p-5">
      <h1>Menu del Ristorante {{ restaurant.name }}</h1>
      <div v-if="dishes.length > 0" class="w-full bg-white container mx-auto flex justify-center gap-8 text-center text-white rounded-lg m-5 p-4">
        <div class="flex flex-col gap-y-2 bg-red-400 min-h-60 p-4 rounded-lg w-80" v-for="dish in dishes">
          <h4>Nome piatto: {{ dish.name }}</h4>
          <img class="w-4/5 mx-auto" :src="`/storage/${dish.image}`" alt="Immagine del piatto" >
          <p>{{ dish.description }}</p>
          <span>Prezzo: €{{ dish.price }}</span>
          <span>Stile cucina: {{ dish.category }}</span>
        </div>
      </div>
      <Link class="bg-green-500 hover:bg-green-800 p-3 text-white font-bold border rounded-lg mt-5 fixed bottom-100 left-1/2 transform -translate-x-1/2"
        :href="route('dishes.create', { restaurant: restaurant.id })">
      Crea piatto per {{ restaurant.name }}
      </Link>

    </main>
  </AuthenticatedLayout>

</template>

<script setup>

import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
  restaurant: Object,
  dishes: Array
});
</script>

<style>
/* Stili opzionali */
</style>