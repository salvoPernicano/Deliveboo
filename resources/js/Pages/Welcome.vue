<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head} from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/vue3';
import { ref, watch, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { toRaw } from 'vue';
import axios from 'axios';


const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    restaurants: {
        type: Object,
    }
});

let filterByType = ref([]);
let editableProps = ref(props.restaurants);

const handleSearch = (typology) => {
    const index = filterByType.value.indexOf(typology);
    if (index === -1) {
        filterByType.value.push(typology);
    } else {
        filterByType.value.splice(index, 1);
    }
}
const fetchRestaurants = async () => {
    try {
        const string = Object.values(filterByType.value).join(',');
        const filter = 'filterByType=' + string;
        const response = await fetch('/restaurants?' + filter);
        if (!response.ok) {
            throw new Error('Failed to fetch restaurants');
        }
        const filteredRestaurants = await response.json();
        let usableData = toRaw(filteredRestaurants);
        console.log(usableData);
        editableProps.value = usableData;
    } catch (error) {
        console.error('Error fetching restaurants:', error);
    }
}

const searchByCategory = async () => {
    await fetchRestaurants();
}


</script>

<template>

    <Head title="Home" />
    <GuestLayout>
        <main class="w-full">
            <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end z-30">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="font-semibold text-white hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Dashboard</Link>

                <template v-else>
                    <Link :href="route('login')"
                        class="font-semibold text-white hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    Log in</Link>

                    <Link v-if="canRegister" :href="route('register')"
                        class="ms-4 font-semibold text-white hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 btn-orange py-2 px-2 rounded-2xl">
                    Register</Link>
                </template>
            </div>

            <!-- HERO section -->
            <section class="hero w-full bg-cover bg-center bg-no-repeat flex justify-center items-center">
                <div class="flex justify-center items-center bg-[#FF6900] w-full bg-opacity-20">
                    <div class="my-60 columns-sm flex flex-col justify-center items-center w-full">
                        <h1 class="text-white text-center">I tuoi piatti preferiti,<br>
                            direttamente a casa tua.</h1>

                        <div id="search-bar" class="flex items-center">
                            <a href="#search" class="btn btn-orange py-3">Cerca</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- TYPOLOGIES section -->
            <section id="search" class="flex flex-col items-center my-24">
                <h2
                    class="text-center w-fit bg-gradient-to-r from-orange-500 to-amber-500 text-transparent bg-clip-text">
                    Di cosa hai voglia oggi?</h2>

                <!-- typologies component here -->
                <div id="piillsContainer" class="p-3 flex flex-wrap justify-center items-center gap-3">
                    <a :class="{ 'bg-gradient text-white': filterByType.includes(1) }"
                        class="border border-gray-200 rounded-lg px-3 py-2" href="#"
                        @click.prevent="handleSearch(1)">Giapponese</a>
                    <a :class="{ 'bg-gradient text-white': filterByType.includes(2) }"
                        class="border border-gray-200 rounded-lg px-3 py-2" href="#"
                        @click.prevent="handleSearch(2)">Italiana</a>
                    <a :class="{ 'bg-gradient text-white': filterByType.includes(3) }"
                        class="border border-gray-200 rounded-lg px-3 py-2" href="#"
                        @click.prevent="handleSearch(3)">Cinese</a>
                    <a :class="{ 'bg-gradient text-white': filterByType.includes(4) }"
                        class="border border-gray-200 rounded-lg px-3 py-2" href="#"
                        @click.prevent="handleSearch(4)">Messicano</a>
                    <a :class="{ 'bg-gradient text-white': filterByType.includes(5) }"
                        class="border border-gray-200 rounded-lg px-3 py-2" href="#"
                        @click.prevent="handleSearch(5)">Indiano</a>
                    <button class="bg-orange-dark px-3 py-2 rounded-lg text-white" @click="searchByCategory">Applica filtri</button>
                </div>

                <!-- restaurants cards -->
                <div class="flex flex-wrap justify-center gap-4 w-full">
                    <div class="shadow rounded-xl flex flex-col justify-between w-full mx-4 sm:w-48 sm:mx-0" v-for="restaurant in editableProps"
                        :key="restaurant.id">
                        <a :href="route('restaurants.show', { restaurant: restaurant.slug })">
                            <div :style="restaurant.image ? { backgroundImage: 'url(/storage/' + restaurant.image + ')' } : { backgroundColor: '#FFA500' }" class="h-24 w-full rounded-t-lg bg-cover bg-center"></div>
                            <div class="  sm:w-48 p-2 h-full">
                                <p class="font-bold">{{ restaurant.name }}</p>
                                <ul class="flex flex-wrap gap-1 text-sm text-color">
                                    <li v-for="item in restaurant.typology">{{ item.typology_name }}</li>
                                </ul>
                                <p class="text-sm">{{ restaurant.address }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </section>



            <!-- STEPS section -->

            <section class="flex flex-col items-center my-24 w-3/4 mx-auto">
                <h2
                    class="text-center w-fit bg-gradient-to-r from-orange-500 to-amber-500 text-transparent bg-clip-text">
                    Gli step
                    per farti passare la fame</h2>

                <div id="steps" class="flex flex-wrap sm:flex-nowrap mt-16 w-full">
                    <div class="step w-full sm:w-1/3">
                        <h4 class="text-center">1 - Scegli il ristorante</h4>
                        <figure>
                            <img src="../../../public/img/step-1.png" alt="">
                        </figure>
                    </div>
                    <div class="step w-full sm:w-1/3">
                        <h4 class="text-center">2 - Riempi il carrello</h4>
                        <figure>
                            <img src="../../../public/img/step-2.png" alt="">
                        </figure>
                    </div>
                    <div class="step w-full sm:w-1/3">
                        <h4 class="text-center">3 - Paga in modo sicuro</h4>
                        <figure>
                            <img src="../../../public/img/step-3.png" alt="">
                        </figure>
                    </div>
                </div>
            </section>
        </main>
    </GuestLayout>
</template>

<style scoped>
.hero {
    background-image: url('/public/img/hero-burger.webp');
}

#search-bar {
    margin-top: 3rem;
}

#search-bar input {
    border-radius: 50px;
    border: none;
}

#steps {
    gap: 5rem;
}

/* .step {
    flex-basis: calc((100% / 3) - (5rem / 3));
    aspect-ratio: 1;
} */

.step figure {
    width: 100%;
    aspect-ratio: 1;
}

.step figure img {
    width: 100%;
}
</style>
