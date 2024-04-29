<template>
    <GuestLayout>
        <h1 class="text-center">Benvenuti al nostro sito!</h1>
       <section class="flex justify-center items-center gap-4 bg-red-200">
           <div class="border border-black bg-gray-400 p-2 h-48 w-48" v-for="restaurant in restaurants" :key="restaurant.id">
             <h2>{{ restaurant.name }}</h2>
             <p>{{ restaurant.description }}</p>
             <!-- Aggiungi ulteriori dettagli del ristorante qui -->
           </div>

       </section>
  
    </GuestLayout>

  </template>
  
<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';


const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    restaurants: {
        type : Array,
    }
});
</script>
  