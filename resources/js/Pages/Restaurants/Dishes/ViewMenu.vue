<template>
    <AuthenticatedLayout>
        <Link class="bg-green-700 p-3 text-white font-bold border rounded-lg"
            :href="route('dishes.create', { restaurant: selectedRestaurant?.id })">
            Crea Menu
        </Link>
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
    restaurants: {
        type: Array,
        default: () => [] 
    }
});


const selectedRestaurant = ref(null);


if (restaurants && restaurants.length > 0) {
    selectedRestaurant.value = restaurants[0];
}
</script>

<style>

</style>

