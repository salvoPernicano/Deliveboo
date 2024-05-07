<template>
    <GuestLayout>
        <div class="bg-[#FFA500] flex justify-center gap-4 pt-20 pb-10">
            <h2 class="text-center text-white">Carrello</h2>
        </div>
        <section class="p-2 mt-3 sm:pt-4 pb-32 lg:w-10/12 lg:mx-auto sm:p-5">

            <h4 class="mb-6">Carrello</h4>
            <div class="flex flex-col sm:flex-row sm:gap-5 w-full">

                <div id="cart" class="shadow w-full border rounded-lg text-center py-4 h-fit">
                    
                    <ul class="w-full flex flex-col items-center justify-center py-6">
                        <li v-for="item in localCartList" :key="item.id"
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
                                            :value="item.quantity"
                                            class="text-black border-0 bg-transparent text-center w-20">
                                        <!-- @input="updateQuantity(item.id, $event.target.value)" -->
                                    </div>
                                </div>
                                <button @click="increaseQuantity(item.id)" class="mx-4 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                                        width="24">
                                        <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                                    </svg>
                                </button>
                            </div>
                            <button @click="removeFromCart(item.id)" class=" text-red-500 p-2">
                                Rimuovi piatto
                            </button>
                            <!-- <div class="flex items-center w-full">
                                <p class="w-3/5 font-bold">{{ item.name }}</p>

                                <span class="w-1/5 mx-2">€{{ item.price }}</span>
                                <input type="number" :name="`quantity-${item.id}`" :id="`quantity-${item.id}`"
                                    :value="item.quantity" @input="updateQuantity(item.id, $event.target.value)"
                                    class="text-black w-20">

                            </div> -->
                            <!-- <button @click="increaseQuantity(item.id)" class="mx-4 ">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                    <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                                </svg>
                            </button> -->
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
// import { defineProps, toRaw, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import * as DropIn from 'braintree-web-drop-in';
import { ref } from 'vue';
import { defineProps, toRaw, onMounted, resolveComponent } from 'vue';
import { computed } from 'vue';

const props = defineProps({
    cartList: {
        type: Object,
    },
    errors: {
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
        const updatedOrderDetails = {
            name: order.value.name,
            email: order.value.email,
            phone: order.value.phone,
            address: order.value.address,
            name_doorbell: order.value.name_doorbell,
            cartList: localCartList.value  // Assicurati che cartList includa le quantità aggiornate
        };

        let amount = total.value;

        Inertia.post('/process_payment', { 'paymentMethodNonce': payload.nonce, 'amount': amount, 'orderDetails': updatedOrderDetails })
    });
};
</script>

<style></style>
