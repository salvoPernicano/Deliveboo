<template>
    <GuestLayout>
        <div class="bg-[#FFA500] flex justify-center gap-4 pt-20 pb-10">
            <h2 class="text-center text-white">Carrello</h2>
        </div>
        <section class="h-screen">
            <div id="cart" class="w-full mt-10">
                <div class="shadow border rounded-lg w-4/5 mx-auto text-center py-4">
                    <ul class="w-full flex flex-col items-center justify-center py-6">
                        <li v-for="item in cartList" :key="item.id" class="p-4 flex items-center justify-center w-full">
                            <Link :href="`/remove-from-cart/${item.id}`" class="rounded-lg bg-yellow-500">
                                Remove Dish
                            </Link>
                            <button @click="decreaseQuantity(item.id)" class="mx-4">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                    <path d="M200-440v-80h560v80H200Z" />
                                </svg>
                            </button>
                            <div class="flex items-center w-full">
                                <img :src="'storage/' + item.image" alt="product_image" class="w-18 h-20">
                                <p class="w-3/5">{{ item.name }}</p>
                                <div>
                                    <span class="w-1/5">€{{ item.price }}</span>
                                    <input type="number" :name="`quantity-${item.id}`" :id="`quantity-${item.id}`"
                                        :value="item.quantity" @input="updateQuantity(item.id, $event.target.value)" class="text-black">
                                </div>
                            </div>
                            <button @click="increaseQuantity(item.id)" class="mx-4 ">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                    <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                                </svg>
                            </button>
                            <button @click="updateQty(item.id)" class="bg-green-600 rounded-lg mx-4">Confirm
                                quantity</button>
                        </li>
                    </ul>
                    <div class="flex justify-between px-20 font-bold">
                        <span>Totale:</span>
                        <span>€{{ total }}</span>
                    </div>
                </div>
                <div class="w-4/5 mx-auto mt-8 flex justify-between">
                    <button @click="checkout" class="btn btn-orange text-white px-4 py-2 rounded-md">Ordina e
                        paga</button>
                </div>
            </div>
            <div class="w-4/5 mx-auto bg-pink-300 p-2 text-center" id="dropin-wrapper">
                <div id="checkout-message"></div>
                <div id="dropin-container"></div>
                <button @click="submitPayment" class="bg-red-500 rounded-lg p-2" id="submit-button">Submit payment</button>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { defineProps, toRaw, onMounted } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import * as DropIn from 'braintree-web-drop-in';

const props = defineProps({
    cartList: {
        type: Object,
        required: false
    }
});

let total = 0;
let cartListtoRaw = toRaw(props.cartList);
const keys = Object.keys(cartListtoRaw);

keys.forEach(key => {
    let cart = cartListtoRaw[key];
    total += parseFloat(cart.price) * cart.quantity;
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

const updateQuantity = (productId, value) => {
    value = parseInt(value, 10);
    value = isNaN(value) ? 1 : value;
    value = value < 1 ? 1 : value;
    let input = document.getElementById(`quantity-${productId}`);
    input.value = value;
};

const updateQty = (productId) => {
    let input = document.getElementById(`quantity-${productId}`);
    let value = parseInt(input.value);
    Inertia.post('/change-cart-quantity', { product_id: productId, quantity: value });
}

let instance = null;

onMounted(() => {
    DropIn.create({
        authorization: 'sandbox_x6qjzvjf_44sxcnc6mrqrspwc',
        container: '#dropin-container'
    }, (createErr, dropinInstance) => {
        if (createErr) {
            console.error('Error creating Drop-in instance:', createErr);
            return;
        }
        instance = dropinInstance;
    });
});

const submitPayment = () => {
    if (!instance) {
        console.error('Drop-in instance not initialized properly.');
        return;
    }
    instance.requestPaymentMethod((requestPaymentMethodErr, payload) => {
        if (requestPaymentMethodErr) {
            console.error('Error requesting payment method:', requestPaymentMethodErr);
            return;
        }
        Inertia.post('/process_payment', { 'paymentMethodNonce': payload.nonce }).then((result) => {
            instance.teardown((teardownErr) => {
                if (teardownErr) {
                    console.error('Unable to teardown Drop-in UI:', teardownErr);
                    return;
                }
                console.info('Drop-in UI successfully torn down!');
                $('#submit-button').remove();
            });

            if (result.success) {
                $('#checkout-message').html('<h1>Success</h1><p>Your Drop-in UI is working properly! Check your <a href="https://sandbox.braintreegateway.com/login">sandbox Control Panel</a> for your test transactions.</p><p>Refresh to try another transaction.</p>');
            } else {
                console.log(result);
                $('#checkout-message').html('<h1>Error</h1><p>Check your console.</p>');
            }
        });
    });
};
</script>

<style></style>
