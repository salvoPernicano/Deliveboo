<script setup>
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';

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
    if(editPlate.visible === 'true' || editPlate.visible === true){
        editPlate.visible = true
    } else {
        editPlate.visible = false
    };
    const formData = {
        _method: 'put', // Utilizza form method spoofing per indicare al server di gestire la richiesta come PUT
        name: editPlate.name,
        description: editPlate.description,
        price: editPlate.price,
        category: editPlate.category,
        visible: editPlate.visible,
        image: editPlate.image
    };

    router.post(`/restaurant/${props.restaurant.id}/dishes/${dishId}`, formData);
}


function handleImageChange(event) {
    editPlate.image = event.target.files[0];

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
                        <div class="flex flex-col sm:flex-row gap-3 sm:items-center">
                            <label for="" class="font-bold">Visibilità</label>

                            <div class="flex gap-2 items-center w-72 ">
                                <div class="flex ">
                                    <input type="radio" name="visible" id="visibility" value="true"  v-model="editPlate.visible" class="" @click="colorFull=!colorFull">
                                </div>

                                <div class="flex gap-2 rounded-lg border shadow p-4 " :class="{ 'border-orange-500': !colorFull, 'border-gray-400': colorFull}">
                                    <img src="../../../../../public/img/visibile.svg" alt="">
                                    <span class="text-[18px]" >= Visibile dai clienti </span>
                                </div>
                            </div>
                            <div class="flex gap-2 items-center w-72 ">
                                <div class="flex ">
                                    <input type="radio" name="visible" id="notVisible" class="" value="false" v-model="editPlate.visible" @click="colorFull">
                                </div>

                                <div class="flex gap-2 rounded-lg border shadow p-4 " :class="{ 'border-orange-500': colorFull, 'border-gray-400': !colorFull}">
                                    <img src="../../../../../public/img/nonVisibile.svg" alt="">
                                    <span class="text-[14px]">= Non visibile dai clienti</span>
                                </div>
                            </div>

                        </div>
                        <h3 class="font-bold text-center text-xl">{{ restaurant.name }}</h3>
                        <div class="flex justify-center gap-3">
                            <button type="submit"
                                class="bg-orange-500 text-white font-bold py-1 px-3 rounded-lg">Salva
                                piatto
                            </button>
                            <Link
                            :href="route('dishes.index')"
                            method="get"
                                    as="button"
                                class="bg-white border-orange-500 border text-orange-500 font-bold py-1 px-3 rounded-lg ">Annulla
                            </Link>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </AuthenticatedLayout>
</template>
