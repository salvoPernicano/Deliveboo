<template>
    <GuestLayout>
        <h1 class="text-center">Cosa vuoi mangiare oggi?</h1>
        <div class="bg-orange-300 p-3 text-center flex justify-center items-center">
            <input class="h-9 rounded-lg" type="search">
            <button class="bg-orange-500 px-3 rounded-lg h-9">Cerca</button>
        </div>
        <div id="piillsContainer" class="p-3 flex justify-center items-center gap-3">
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

        <section class="flex justify-center items-center gap-4 bg-red-200">
            <!-- ristoranti mostrati random -->
            <div class="border border-black bg-gray-400 p-2 h-48 w-48" v-for="restaurant in restaurants.data"
                :key="restaurant.id">
                <h2>{{ restaurant.name }}</h2>
                <p>{{ restaurant.description }}</p>
                <div>
                    <ul>
                        <li v-for="item in restaurant.typology">{{ item.typology_name }}</li>
                    </ul>
                </div>
                <Link :href="route('restaurants.show', { restaurant: restaurant.id })">Dettagli e Menu</Link>
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
