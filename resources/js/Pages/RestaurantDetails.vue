<template>

    <Head>
        <title>{{ restaurant.name }}</title>
    </Head>
    
    <GuestLayout>

        <div :style="restaurant.imagePath ? { backgroundImage: 'url(' + '/storage/' + restaurant.imagePath + ')' } : { backgroundColor: '#FFA500' }"
            class="imgBackground flex justify-center gap-4 pt-8 sm:p-0">
            <h2 class="text-center text-white">Menu</h2>
            <h2 class="text-center text-white capitalize pb-16">{{ restaurant.name }}</h2>
        </div>

        <!-- Section Resturant/Menu -->
        <section class="w-4/5 mx-auto mt-3 flex flex-wrap pt-16 pb-32 ">

            <div class="w-full lg:w-1/2 xl:w-2/3">
                <h4 class="mb-6">Menu</h4>
                <ul class="flex justify-start flex-wrap gap-9 w-full sm:gap-3">
    
                    <li v-for="dish in restaurant.dishes" :key="dish.id" class="w-full ">
    
                        <div class="text-center bg-white rounded-lg shadow p-2 pb-5">
                            <div class="relative h-auto w-full flex">
                                <div class="aspect-square sm:h-full sm:w-full object-cover">
                                    <img class="h-20 w-20 sm:h-60 sm:w-60 object-cover rounded-lg" :src="'/storage/' + dish.image"
                                        alt="Dish Image" v-if="dish.image">
                                </div>
                                <div class="mt-4 flex flex-col gap-2 ">
                                    <h3 class=" capitalize font-bold">{{ dish.name }}</h3>
                                    <p class=" capitalize">{{ dish.description }}</p>
                                    <p class=" capitalize font-bold">Price: {{ dish.price }}€</p>
                                </div>
                                <Link :href="`/add-to-cart/${dish.id}`" class="bg-orange-light add-to-cart absolute rounded-full w-10 p-3 left-[40%] flex justify-center">
                                  <img src="../../../public/img/add_cart.svg" alt="">
                                </Link>
    
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Cart -->
            <div id="cart" class="w-full lg:w-1/2 xl:w-1/3">
                <h4 class="mb-6">Carrello</h4>
                <div class="shadow border rounded-lg w-full">
                    <ul class="w-full flex flex-col items-center py-6">
                        <li class="my-4 mx-4 flex w-full">
                            <button class="mx-4">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-440v-80h560v80H200Z"/></svg>
                            </button>
                            <div class="flex flex-wrap items-center w-full">
                                <p class="w-3/5">Lasagna</p>
                                <span class="w-1/5">13.50€</span>
                                <p class="w-1/5">Qty: 
                                    <span>1</span>
                                </p>
                                <hr class="mt-4 w-full">
                            </div>
                            <button class="mx-4">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    restaurant: {
        type: Object,
        required: true
    }
});


</script>

<style scoped>

.imgBackground {
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    margin-top: 0px;
    padding-top: 80px;
}

.add-to-cart {

}
</style>
