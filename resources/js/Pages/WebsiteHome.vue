<template>
    <GuestLayout>

        <div class="bg-[#FF6900] p-3 text-center flex flex-col justify-center items-center">
            <div>
                <h1 class="text-center text-white mt-7 sm:mt-0">Cosa vuoi mangiare oggi?</h1>
            </div>
            <div class="flex flex-row gap-2 mt-4 ">
                <button class="bg-orange-700 rounded-full pe-3 text-white "> <input class="h-9 w-60 sm:w-96 rounded-full" type="search">Cerca</button>
            </div>

        </div>
        <div id="piillsContainer" class="p-3 flex flex-wrap justify-center items-center gap-3">
            <a :class="{ 'bg-orange-500': filterByType.includes(1) }" class="border border-gray-400 rounded-lg p-2"
                href="#" @click.prevent="handleSearch(1)">Giapponese</a>
            <a :class="{ 'bg-orange-500': filterByType.includes(2) }" class="border border-gray-400 rounded-lg p-2"
                href="#" @click.prevent="handleSearch(2)">Italiana</a>
            <a :class="{ 'bg-orange-500': filterByType.includes(3) }" class="border border-gray-400 rounded-lg p-2"
                href="#" @click.prevent="handleSearch(3)">Cinese</a>
            <a :class="{ 'bg-orange-500': filterByType.includes(4) }" class="border border-gray-400 rounded-lg p-2"
                href="#" @click.prevent="handleSearch(4)">Messicano</a>
            <a :class="{ 'bg-orange-500': filterByType.includes(5) }" class="border border-gray-400 rounded-lg p-2"
                href="#" @click.prevent="handleSearch(5)">Indiano</a>
            <button class="bg-orange-400 p-2 rounded-lg" @click="searchByCategory">Cerca per tipologia</button>
        </div>

        <section class="flex flex-wrap h-screen justify-center gap-4 ">
            <!-- ristoranti mostrati random -->
            <div class=" shadow rounded-xl p-2 h-48 flex flex-col justify-between"
                v-for="restaurant in restaurants.data" :key="restaurant.id">
                <div class="w-48">
                    <h4>{{ restaurant.name }}</h4>
                    <p>{{ restaurant.description }}</p>

                    <ul>
                        <li v-for="item in restaurant.typology">{{ item.typology_name }}</li>
                    </ul>
                </div>
                <div class=" flex ">
                    <Link class="bg-orange-400 text-white rounded-lg p-1"
                        :href="route('restaurants.show', { restaurant: restaurant.id })">Dettagli e Menu</Link>
                </div>

            </div>

        </section>

    </GuestLayout>

</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, watch, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';

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

const handleSearch = (typology) => {
    const index = filterByType.value.indexOf(typology);
    if (index === -1) {
        filterByType.value.push(typology);
    } else {
        filterByType.value.splice(index, 1);
    }
}

const searchByCategory = () => {
    Inertia.get('/Deliveboo', { filterByType: filterByType.value }, {
        preserveState: true
    });
}
</script>
<style>
.shadow {
    box-shadow: 0px 0px 8.0px rgba(0, 0, 0, 0.25);

}
</style>
