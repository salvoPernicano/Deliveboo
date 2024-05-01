<template>
    <GuestLayout>
        <section class="bg-orange-400 text-white text-lg font-semibold">
        <div id="cart" class="min-h-screen w-full mt-24">
            <h4 class="mb-6 text-center">Carrello</h4>
            <div class="shadow border rounded-lg w-4/5 mx-auto text-center">
                <ul class="w-full flex flex-col items-center justify-center py-6">
                    <li v-for="item in cartList" :key="item.id" class="p-4 flex items-center justify-center w-full">
                        <Link :href="`/remove-from-cart/${item.id}`" class="rounded-lg bg-yellow-500">
                            Remove Dish
                        </Link>
                        <button @click="decreaseQuantity(item.id)" class="mx-4">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-440v-80h560v80H200Z"/></svg>
                        </button>
                        <div class="flex items-center w-full">
                            <img :src="'storage/'+item.image" alt="product_image" class="w-18 h-20">
                            <p class="w-3/5">{{ item.name }}</p>
                            <div>
                                <span class="w-1/5">price per unit €{{ item.price }}</span>
                               <input type="text" :name="`quantity-${item.id}`" :id="`quantity-${item.id}`" :value="item.quantity" @change="" class="text-black">

                            </div>
                        </div>
                        <button @click="increaseQuantity(item.id)" class="mx-4 ">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                        </button>
                        <button class="bg-green-600 rounded-lg" @click="updateQty(item.id)">Confirm quantity</button>
                    </li>
                </ul>
                <div>
                    <span>Total price : €{{ total }} </span>
                   
                </div>
            </div>
            <div class="w-4/5 mx-auto mt-8 flex justify-between">
                <div class="w-4/5 mx-auto mt-8 flex justify-between">
                <button @click="checkout" class="bg-green-500 text-white px-4 py-2 rounded-md">Ordina e paga</button>
                </div>
        </div>
        </div>
    </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { defineProps, toRaw } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    cartList: {
        type: Object,
        required: false
    }
});

let total = 0;
let cartListtoRaw = toRaw(props.cartList)
const keys = Object.keys(cartListtoRaw);

keys.forEach(key => {
    let cart = cartListtoRaw[key];
    total += parseFloat(cart.price) * cart.quantity
    console.log(total)
});



const decreaseQuantity = (productId) => {
    let input = document.getElementById(`quantity-${productId}`);
    let value = parseInt(input.value, 10);
    value = isNaN(value) ? 0 : value;
    value < 1 ? value = 1 : '';
    if (value > 1) {
        value--;
    }
    input.value = value;
};

const increaseQuantity = (productId) => {
    let input = document.getElementById(`quantity-${productId}`);
    let value = parseInt(input.value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    input.value = value;
};

const updateQty = (productId) => {

    let input = document.getElementById(`quantity-${productId}`);
    let value = parseInt(input.value);
    Inertia.post('/change-cart-quantity', { product_id: productId, quantity: value });
}


</script>

<style>

</style>
