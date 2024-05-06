<script setup>
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

let props = defineProps({
    restaurant: Object,
    errors: Object,
    dish: Object
});

const editPlate = useForm({
    id: props.dish.id,
    restaurant_id: props.restaurant.id,
    name: props.dish.name,
    description: props.dish.description,
    price: props.dish.price,
    visible: true,
    category: props.dish.category,
    image: null
});

const categories = ['Giapponese', 'Italiana', 'Cinese', 'Messicano', 'Indiana'];

function submit(dishId) {
    const formData = {
        _method: 'put', // Utilizza form method spoofing per indicare al server di gestire la richiesta come PUT
        name: editPlate.name,
        description: editPlate.description,
        price: editPlate.price,
        visible: true,
        category: editPlate.category,
        image: editPlate.image
    };

    router.post(`/restaurant/${props.restaurant.id}/dishes/${dishId}`, formData);
}


function handleImageChange(event) {
    editPlate.image = event.target.files[0];

}

function handleSubmit(restaurantId) {

editPlate.visible = editPlate.visible === true;
router.put(`/restaurant/${restaurantId}/dishes`, editPlate);

}


</script>

<style>
.shadow {
    box-shadow: 0px 0px 8.0px rgba(0, 0, 0, 0.25);

}
</style>
<template>

    <Head title="Crea piatto"></Head>
    <AuthenticatedLayout>

        <div class="  flex gap-9 justify-center w-full">
            <div class="shadow flex flex-col p-6 m-6 rounded-xl w-80 sm:w-2/3 ">

                <h2 class=" font-bold text-xl">Modifica piatto</h2>
                <span class="mt-2">Compila tutti i campi e vedi in anteprima cosa vedranno i tuoi clienti</span>

                <div class="h-full ">
                    <form class="flex flex-col text-black text-lg gap-4 mt-4" @submit.prevent="submit(dish.id)"
                        enctype="multipart/form-data">

                        <div class="flex flex-col gap-1">
                            <label for="" class="font-bold">Immagine</label>
                            <input type="file" name="image" accept="image/*" @change="handleImageChange"
                                class="border rounded-e-lg text-gray-400 ">

                        </div>
                        <div class="flex gap-20">
                            <div class=" text-center flex items-center">
                                <span class="font-bold">Vecchia Foto:</span>

                            </div>
                            <div class=" shadow rounded-lg ">
                                <img class="w-40 mx-auto m-4 rounded-lg" :src="`/storage/${dish.image}`" alt="img">
                            </div>
                            <div v-if="errors.name"><span class="text-white bg-red-400 rounded-lg p-1">{{ errors.image
                                    }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="" class="font-bold">Inserisci Nome del Piatto</label>
                            <input class=" border rounded-lg border-gray-200" type="text" name="name"
                                v-model="editPlate.name">
                            <div v-if="errors.name"><span class="text-white bg-red-400 rounded-lg p-1">{{ errors.name
                                    }}</span></div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="" class="font-bold">Inserisci descrizione</label>
                            <textarea class="text-black rounded-lg border-gray-200" name="description" cols="30"
                                rows="10" v-model="editPlate.description"></textarea>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="" class="font-bold">Categoria</label>
                            <select class="text-black rounded-lg border-gray-200" name="category"
                                v-model="editPlate.category">
                                <option v-for="category in categories" :value="category">{{ category }}</option>
                            </select>
                            <div v-if="errors.name"><span class="text-white bg-red-400 rounded-lg p-1">{{
                                errors.category }}</span></div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="" class="font-bold">Prezzo</label>
                            <input class="text-black rounded-lg  border-gray-200 " type="number" step="0.01"
                                name="price" v-model="editPlate.price">
                            <div v-if="errors.name"><span class="text-white bg-red-400 rounded-lg p-1">{{ errors.price
                                    }}</span></div>
                        </div>
                        <h3 class="font-bold text-center text-xl">{{ restaurant.name }}</h3>
                        <div class="flex justify-center gap-3">
                            <button @click.prevent="submit(props.dish.id)"
                                class="bg-orange-500 text-white font-bold py-1 px-3 rounded-lg">Salva
                                piatto
                            </button>
                            <button
                                class="bg-white border-orange-500 border text-orange-500 font-bold py-1 px-3 rounded-lg ">Annulla
                            </button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </AuthenticatedLayout>
</template>
