<template>

    <Head>
        <title>{{ restaurant.name }}</title>
    </Head>

    <GuestLayout>

        <div :style="restaurant.image ? { backgroundImage: 'url(/storage/' + restaurant.image + ')' } : { backgroundColor: '#FFA500' }"
            class="imgBackground flex justify-center gap-4 pt-8 sm:p-0">
            <h2 class="text-center text-white">Menu</h2>
            <h2 class="text-center text-white capitalize pb-3">{{ restaurant.name }}</h2>
        </div>

        <!-- Section Resturant/Menu -->
        <section class="p-2 mt-3 flex flex-wrap sm:pt-4 pb-32 sm:w-full sm:p-5 sm:flex sm:flex-nowrap sm:gap-5 sm:justify-center">

            <!-- card piatto resposive -->
            <div class="w-full sm:w-2/3 xl:w-2/3 sm:overflow-y-scroll sm:overflow-x-hidden">
                <h4 class="mb-6">Menu</h4>
                <ul class="flex justify-start flex-wrap gap-4 w-full sm:gap-3 sm:justify-center">

                    <li v-for="dish in restaurant.dishes" :key="dish.id" class="w-full sm:w-60  ">

                        <div class="bg-white rounded-lg shadow pe-2 relative sm:pe-0 sm:mt-4">

                            <div class=" h-auto w-full flex justify-between sm:flex sm:flex-col sm:text-center">
                                <div class="flex gap-2 w-4/5 sm:flex sm:flex-col sm:w-full">
                                    <img class="h-20 w-20 sm:h-60 sm:w-60 object-cover rounded-s-lg sm:rounded-t-lg sm:rounded-b-none"
                                        :src="'/storage/' + dish.image" alt="Dish Image" v-if="dish.image">

                                    <div class="flex flex-col">
                                        <h3 class=" capitalize font-bold pt-1">{{ dish.name }}</h3>
                                        <div class="">
                                            <p class=" capitalize pt-1 text-xs">{{ dish.description }}</p>
                                        </div>

                                    </div>

                                </div>
                                <div class="flex flex-col gap-2 relative w-1/5 sm:w-full pb-6">
                                    <p class=" capitalize font-bold ">{{ dish.price }}€</p>
                                </div>
                            </div>

                            <div class="bottom-0 pb-2  absolute left-[80%]  sm:bottom-[-8%] sm:left-[41%]">
                                <Link :href="`/add-to-cart/${dish.id}`"
                                    class="bg-orange-light add-to-cart rounded-full w-10 p-3  flex justify-center">
                                <img src="../../../public/img/add_cart.svg" alt="">
                                </Link>
                            </div>

                        </div>
                    </li>
                </ul>
            </div>


            <!-- card piatto lapTop -->
            <div class="hidden  w-full lg:w-1/2 xl:w-2/3">
                <h4 class="mb-6">Menu</h4>
                <ul class="flex justify-start flex-wrap gap-9 w-full sm:gap-3">

                    <li v-for="dish in restaurant.dishes" :key="dish.id" class="w-full ">

                        <div class="text-center bg-white rounded-lg shadow p-2 pb-5">
                            <div class="relative h-auto w-full flex">
                                <div class="aspect-square sm:h-full sm:w-full object-cover">
                                    <img class="h-20 w-20 sm:h-60 sm:w-60 object-cover rounded-lg"
                                        :src="'/storage/' + dish.image" alt="Dish Image" v-if="dish.image">
                                </div>
                                <div class="mt-4 flex flex-col gap-2 ">
                                    <h3 class=" capitalize font-bold">{{ dish.name }}</h3>
                                    <p class=" capitalize">{{ dish.description }}</p>
                                    <p class=" capitalize font-bold">Price: {{ dish.price }}€</p>
                                </div>
                                <Link :href="`/add-to-cart/${dish.id}`"
                                    class="bg-orange-light add-to-cart absolute rounded-full w-10 p-3 left-[40%] flex justify-center">
                                <img src="../../../public/img/add_cart.svg" alt="">
                                </Link>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Cart -->
            <div id="cart" class="w-full xl:w-1/3 sm:w-96 mt-5 sm:mt-0">
                <h4 class="mb-6">Carrello</h4>
                <div class="shadow border rounded-lg w-full">
                    <ul class="w-full flex flex-col items-center py-6">
                        <li class="flex w-full ">
                            <button class="mx-3">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                    <path d="M200-440v-80h560v80H200Z" />
                                </svg>
                            </button>
                            <div class="flex flex-wrap items-center w-full justify-between">
                                <div>
                                    <p class="w-3/5">Lasagna</p>
                                </div>
                                <div>
                                    <span class="w-1/5">13.50€</span>
                                </div>
                                <div class="flex">
                                    <p>Qty:
                                        <span>1</span>
                                    </p>
                                </div>

                            </div>
                            <button class="mx-3">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                    <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                                </svg>
                            </button>
                        </li>
                        <div class="pe-4 ps-4 w-full">
                            <hr class="p-2 mt-3">
                        </div>
                    </ul>

                    <div class="flex flex-col p-4">
                        <div class="flex justify-between items-center">
                            <h4>Totale</h4>
                            <span>13.50€</span>
                        </div>

                        <div class="flex justify-center mt-5">
                            <button class="bg-orange-500 text-white p-2 rounded-lg">Procedi con l'ordine</button>
                        </div>
                    </div>
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
</style>
