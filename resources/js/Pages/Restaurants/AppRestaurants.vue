<template>
<AuthenticatedLayout>
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
      <Link class="bg-green-700 p-3 text-white font-bold border rounded-lg" :href="route('restaurants.create')" >
                                    Crea
                                </Link>
    </div>
</AuthenticatedLayout>
     
  </template>
  
  <script setup>

  import { defineProps } from 'vue';
  import { Link } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

  
  defineProps({
    restaurants: Object
  });
  

  </script>
  
  <style>

  </style>