<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const newRestauant = useForm({
    name: null,
    address: null,
    p_iva: null,
    image: null,
    description: null,
});


</script>

<template>
       
  <h1>TEST PUSH AND PULL</h1>

</template>



<style></style>