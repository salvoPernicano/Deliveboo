<script setup>
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

let props = defineProps({
  restaurant: Object,
  errors: Object,
  dish: Object
});

const editPlate = useForm({
  id : props.dish.id,
  restaurant_id: props.restaurant.id,
  name: props.dish.name,
  description: props.dish.description,
  price: props.dish.price,
  visible: true,
  category: props.dish.category,
  image: null
});

const categories = ['Giapponese', 'Italiana', 'Cinese', 'Messicano', 'Indiana'];

function submit(dishId) {
  const formData = {
    _method: 'put', // Utilizza form method spoofing per indicare al server di gestire la richiesta come PUT
    name: editPlate.name,
    description: editPlate.description,
    price: editPlate.price,
    visible: editPlate.visible,
    category: editPlate.category,
    image: editPlate.image
  };

  router.post(`/restaurant/${props.restaurant.id}/dishes/${dishId}`, formData);
}
  

function handleImageChange(event) {
  editPlate.image = event.target.files[0];

}


</script>

<style>
/* Stili opzionali */
</style>
<template>
  <Head title="Crea piatto"></Head>
    <AuthenticatedLayout>
        <!-- <Head title="Create new Plate" /> -->

      <div class="flex flex-col gap-9 justify-center items-center">
        <h1 class="text-black text-5xl font-bold">Modifica piatto</h1>

        <form class="flex flex-col text-black text-lg text-center gap-7 m-10"  @submit.prevent="submit(dish.id)" enctype="multipart/form-data">
          <div class="flex flex-col">
            <label for="">Inserisci nome</label>
            <input class="text-black" type="text" name="name" v-model="editPlate.name">
            <div v-if="errors.name"><span class="text-red-700">{{ errors.name }}</span></div>
          </div>

          <div class="flex flex-col">
            <label for="">Inserisci descrizione</label>
            <textarea class="text-black" name="description" cols="30" rows="5" v-model="editPlate.description"></textarea>
            <div v-if="errors.description"><span class="text-red-700">{{ errors.description }}</span></div>
          </div>

          <div class="flex flex-col">
            <label for="">Prezzo</label>
            <input class="text-black" type="number" step="0.01" name="price" v-model="editPlate.price">
            <div v-if="errors.price"><span class="text-red-700">{{ errors.price }}</span></div>
          </div>

          <div class="flex flex-col">
            <label for="">Visibilità</label>
            <input class="text-black" type="checkbox" name="visible" v-model="editPlate.visible">
          </div>

          <div class="flex flex-col">
            <label for="">Categoria</label>
            <select class="text-black" name="category" v-model="editPlate.category">
              <option v-for="category in categories" :value="category">{{ category }}</option>
            </select>
            <div v-if="errors.category"><span class="text-red-700">{{ errors.category }}</span></div>
          </div>

          <div class="flex flex-col">
            <label for="">Selezionare un'immagine</label>
            <input type="file" name="image" accept="image/*" @change="handleImageChange">
            <div class="mx-auto text-center">
              <span>Vecchia Foto:</span>
              <img class="w-40 mx-auto m-4" :src="`/storage/${dish.image}`" alt="img">

            </div>
            <div v-if="errors.image"><span class="text-red-700">{{ errors.image }}</span></div>
          </div>
          <h2>{{ restaurant.name }}</h2>
          <button type="submit" class="bg-white hover:bg-black hover:text-white text-black font-bold py-2 px-4 rounded-full uppercase">Salva piatto</button>
        </form>
      </div>
    </AuthenticatedLayout>
  </template>

 
