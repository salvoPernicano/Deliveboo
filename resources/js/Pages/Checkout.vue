<template>
    <GuestLayout>
        <div class="bg-[#FFA500] h-screen gap-4 pt-20 pb-10">
            <h1 class="text-center text-green-500">Ordine effettuato con successo!</h1>
            <div class="shadow w-80 mx-auto text-center p-5 mt-5 text-black bg-white rounded-lg">
                <h3>Riepilogo ordine: </h3>
                <h3 class="text-lg">{{ props.orderDetails.name }}</h3>
                <h3>{{props.orderDetails.email  }}</h3>
                <h3 class="text-lg">{{ props.orderDetails.phone }}</h3>
                <span class="text-xl font-semibold">Totale ordine €{{ props.orderTotal }}</span>
                <ul>
                    <li v-for="item in cart">
                        <h3 class="text-lg font-semibold">{{ item.name }} x {{ item.quantity }}</h3>
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
    },
});
</script>

<style  scoped>

</style>