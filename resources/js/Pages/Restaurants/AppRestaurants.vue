<template>
<AuthenticatedLayout>
    <Head title="Resturant" />
  <div class="text-center">
    <h1 class="text-white text-3xl font-bold my-4">Ristorante</h1>


      <div id="container" class="w-full flex flex-wrap justify-center items-center mx-auto p-5">

        <div id="card" class="text-center bg-white flex flex-col justify-center h-96 p-5 rounded-lg" v-for="restaurant in restaurants"
          :key="restaurant.id">
          <span>ID: {{ restaurant.id }}</span>
          <h2 class="text-black text-3xl font-extrabold mb-3">Nome ristorante: {{ restaurant.name }}</h2>
          <p>Descrizione: {{ restaurant.description }}</p>
          <h2 class="text-black text-xl font-extrabold mb-3">Indirizzo: {{ restaurant.address }}</h2>
          <button class="bg-yellow-300 p-2 rounded-lg m-2 text-black font-bold" @click.prevent="edit(restaurant.id)">Modifiche</button>
          <button class="bg-red-500 p-2 rounded-lg m-2 text-white font-bold" @click.prevent="destroy(restaurant.id)">Elimina</button>
          <Link :href="route('dishes.index', { restaurant: restaurant.id })" class="bg-blue-500 p-2 rounded-lg m-2 text-white font-bold">Visualizza menu</Link>

        </div>
      </div>
      <Link class="bg-green-500 px-8 py-2 text-white text-2xl font-bold border rounded-lg hover:bg-green-700" :href="route('restaurants.create')" >
                                    Crea
                                </Link>

    </div>
</AuthenticatedLayout>

  </template>

  <script setup>

  import { defineProps } from 'vue';
  import { Link, router } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { useRoute } from '@inertiajs/inertia-vue3';
  import { Head } from '@inertiajs/vue3';



  defineProps({
    restaurants: Object
  });

function edit(id){
  router.get('/restaurant/'+id+'/edit')
}

function destroy(id){
  router.delete('/restaurant/'+id)
}

function viewMenu(id){
  router.get('/restaurant/'+id+'/dishes');
}

  </script>

  <style>

  </style>
