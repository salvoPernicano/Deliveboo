<template>
    <GuestLayout>
        <div class="bg-[#FFA500] flex justify-center gap-4 pt-20 pb-10">
            <h2 class="text-center text-white">Carrello</h2>
        </div>
        <section>
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

                </div>

            </div>
            <div class="shadow border rounded-lg w-4/5 mx-auto text-center p-4 mt-6" id="dropin-wrapper">
                <div class="flex justify-center p-2 gap-2 font-bold text-xl">
                        <span>Totale:</span>
                        <span>€{{ total }}</span>
                    </div>
                    <div class="mb-4">
    <label for="name" class="block text-lg font-semibold mb-1">Nome<span class="text-red-500">*</span>:</label>
    <input type="text" id="name" v-model="order.name" class="w-full px-3 py-2 border rounded-lg" required>
</div>
<div class="mb-4">
    <label for="email" class="block text-lg font-semibold mb-1">Indirizzo email<span class="text-red-500">*</span>:</label>
    <input type="email" id="email" v-model="order.email" class="w-full px-3 py-2 border rounded-lg" required>
</div>
<div class="mb-4">
    <label for="phone" class="block text-lg font-semibold mb-1">Numero di telefono<span class="text-red-500">*</span>:</label>
    <input type="tel" id="phone" v-model="order.phone" class="w-full px-3 py-2 border rounded-lg" required>
</div>
<div class="mb-4">
    <label for="phone" class="block text-lg font-semibold mb-1">Indirizzo consegna<span class="text-red-500">*</span>:</label>
    <input type="text" id="address" v-model="order.address" class="w-full px-3 py-2 border rounded-lg" required>
</div>
<div class="mb-4">
    <label for="phone" class="block text-lg font-semibold mb-1">Nome citofono<span class="text-red-500">*</span>:</label>
    <input type="text" id="name_doorbell" v-model="order.name_doorbell" class="w-full px-3 py-2 border rounded-lg" required>
</div>
                <div id="checkout-message"></div>
                <div id="dropin-container"></div>
                <button @click="submitPayment" class="btn btn-orange text-white px-4 py-2 rounded-md" id="submit-button">Conferma ordine</button>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
// import { defineProps, toRaw, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia-vue3';
import * as DropIn from 'braintree-web-drop-in';
import { ref } from 'vue';
import { defineProps, toRaw, onMounted, resolveComponent } from 'vue';


const props = defineProps({
    cartList: {
        type: Object,
    },
    errors: {
        type: Object,
    }
});

const order = ref({
    name: '',
    email: '',
    phone: '',
    address: '',
    name_doorbell: '',
    cartList: props.cartList
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
        };
        const orderDetails = {
            name: order.value.name,
            email: order.value.email,
            phone: order.value.phone,
            address: order.value.address,
            name_doorbell: order.value.name_doorbell
        };

        Inertia.post('/process_payment', { 'paymentMethodNonce': payload.nonce, 'amount' : total, 'orderDetails': orderDetails })
    });
};
</script>

<style></style>
