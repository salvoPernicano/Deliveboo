<template>
    <GuestLayout>
        <div v-for="item in restaurantDetails">
        <div :style="item.image ? { backgroundImage: 'url(/storage/' + item.image + ')' } : { backgroundColor: '#FFA500' }"
            class="imgBackground flex flex-col justify-center pt-8 sm:p-0 h-64">
            <h2 class="text-center text-white capitalize">Da {{ item.name }}</h2>
        </div>
    </div>
       
        <section class="p-2 mt-3 sm:pt-4 pb-32 lg:w-10/12 lg:mx-auto sm:p-5">
            <h4 class="mb-6">Carrello</h4>
            <div class="flex flex-col sm:flex-row sm:gap-5 w-full">

                <div id="cart" class="shadow w-full border rounded-lg text-center py-4 h-fit">
                    
                    <ul class="w-full flex flex-col items-center justify-center py-6">
                        <li v-for="item in localCartList" :key="item.id"
                            class="p-4 flex flex-col font-semibold sm:items-center justify-center w-full ">
                            <div class="flex w-full">
                                <div class="flex items-center gap-5 w-full">
                                    <img :src="'/storage/' + item.image" alt="product_image" class="h-20 object-cover w-20 sm:h-32 sm:w-40">
                                    <div class="flex w-full gap-2 items-center justify-between">
                                        <div class="w-14 sm:w-2/3 text-left">
                                            <p>{{ item.name }}</p>
                                            <span>€{{ item.price }}</span>
                                        </div>
                                        <div class="flex items-center justify-between sm:w-1/3">
                                            <button @click="decreaseQuantity(item.id)" class="mx-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                                                    width="24">
                                                    <path d="M200-440v-80h560v80H200Z" />
                                                </svg>
                                            </button>
                                            <input type="number" :name="`quantity-${item.id}`" :id="`quantity-${item.id}`"
                                                :value="item.quantity"
                                                class="text-black border-0 bg-transparent text-center w-14">
                                            <!-- @input="updateQuantity(item.id, $event.target.value)" -->
                                            <button @click="increaseQuantity(item.id)" class="mx-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                                                    width="24">
                                                    <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button @click="removeFromCart(item.id)" class=" text-red-500 p-2">
                                Rimuovi piatto
                            </button>
                        </li>
                    </ul>

                    <div class="flex justify-center gap-3 mx-16 font-bold text-xl">
                        <span>Totale:</span>
                        <span>€{{ total }}</span>
                    </div>
                </div>


                <div class="shadow border rounded-lg w-full text-center p-4 mt-6 sm:mt-0 bg-white" id="dropin-wrapper">
                    <p class="italic text-center text-xs text-red-500 pb-4">I campi contrassegnati con * sono
                        obbligatori</p>
                    <div>
                        <div class="mb-4">
                            <input type="text" id="name" v-model="order.name" placeholder="Nome*"
                                class="w-full border-gray-300 focus:border-[#FFA500] focus:ring-[#FFA500] rounded-md shadow-sm"
                                required>
                        </div>
                        <div class="mb-4">
                            <input type="email" id="email" v-model="order.email"
                            placeholder="Email*"
                                class="w-full border-gray-300 focus:border-[#FFA500] focus:ring-[#FFA500] rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            
                            <input type="tel" id="phone" v-model="order.phone"
                            placeholder="Telefono*"
                                class="w-full border-gray-300 focus:border-[#FFA500] focus:ring-[#FFA500] rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <input type="text" id="address" v-model="order.address"
                            placeholder="Indirizzo di consegna*"
                                class="w-full border-gray-300 focus:border-[#FFA500] focus:ring-[#FFA500] rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            
                            <input type="text" id="name_doorbell" v-model="order.name_doorbell"
                            placeholder="Citofono"
                                class="w-full border-gray-300 focus:border-[#FFA500] focus:ring-[#FFA500] rounded-md shadow-sm" required>
                        </div>

                    </div>
                    <div id="checkout-message"></div>
                    <div id="dropin-container"></div>
                    <button @click="submitPayment" class="btn btn-orange text-white px-4 py-2 rounded-md"
                        id="submit-button">Conferma ordine</button>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
// import { Inertia } from '@inertiajs/inertia';
import { router } from '@inertiajs/vue3';
import * as DropIn from 'braintree-web-drop-in';
import { ref } from 'vue';
import { defineProps, toRaw, onMounted } from 'vue';
import { computed } from 'vue';

const props = defineProps({
    cartList: {
        type: Object,
    },
    errors: {
        type: Object,
    },
    restaurantDetails:{
        type: Object,
    }
});

const localCartList = ref(props.cartList);
const order = ref({
    name: '',
    email: '',
    phone: '',
    address: '',
    name_doorbell: '',
    cartList: localCartList,
});

let cartListtoRaw = toRaw(localCartList.value);
const keys = Object.keys(cartListtoRaw);


const total = computed(() => {
    let calculatedTotal = 0;
    for (const productId in localCartList.value) {
        const cartItem = localCartList.value[productId];
        calculatedTotal += parseFloat(cartItem.price) * cartItem.quantity;
    }
    return calculatedTotal.toFixed(2);
});

const removeFromCart = (productId) => {
    axios.get("/remove-from-cart/" + productId)
        .then(response => {
            localCartList.value = response.data.cart;
        })
        .catch(error => {
            console.error('Errore durante l\'aggiunta al carrello:', error);
        });
}

const decreaseQuantity = (productId) => {
    const item = localCartList.value[productId];
    if (item && item.quantity > 1) {
        item.quantity--;
    }
}

// increaseQuantity function
const increaseQuantity = (productId) => {
    const item = localCartList.value[productId];
    if (item) {
        item.quantity++;
    }
}


let instance = null;

onMounted(() => {
    DropIn.create({
        authorization: 'sandbox_x6qjzvjf_44sxcnc6mrqrspwc',
        container: '#dropin-container',
        locale: 'it_IT'
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
        const updatedOrderDetails = {
            name: order.value.name,
            email: order.value.email,
            phone: order.value.phone,
            address: order.value.address,
            name_doorbell: order.value.name_doorbell,
            cartList: localCartList.value  // Assicurati che cartList includa le quantità aggiornate
        };

        let amount = total.value;

        router.post('/process_payment', { 'paymentMethodNonce': payload.nonce, 'amount': amount, 'orderDetails': updatedOrderDetails })
    });
};
</script>

<style></style>
