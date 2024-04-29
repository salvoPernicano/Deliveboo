<template>
    <GuestLayout>
        <h2 class="text-center">Menu</h2>
        <h1 class="text-center">{{ restaurant.name }}</h1>
        <main class="w-4/5 mx-auto">
        <ul class="flex justify-center items-center flex-wrap gap-2">
          <li v-for="dish in restaurant.dishes" :key="dish.id">
            <div class="text-center bg-gray-500">
                <figure class="h-20 w-36">
                    <img class="h-full w-full object-cover" :src="'/storage/' + dish.image" alt="Dish Image" v-if="dish.image">

                </figure>
                <h3>{{ dish.name }}</h3>
                <p>{{ dish.description }}</p>
                <p>Price: {{ dish.price }}</p>

            </div>
          </li>
        </ul>
    </main>
    </GuestLayout>
  </template>
  
  <script setup>
  import GuestLayout from '@/Layouts/GuestLayout.vue';
  import { Head } from '@inertiajs/inertia-vue3';
  
  const props = defineProps({
    restaurant: {
      type: Object,
      required: true
    }
  });
  

  </script>
  
  <style>
    main {
        min-height: calc(100vh - 100px);
        overflow: auto;
    }
</style>