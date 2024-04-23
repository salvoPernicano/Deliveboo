<template>
    <AuthenticatedLayout>
        <div>
      <h1>Menu dei Ristoranti</h1>
      <ul>
      
            <h2>{{ restaurant.id }}</h2>
          <h2>{{ restaurant.name }}</h2>
          <p>{{ restaurant.address }}</p>
          <!-- Aggiungi qui altre informazioni del ristorante -->

      </ul>
      <div v-for="dish in dishes">
        <h2>{{ dish.name }}</h2>
      </div>
    </div>
    <Link
          class="bg-green-700 p-3 text-white font-bold border rounded-lg"
          :href="route('dishes.create', { restaurant: restaurant.id })"
        >
          Crea piatto per {{ restaurant.name }}
</Link>
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
  