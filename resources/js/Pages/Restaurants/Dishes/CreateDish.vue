<template>
    <AuthenticatedLayout>
        <Head title="Create new Plate" />

      <div class="flex flex-col gap-9 justify-center items-center">
        <h1 class="text-black text-5xl font-bold">Crea un nuovo piatto</h1>

        <form class="flex flex-col text-black text-lg text-center gap-7"  @submit.prevent="submit(restaurant.id)" enctype="multipart/form-data">
          <div class="flex flex-col">
            <label for="">Inserisci nome</label>
            <input class="text-black" type="text" name="name" v-model="newPlate.name">
            <div v-if="errors.name"><span class="text-red-700">{{ errors.name }}</span></div>
          </div>

          <div class="flex flex-col">
            <label for="">Inserisci descrizione</label>
            <textarea class="text-black" name="description" cols="30" rows="10" v-model="newPlate.description"></textarea>
            <div v-if="errors.description"><span class="text-red-700">{{ errors.description }}</span></div>
          </div>

          <div class="flex flex-col">
            <label for="">Prezzo</label>
            <input class="text-black" type="number" step="0.01" name="price" v-model="newPlate.price">
            <div v-if="errors.price"><span class="text-red-700">{{ errors.price }}</span></div>
          </div>

          <div class="flex flex-col">
            <label for="">Visibilità</label>
            <input class="text-black" type="checkbox" name="visible" v-model="newPlate.visible">
          </div>

          <div class="flex flex-col">
            <label for="">Categoria</label>
            <select class="text-black" name="category" v-model="newPlate.category">
              <option v-for="category in categories" :value="category">{{ category }}</option>
            </select>
            <div v-if="errors.category"><span class="text-red-700">{{ errors.category }}</span></div>
          </div>

          <div class="flex flex-col">
            <label for="">Carica immagine</label>
            <input type="file" name="image" accept="image/*" @change="handleImageChange">
            <div v-if="errors.image"><span class="text-red-700">{{ errors.image }}</span></div>
          </div>
          <h2>{{ restaurant.name }}</h2>
          <button type="submit" class="bg-blue-950 hover:bg-black hover:text-white text-black font-bold py-2 px-4 rounded-full uppercase">Salva piatto</button>
        </form>
      </div>
    </AuthenticatedLayout>
  </template>

  <script setup>
  import { defineProps } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { useForm } from '@inertiajs/vue3';
  import { router } from '@inertiajs/vue3';
  import { Head } from '@inertiajs/vue3';


  let props = defineProps({
    restaurant: Object,
    errors: Object
  });

  const newPlate = useForm({
    restaurant_id: props.restaurant.id,
    name: null,
    description: null,
    price: null,
    visible: true,
    category: null,
    image: null
  });



  const categories = ['Giapponese', 'Italiana', 'Cinese', 'Messicano', 'Indiana'];

  function submit(restaurantId) {
    console.log(newPlate);
  router.post(`/restaurant/${restaurantId}/dishes`,newPlate);
}

    ;

  function handleImageChange(event) {
    const file = event.target.files[0];
    newPlate.image = file;
  }
  </script>

  <style>
  /* Stili opzionali */
  </style>
