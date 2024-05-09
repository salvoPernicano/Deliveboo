<template>
    <GuestLayout>
        <div class="bg-[#FFA500] flex justify-center gap-4 pt-20 pb-10">
            <h2 class="text-center text-white">Ristorante Trattoria Paradiso</h2>
        </div>
        <div id="riepilogo" class="flex flex-col justify-center shadow max-w-screen-md mx-auto text-center p-5  text-black  rounded-lg">
                <h4 class="text-2xl text-center text-[#FFA500]">Ordine effettuato con successo!</h4>
                <h3 class="my-2">Riepilogo ordine: </h3>
                <div class="flex justify-around">
                    <div>
                        <ul>
                            <li>Nome</li>
                            <li>Email</li>
                            <li>Telefono</li>
                            <li>Indirizzo</li>
                            <li>Citofono</li>
                        </ul>
                    </div>
                    <div>
                        <ul>
                            <li>{{ props.orderDetails.name }}</li>
                            <li>{{props.orderDetails.email  }}</li>
                            <li>{{ props.orderDetails.phone }}</li>
                            <li>{{ props.orderDetails.address }}</li>
                            <li>{{ props.orderDetails.name_doorbell }}</li>
                        </ul>
                        
                    </div>
                    
                </div>
                <ul class="mt-5">
                    <li v-for="item in cart">
                        <h3 class="text-lg font-semibold">{{ item.name }} x {{ item.quantity }}</h3>
                    </li>
                </ul>
                <span class="text-xl font-semibold">Totale ordine €{{ props.orderTotal }}</span>
            </div>
        
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';

import { defineProps } from 'vue';



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
#riepilogo{
    height: 400px;
    margin-block: 100px;
}
</style>