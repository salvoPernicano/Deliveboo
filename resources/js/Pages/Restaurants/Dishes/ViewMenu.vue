<template>
  <Head title="Menu"></Head>
  <AuthenticatedLayout>
    <Head title="Menu" />
    <main class="text-center text-white p-5">
      <h1>Menu del Ristorante {{ restaurant.name }}</h1>

      <div v-if="dishes.length > 0"
        class="w-full bg-white container mx-auto flex flex-col justify-center gap-5 text-center text-white rounded-lg m-5 p-4">
        <div class="flex">
          <h4 class="text-black">
            I tuoi piatti
          </h4>
        </div>
        <div class="flex">
          <span class="text-gray-400">
            Qui puoi visualizzare i tuoi piatti, crearne altri e modificarli.
          </span>
        </div>


        <div class="relative overflow-x-auto">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col">
                  Visibile all'utente
                </th>
                <th scope="col" class="px-6 py-3">
                  immagine
                </th>
                <th scope="col" class="px-6 py-3">
                  nome
                </th>
                <th scope="col" class="px-6 py-3">
                  Categoria
                </th>
                <th scope="col" class="px-6 py-3">
                  Prezzo
                </th>
                <th scope="col" class="px-6 py-3">
                  Azioni
                </th>
              </tr>
            </thead>
            <tbody>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="dish in dishes">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  <label :for="'visible-' + dish.id"></label>
                  <input @click="toggleVisibility(dish)" v-model="dish.visible" type="checkbox" name="visible"
                    id="'visible-' + dish.id">
                </th>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  <img class="w-20 mx-auto" :src="`/storage/${dish.image}`" alt="img">
                </th>
                <td class="px-6 py-4">
                  {{ dish.name }}
                </td>
                <td class="px-6 py-4">
                  {{ dish.category }}
                </td>
                <td class="px-6 py-4">
                  €{{ dish.price }}
                </td>
                <td class="px-6 py-4">
                  <div classs="flex">
                    <!-- <button class="bg-yellow-300 flex p-2 rounded-lg m-2 text-black font-bold"
                      @click="redirectToEdit(dish.id)">Modifiche</button> -->
                      <Link class="bg-yellow-300 flex p-2 rounded-lg m-2 text-black font-bold" :href="route('dishes.edit', { dish: dish.id })">Modifiche</Link>
                    <button class="bg-red-500 p-2 rounded-lg m-2 text-white font-bold"
                      @click.prevent="destroy(dish.id)">Elimina</button>
                      <!-- <Link class="bg-red-300 flex p-2 rounded-lg m-2 text-black font-bold" :href="route('dishes.destroy', { dish: dish.id })">Modifiche</Link> -->

                  </div>
                </td>
              </tr>

            </tbody>
          </table>
        </div>

        <!-- <div class="flex gap-y-2 bg-red-400 min-h-60 p-4 rounded-lg w-80" v-for="dish in dishes">
          <h4>Nome piatto: {{ dish.name }}</h4>
          <img class="w-4/5 mx-auto" :src="`/storage/${dish.image}`" alt="Immagine del piatto">
          <p>{{ dish.description }}</p>
          <span>Prezzo: €{{ dish.price }}</span>
          <span>Stile cucina: {{ dish.category }}</span>
        </div> -->
      </div>
      <Link
        class="bg-green-500 hover:bg-green-800 p-3 text-white font-bold border rounded-lg mt-5 fixed bottom-100 left-1/2 transform -translate-x-1/2"
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
import { Head } from '@inertiajs/inertia-vue3';


defineProps({
  restaurant: Object,
  dishes: Array
});


const toggleVisibility = async (dish) => {
  dish.visible = !dish.visible;
};

</script>

<style>
/* Stili opzionali */
</style>
