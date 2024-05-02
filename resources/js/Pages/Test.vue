<script setup>
import { defineProps } from 'vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { ref, watch, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    saluto: {
        type: String,
    },
    restaurants: {
        type: Array, // Assumendo che restaurants sia un array di oggetti
        default: () => [], // Un valore predefinito per restaurants, nel caso non venga passato dal genitore
    },
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
    // let response = Inertia.get('/restaurants', { filterByType: filterByType.value }, {
    //     preserveState: true,
    //     onSuccess: (page) => {
    //         // Aggiorna solo i dati dei ristoranti senza ricaricare la pagina
    //         // restaurants.value = page.props.restaurants;
    //         console.log(page)
 
    //     }
    // });
    fetchRestaurants();
}

const fetchRestaurants = async () => {
  try {
    const response = await fetch('/restaurants');
    if (!response.ok) {
      throw new Error('Failed to fetch restaurants');
    }
    const data = await response.json();
    console.log(data);
    restaurants.value = data;
  } catch (error) {
    console.error('Error fetching restaurants:', error);
  }
}

</script>

<template>
    <div>
        <h1>{{ saluto }}</h1>
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
        <ul>
            <li v-for="(restaurant, index) in restaurants" :key="index">
                <!-- Mostra le informazioni del ristorante -->
               <h1>{{ restaurant.name }}</h1>
            </li>
        </ul>
    </div>
</template>

<style scoped>
/* Stili del tuo componente Test */
</style>

