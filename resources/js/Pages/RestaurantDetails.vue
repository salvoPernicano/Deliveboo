<template>

    <Head>
        <title>{{ restaurant.name }}</title>
    </Head>

    <GuestLayout>

        <div :style="restaurant.image ? { backgroundImage: 'url(/storage/' + restaurant.image + ')' } : { backgroundColor: '#FFA500' }"
            class="imgBackground flex flex-col justify-center pt-8 sm:p-0 h-64">
            <h2 class="text-center text-white capitalize">{{ restaurant.name }}</h2>
            <p class="text-center text-white">{{ restaurant.description }}</p>
            <p class="text-center text-sm text-white mb-3">{{ restaurant.address }}</p>
        </div>

        <!-- Section Resturant/Menu -->
        <section
            class="p-2 mt-3 flex flex-wrap  sm:pt-4 pb-32 lg:w-10/12 lg:mx-auto sm:p-5 sm:flex sm:flex-nowrap sm:gap-5 sm:justify-center sm:h-screen ">

            <!-- card piatto resposive -->
            <div class="w-full sm:w-2/3  xl:w-2/3 sm:overflow-y-scroll">
                <div class="h-50 w-4/5 bg-white text-red-500 text-2xl mx-auto text-center font-bold" v-if="cartError">Non
                    puoi aggiungere al carrello piatti di ristoranti diversi, svuota il carrello per continuare</div>
                <h4 class="mb-6">Menu</h4>
                <ul class="flex justify-start flex-wrap gap-4 w-full sm:gap-3 ps-2">

                    <li v-for="dish in restaurant.dishes" :key="dish.id"  class="w-full sm:w-60">

                        <div v-if="dish.visible" class="bg-white rounded-lg shadow relative sm:pe-0 sm:mb-8">

                            <div class=" h-auto w-full flex justify-between sm:flex sm:flex-col sm:text-center">
                                <div class="flex gap-2 w-4/5 sm:flex sm:flex-col sm:w-full">
                                    <img class="h-20 w-20 sm:h-40 sm:w-60 object-cover rounded-tl-lg sm:rounded-t-lg sm:rounded-b-none"
                                        :src="'/storage/' + dish.image" alt="Dish Image" v-if="dish.image">

                                    <div class="flex flex-col overflow-hidden h-24">
                                        <h3 class="capitalize font-bold pt-1">{{ dish.name }}</h3>
                                        <div class="overflow-hidden text-ellipsis w-full sm:w-5/6 sm:mx-auto">
                                            <p class="capitalize pt-1 text-xs">{{ dish.description }}</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="flex flex-col gap-2 relative w-1/5 sm:w-full sm:mb-5">
                                    <p class="capitalize font-bold">{{ dish.price }}€</p>
                                </div>
                            </div>

                            <div class="bottom-3 absolute left-[82%] sm:translate-x-[50%] sm:left-[33%] sm:bottom-[-8%]">
                                <button @click="addToCart(dish.id)"
                                    class="bg-orange-dark rounded-full w-10 p-3 flex justify-center">
                                <img src="../../../public/img/add_cart.svg" alt="add to cart icon">
                                </button>
                            </div>

                            <!-- <div class="text-center">
                                <button @click="addToCart(dish.id)"
                                    class="rounded-md  p-2 m-2 text-white font-semibold">
                                    <div
                                        class="bottom-0 absolute left-[82%] sm:translate-x-[50%] sm:left-[33%] sm:bottom-[-6%]">
                                        <figure class="bg-orange-dark rounded-full w-10 p-3 flex justify-center">
                                            <img src="../../../public/img/add_cart.svg" alt="add to cart icon">
                                        </figure>
                                    </div>
                                </button>
                            </div> -->

                        </div>
                    </li>
                </ul>
            </div>

            <!-- Cart -->
            <div id="cart" class="sm:w-3/6 w-full flex-col   h-fit">
                <h4 class="mb-6">Carrello</h4>
                <div class="shadow border rounded-lg  mx-auto text-center py-2">
                    <ul class="w-full flex flex-col items-center justify-center py-6">
                        <li  v-for="item in localCartList" :key="item.id"
                            class="p-4 flex flex-col font-semibold items-center justify-center w-full ">
                            <div class="flex  w-full">
                                <div class="flex items-center gap-5 w-full">
                                    <img :src="'/storage/' + item.image" alt="product_image" class="h-20 w-20 sm:h-32 sm:w-40 object-cover">
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
                    <div class="flex flex-col">
                        <div class="flex justify-center mt-5">
                            <button @click="proceedToCart(localCartList)"
                                class="bg-orange-dark text-white p-2 font-semibold rounded-lg">Procedi con
                                l'ordine</button>
                        </div>
                        <button @click="clearCart" class="text-red-500 p-2 my-3 font-semibold">Svuota carrello</button>
                    </div>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import axios from 'axios';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { router } from '@inertiajs/vue3';


const props = defineProps({
    restaurant: {
        type: Object,
        required: true
    },
    cartList: {
        type: Object,
        required: false
    },
    isValidForCart: {
        type: Boolean,
    }
});

let cartError = ref(false);
const localCartList = ref(props.cartList);

const clearCart = () => {
    // Effettua una richiesta al backend per svuotare il carrello
    Inertia.post('/clear-cart').then(() => {
        // Aggiorna la visualizzazione del carrello dopo aver svuotato la sessione
        // Ad esempio, potresti ricaricare la pagina o eseguire un'altra azione necessaria
    }).catch(error => {
        console.error('Errore durante lo svuotamento del carrello:', error);
    });
};

// Definisci la funzione `addToCart` per aggiungere un elemento al carrello
const addToCart = (productId) => {
    if (props.isValidForCart) {
        axios.get("/add-to-cart/" + productId)
            .then(response => {
                // Aggiorna dinamicamente il carrello sulla pagina con i nuovi dati
                localCartList.value = response.data.cart;
            })
            .catch(error => {
                console.error('Errore durante l\'aggiunta al carrello:', error);
            });
    } else {
        cartError.value = true
    }
}

const removeFromCart = (productId) => {
    axios.get("/remove-from-cart/" + productId)
        .then(response => {
            // Aggiorna dinamicamente il carrello sulla pagina con i nuovi dati
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

function proceedToCart(cartList) {
    router.post("/change-cart-quantity", localCartList.value);
}

</script>

<style scoped>
.imgBackground {

    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    margin-top: 0px;
    padding-top: 80px;
    height: 60%;
    max-width: 100%;

}
</style>
