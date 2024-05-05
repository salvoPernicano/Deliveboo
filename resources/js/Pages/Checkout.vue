<template>
    <GuestLayout>
        <div class="bg-[#FFA500] h-screen gap-4 pt-20 pb-10">
            <h1 class="text-center text-green-500">Ordine effettuato con successo!</h1>
            <div>
                <h1>{{ props.orderDetails.name }}</h1>
                <h4>{{props.orderDetails.email  }}</h4>
                <h4>{{ props.orderDetails.phone }}</h4>
                <ul>
                    <li v-for="item in cart">
                        <h3>{{ item.name }}</h3>
                        <span>Totale ordine €{{ props.orderTotal }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';


const props = defineProps({
    orderDetails: {
        type: Object,
    },
    cart: {
        type: Object,
    },
    orderTotal: {
        type: String
    }
});
</script>

<style  scoped>

</style>