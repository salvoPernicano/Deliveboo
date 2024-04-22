<template>
    <!-- <AuthenticatedLayout> -->
      <div class="text-center">
    <h1 class="text-white text-3xl font-bold my-4">Ristorante</h1>
  
  
      <div id="container" class="w-full flex flex-wrap justify-center items-center mx-auto p-5">

        <div id="card" class="text-center bg-blue-200 flex flex-col justify-center h-96 p-5" v-for="restaurant in restaurants"
          :key="restaurant.id">
          <span>ID: {{ restaurant.id }}</span>
          <h2 class="text-black text-3xl font-extrabold mb-3">Titolo: {{ restaurant.name }}</h2>
          <p>Descrizione: {{ restaurant.description }}</p>
        </div>
      </div>
      
    </div>
  
  
    <!-- </AuthenticatedLayout> -->
  </template>
  
  <script setup>
//   import { router} from '@inertiajs/vue3';
//   import { Inertia } from '@inertiajs/inertia';
  import { defineProps } from 'vue';
//   import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

  
  defineProps({
    restaurants: Object
  });
  

  </script>
  
  <style>

  </style>