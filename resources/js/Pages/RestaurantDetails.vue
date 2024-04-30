<template>

    <Head title="Flat Details" />
    <GuestLayout>
        <div :style="restaurant.imagePath ? { backgroundImage: 'url(' + '/storage/' + restaurant.imagePath + ')' } : { backgroundColor: '#FFA500' }"
            class="imgBackground flex justify-center gap-4 pt-8 sm:p-0">
            <h2 class="text-center text-white">Menu</h2>
            <h2 class="text-center text-white capitalize">{{ restaurant.name }}</h2>
        </div>

        <!-- Main Resturant/Menu -->
        <main class="w-4/5 mx-auto mt-3">

            <ul class="flex justify-center  flex-wrap gap-9 h-screen w-full sm:gap-3">

                <li v-for="dish in restaurant.dishes"  :key="dish.id">

                    <div v-if="dish.visible !== 0" class="text-center  rounded-lg shadow p-2 pb-5">
                        <div class="relative h-auto ">
                            <div class="h-full w-full object-cover">
                                <img class="h-60 w-60 object-cover rounded-lg" :src="'/storage/' + dish.image"
                                    alt="Dish Image" v-if="dish.image">
                            </div>
                            <div class="mt-4 flex flex-col gap-2 ">
                                <h3 class=" capitalize font-bold">{{ dish.name }}</h3>
                                <p class=" capitalize">{{ dish.description }}</p>
                                <p class=" capitalize font-bold">Price: {{ dish.price }}$</p>
                            </div>
                            <div class="bg-orange-400 absolute rounded-full w-10 p-3 left-[40%] flex justify-center">
                              <button type="submit"> <img src="../../../public/img/add_cart.svg" alt=""></button>
                            </div>

                        </div>
                    </div>
                </li>
            </ul>
        </main>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

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

.imgBackground {
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    margin-top: 0px;

}

.shadow {
    box-shadow: 0px 0px 8.0px rgba(0, 0, 0, 0.25);

}
</style>
