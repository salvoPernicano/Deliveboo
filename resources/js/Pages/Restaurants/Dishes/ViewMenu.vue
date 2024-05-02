<template>
    <AuthenticatedLayout>

        <Head title="Menu" />
        <div class=" text-black p-5">
            <div class="flex justify-between">
                <div>
                    <h1>{{ restaurant.name }}</h1>
                </div>

                <div class="hidden sm:flex  ">
                    <div>
                        <Link class="bg-[#F98F00] p-3 text-white font-bold border rounded-lg flex items-center gap-2"
                            :href="route('dishes.create', { restaurant: props.restaurant.id })">
                        Crea Nuovo Piatto
                        <div>
                            <img src="../../../../../public/img/PiuBianco.svg" alt="">
                        </div>
                        </Link>
                    </div>
                </div>
            </div>


            <div
                class="w-full bg-white container mx-auto flex flex-col  gap-5  text-white rounded-lg m-5 p-4 shadow ">
                <div class="sm:text-start sm:flex sm:justify-between sm:items-center flex flex-col mb-9 sm:flex-row">
                    <div class=" sm:flex sm:justify-between ">
                        <div class="flex flex-col ">
                            <h4 class="text-black ">
                                I tuoi piatti
                            </h4>
                            <span class="text-gray-400">
                                Qui puoi visualizzare i tuoi piatti, crearne altri e modificarli.
                            </span>
                        </div>
                    </div>
                    <div class="flex gap-2 h-16 sm:items-end flex-col  sm:flex sm:flex-row">
                        <div class="flex gap-2 items-center">
                            <img class="h-7 w-7" src="../../../../../public/img/visibile.svg" alt="">
                            <span class="text-black">= visibile ai clienti</span>
                        </div>
                        <div class="flex gap-2 items-center">
                            <img class="h-7 w-7" src="../../../../../public/img/nonVisibile.svg" alt="">
                            <span class="text-black">= non visibile ai clienti</span>
                        </div>
                        <div class="w-full sm:hidden">
                            <Link class="bg-[#F98F00] py-2 px-1 text-white font-bold border rounded-lg "
                                :href="route('dishes.create', { restaurant: props.restaurant.id })">
                            Crea nuovo Piatto
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Your Dishes cards -->

                <div v-for="dish in dishes" :key="dish.id" class="  p-3 rounded-lg shadow  sm:hidden ">

                    <div class="flex justify-between">
                        <div class="flex items-center">
                            <!-- Immagine visibile -->
                            <img v-if="dish.visible" src="../../../../../public/img/visibile.svg" alt=""
                                class="mr-2 h-5 w-5">
                            <!-- Immagine non visibile -->
                            <img v-else src="../../../../../public/img/nonVisibile.svg" alt="" class="mr-2 h-5 w-5">

                            <label :for="'visible-' + dish.id" class="cursor-pointer">{{ dish.name }}</label>

                            <!-- Invisibile e non accessibile, usato solo per cambiare lo stato del piatto -->
                            <input @click="toggleVisibility(dish)" v-model="dish.visible" type="checkbox" name="visible"
                                :id="'visible-' + dish.id" class="ml-2 hidden">
                        </div>
                        <div>
                            <h6 class="font-extrabold text-black text-start"> {{ dish.name }}</h6>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-between ">
                        <div class=" rounded-xl flex items-center w-[40%]">
                            <img class="object-cover h-100 w-100 rounded-lg " :src="`/storage/${dish.image}`" alt="">
                        </div>

                        <div class="flex flex-col gap-2 justify-end">
                            <button type="submit" class="border border-gray-300 rounded-lg p-2 "
                                @click.prevent="edit(dish.id)">
                                <div class="flex gap-1 text-black">
                                    <img src="../../../../../public/img/blockNote.svg" alt="">
                                    Modifiche
                                </div>
                            </button>
                            <button type="submit" class="bg-red-500 text-white rounded-lg p-2"
                                @click.prevent="showDeleteConfirmation(dish.id)">
                                <div class="flex gap-1">
                                    <img src="../../../../../public/img/basket.svg" alt="">
                                    Elimina
                                </div>

                            </button>
                        </div>

                    </div>

                    <div class="flex justify-start gap-3  mt-2">
                        <div class="flex flex-col w-full ">
                            <div class="flex">
                                <div class="flex flex-col w-full p-2">

                                    <div class="flex justify-between">
                                        <span class="text-orange-500 ">€{{ dish.price }}</span>
                                        <span class="text-black">{{ dish.category }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- orders laptop -->
                <div class="relative sm:overflow-scroll  hidden sm:block">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                        <thead class="text-xs text-gray-700 uppercase ">
                            <tr>
                                <th scope="col">
                                    Visibile all'utente
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    immagine
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    nome
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Categoria
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Prezzo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Azioni
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b " v-for="dish in dishes">
                                <th class="flex justify-center items- h-36">
                                    <div class="flex items-center">
                                        <img v-if="dish.visible" src="../../../../../public/img/visibile.svg" alt=""
                                            class="mr-2 h-8 w-8">
                                        <img v-else src="../../../../../public/img/nonVisibile.svg" alt=""
                                            class="mr-2 h-8 w-8">
                                        <input @click="toggleVisibility(dish)" v-model="dish.visible" type="checkbox"
                                            name="visible" :id="'visible-' + dish.id" class="ml-2 hidden">
                                    </div>

                                </th>

                                <th scope="row"
                                    class=" px-1 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <img class="w-36 h-36 object-cover rounded-lg" :src="`/storage/${dish.image}`"
                                        alt="img">
                                </th>
                                <td class="px-6 py-4 text-lg capitalize">
                                    {{ dish.name }}
                                </td>
                                <td class="px-6 py-4 text-lg capitalize">
                                    {{ dish.category }}
                                </td>
                                <td class="px-6 py-4 text-lg">
                                    €{{ dish.price }}
                                </td>
                                <td class="px-6 py-4 text-lg flex gap-2 ">

                                    <button type="submit" class="border border-gray-300 rounded-lg p-2 "
                                        @click.prevent="edit(dish.id)">
                                        <div class="flex gap-1 text-black">
                                            <img src="../../../../../public/img/blockNote.svg" alt="">
                                            Modifiche
                                        </div>
                                    </button>
                                    <button type="submit" class="bg-red-500 text-white rounded-lg p-2"
                                        @click.prevent="showDeleteConfirmation(dish.id)">
                                        <div class="flex gap-1">
                                            <img src="../../../../../public/img/basket.svg" alt="">
                                            Elimina
                                        </div>

                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>


            <div v-if="showConfirmation" class="popup">
                <div class="popup-content">
                    <p>Sei sicuro di voler eliminare questo piatto?</p>
                    <div class="button-container flex justify-center gap-4">
                        <button @click="confirmDeleteAction" class="confirm-btn">Conferma</button>
                        <button @click="cancelDelete" class="cancel-btn">Annulla</button>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>

</template>

<script setup>

import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const confirmDeleteAction = ref(null);


const props = defineProps({
    restaurant: Object,
    dishes: Array
});


const toggleVisibility = async (dish) => {
    dish.visible = !dish.visible;
};

function edit(dishId) {
    router.get('/restaurant/' + props.restaurant.id + '/dishes/' + dishId + '/edit');
}
// function destroy(id) {
//   router.delete('/dishes/' + id)
// }
// function confirmDelete(id) {
//   if (window.confirm('Sei sicuro di voler eliminare questo piatto?')) {
//     router.delete('/dishes/' + id);
//   }
// }






const showConfirmation = ref(false);

function deleteDish(id) {
    router.delete('/dishes/' + id);

    showConfirmation.value = false;
}

// Funzione per annullare l'eliminazione
function cancelDelete() {
    // Nasconde il popup di conferma
    showConfirmation.value = false;
}


function showDeleteConfirmation(id) {
    // Mostra il popup di conferma
    showConfirmation.value = true;

    // Imposta la funzione di eliminazione del piatto con l'id
    confirmDeleteAction.value = () => deleteDish(id);
}


</script>

<style>
.popup {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
}

.popup-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
}

.button-container {
    margin-top: 20px;
}

.confirm-btn,
.cancel-btn {
    padding: 10px 20px;
    margin: 0 10px;
    border-radius: 5px;
    cursor: pointer;
}

.confirm-btn {
    background-color: #4caf50;
    color: white;
}

.cancel-btn {
    background-color: #f44336;
    color: white;
}

.shadow {
    box-shadow: 0px 0px 8.0px rgba(0, 0, 0, 0.25);

}
</style>
