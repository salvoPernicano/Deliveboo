<template>
    <GuestLayout>
        <div class="bg-[#FFA500] flex justify-center gap-4 pt-20 pb-10">
            <h2 class="text-center text-white">Carrello</h2>
        </div>
        <section
            class="p-2 mt-3 sm:pt-4 pb-32 lg:w-10/12 lg:mx-auto sm:p-5">

            <h4 class="mb-6">Carrello</h4>
            <div class="flex flex-col sm:flex-row sm:gap-5 w-full">

                <div id="cart" class="shadow w-full border rounded-lg text-center py-4 h-fit">
                    <ul class="w-full flex flex-col items-center justify-center py-6">
                        <li v-for="item in cartList" :key="item.id"
                            class="p-4 flex flex-col items-center justify-center w-full">
                            <div class="flex">
                                <button @click="decreaseQuantity(item.id)" class="mx-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                                        width="24">
                                        <path d="M200-440v-80h560v80H200Z" />
                                    </svg>
                                </button>
                                <div class="flex justify-start items-center gap-5">
                                    <img :src="'storage/' + item.image" alt="product_image" class="h-20">
                                    <div class="flex flex-col items-start">
                                        <p>{{ item.name }}</p>
                                        <span>€{{ item.price }}</span>
                                        <input type="number" :name="`quantity-${item.id}`" :id="`quantity-${item.id}`"
                                            :value="item.quantity" @input="updateQuantity(item.id, $event.target.value)"
                                            class="text-black border-0 bg-transparent text-center w-20">
                                    </div>
                                </div>
                                <button @click="increaseQuantity(item.id)" class="mx-4 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                                        width="24">
                                        <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                                    </svg>
                                </button>
                            </div>

                            <div class="flex justify-between gap-6">
                                <Link :href="`/remove-from-cart/${item.id}`"
                                    class="text-white bg-red-500 rounded-lg p-2">
                                Rimuovi piatto
                                </Link>

                                <button @click="updateQty(item.id)"
                                    class="text-white bg-green-600 rounded-lg p-2">Conferma
                                    quantità
                                </button>
                            </div>
                        </li>
                    </ul>

                    <div class="flex justify-between mx-16 font-bold text-xl">
                        <span>Totale:</span>
                        <span>€{{ total }}</span>
                    </div>
                </div>
                <div class="shadow border rounded-lg w-full text-center p-4 mt-6 sm:mt-0 bg-white" id="dropin-wrapper">
                    <p class="italic text-center text-xs text-red-500 pb-4">I campi contrassegnati con * sono
                        obbligatori</p>
                    <div>
                        <div class="mb-4">
                            <input type="text" id="name" v-model="order.name" placeholder="Name*"
                                class="w-full border-gray-300 focus:border-[#FFA500] focus:ring-[#FFA500] rounded-md shadow-sm"
                                required>
                        </div>
                        <div class="mb-4">
                            <input type="email" id="email" v-model="order.email" placeholder="Email*"
                                class="w-full border-gray-300 focus:border-[#FFA500] focus:ring-[#FFA500] rounded-md shadow-sm"
                                required>
                        </div>
                        <div class="mb-4">
                            <input type="tel" id="phone" v-model="order.phone" placeholder="Telefono*"
                                class="w-full border-gray-300 focus:border-[#FFA500] focus:ring-[#FFA500] rounded-md shadow-sm"
                                required>
                        </div>
                        <div class="mb-4">
                            <input type="text" id="address" v-model="order.address" placeholder="Indirizzo di consegna*"
                                class="w-full border-gray-300 focus:border-[#FFA500] focus:ring-[#FFA500] rounded-md shadow-sm"
                                required>
                        </div>
                        <div class="mb-4">
                            <input type="text" id="name_doorbell" v-model="order.name_doorbell" placeholder="Citofono"
                                class="w-full border-gray-300 focus:border-[#FFA500] focus:ring-[#FFA500] rounded-md shadow-sm"
                                required>
                        </div>
                    </div>
                    <div id="checkout-message"></div>
                    <div id="dropin-container"></div>
                    <button @click="submitPayment" class="btn btn-orange text-white px-4 py-2 rounded-md z-50"
                        id="submit-button">Conferma ordine</button>
                </div>
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

        Inertia.post('/process_payment', { 'paymentMethodNonce': payload.nonce, 'amount': total, 'orderDetails': orderDetails })
    });
};
</script>

<style></style>
