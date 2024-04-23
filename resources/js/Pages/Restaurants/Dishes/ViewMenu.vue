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
        default: () => [] // Default to an empty array if not provided
    }
});

// Defining a reactive reference for selectedRestaurant
const selectedRestaurant = ref(null);

// Assuming you want to set the first restaurant as the selectedRestaurant by default
if (restaurants && restaurants.length > 0) {
    selectedRestaurant.value = restaurants[0];
}
</script>

<style>

</style>

