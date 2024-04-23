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
          <button class="bg-yellow-300 p-2 rounded-lg m-2 text-black font-bold" @click.prevent="edit(restaurant.id)">Edit</button>
          <button class="bg-red-500 p-2 rounded-lg m-2 text-white font-bold" @click.prevent="destroy(restaurant.id)">Delete</button>
          <button class="bg-blue-500 p-2 rounded-lg m-2 text-white font-bold" @click.prevent="viewMenu(restaurant.id)">Visualizza menu</button>

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
  import { Link, router } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


  
  defineProps({
    restaurants: Object
  });
  
function edit(id){
  router.get('/restaurant/'+id+'/edit')
}

function destroy(id){
  router.delete('/restaurant/'+id)
}

function viewMenu(restaurantId){
  router.get('/restaurant/'+restaurantId+'/dishes');
}

  </script>
  
  <style>

  </style>