<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3'; 
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({ errors:Object,restaurant:Object,typologies: Array });

const editRestaurant = useForm({
     name: props.restaurant.name,
     address: props.restaurant.address,
     p_iva: props.restaurant.p_iva,
     image: props.restaurant.image,
     description: props.restaurant.description,
     user_id : props.restaurant.user_id,
     selectedTypologies : props.restaurant.selectedTypologies
 });

 function submit(id){
  router.put(`/restaurant/${props.restaurant.id}`, editRestaurant);
 }

const handleImageChange = (event) => {
    newRestaurant.image = event.target.files[0];
};
</script>

<template>
    <AuthenticatedLayout>
      <div class="flex flex-col gap-9 justify-center items-center">
        <h1 class="text-black text-5xl font-bold">Modifica Ristorante</h1>
  
        <form class="flex flex-col text-black text-lg text-center gap-7" @submit.prevent="submit" enctype="multipart/form-data">
          <div class="flex flex-col">
            <label for="">Inserisci nome Ristorante</label>
            <input class="text-black" type="text" name="title" v-model="editRestaurant.name">
            <div v-if="errors.name"><span class="text-red-700">{{ errors.name }}</span></div>
          </div>
          
          <div class="flex flex-col">
            <label for="">Inserisci indirizzo</label>
            <input class="text-black" type="text" name="title" v-model="editRestaurant.address">
            <div v-if="errors.address"><span class="text-red-700">{{ errors.address }}</span></div>
          </div>
          
          <div class="flex flex-col">
            <label for="">Inserisci Partita Iva</label>
            <input class="text-black" type="text" name="title" v-model="editRestaurant.p_iva">
            <div v-if="errors.p_iva"><span class="text-red-700">{{ errors.p_iva }}</span></div>
          </div>
          
          <div class="flex flex-col">
            <label for="">Carica immagine</label>
            <input type="file" name="image" accept="image/*" @change="handleImageChange">
            <div v-if="errors.image"><span class="text-red-700">{{ errors.image }}</span></div>
          </div>
          
          <div class="flex flex-col">
            <label for="">Inserisci descrizione</label>
            <textarea class="text-black" name="description" cols="30" rows="10" v-model="editRestaurant.description"></textarea>
            <div v-if="errors.description"><span class="text-red-700">{{ errors.description }}</span></div>
          </div>
          
          <div class="flex flex-col">
            <label for="">Seleziona tipologie di cucina</label>
            <select v-model="editRestaurant.selectedTypologies" multiple>
              <option v-for="typology in typologies" :value="typology.id">{{ typology.typology_name }}</option>
            </select>
            <div v-if="errors.selectedTypologies"><span class="text-red-700">{{ errors.selectedTypologies }}</span></div>
          </div>
          
          <button type="submit" class="bg-blue-950 hover:bg-black hover:text-white text-black font-bold py-2 px-4 rounded-full uppercase">Salva modifiche</button>
        </form>
      </div>
    </AuthenticatedLayout>
  </template>