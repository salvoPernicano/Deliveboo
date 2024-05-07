<template>

    <Head title="Crea piatto"></Head>

    <AuthenticatedLayout>

        <div class="flex gap-9 justify-center w-full">
            <div class="shadow flex flex-col p-6 m-6 rounded-xl w-80 sm:w-2/3 bg-white">

                <h2 class=" font-bold text-xl">Crea un nuovo piatto </h2>
                <span class="mt-2">Compila tutti i campi e vedi in anteprima cosa vedranno i tuoi clienti</span>

                <div class="h-full ">
                    <form class="flex flex-col text-black text-lg gap-4 mt-4"
                        @submit.prevent="submit(props.restaurant.id)" enctype="multipart/form-data">

                        <div class="flex flex-col gap-1">
                            <label for="" class="font-bold">Immagine</label>
                            <input type="file" name="image" accept="image/*" @change="handleImageChange"
                                class="border rounded-e-lg text-gray-400 ">
                            <div v-if="errors.name"><span class="text-red-500 rounded-lg p-1">Compila questo campo</span></div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="" class="font-bold">Inserisci Nome del Piatto</label>
                            <input class=" border rounded-lg border-gray-200" type="text" name="name"
                                v-model="newPlate.name" placeholder="Lasagna">
                            <div v-if="errors.name"><span class="text-red-500 rounded-lg p-1">Compila questo campo</span></div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="" class="font-bold">Inserisci descrizione</label>
                            <textarea class="text-black rounded-lg border-gray-200" name="description" cols="30"
                                rows="10" v-model="newPlate.description"></textarea>

                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="" class="font-bold">Categoria</label>
                            <select class="text-black rounded-lg border-gray-200" name="category"
                                v-model="newPlate.category">
                                <option v-for="category in categories" :value="category">{{ category }}</option>
                            </select>
                            <div v-if="errors.name"><span class="text-red-500 rounded-lg p-1">Compila questo campo</span></div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="" class="font-bold">Prezzo</label>
                            <input class="text-black rounded-lg  border-gray-200 " type="number" step="0.01"
                                name="price" v-model="newPlate.price">
                            <div v-if="errors.name"><span class="text-red-500 rounded-lg p-1">Compila questo campo</span></div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 sm:items-center">
                            <label for="" class="font-bold">Visibilità</label>

                            <div class="flex gap-2 items-center w-72 ">
                                <div class="flex ">
                                    <input type="radio" name="visible" id="visibility" value="true"  v-model="newPlate.visible" class="" @click="colorFull=!colorFull">
                                </div>

                                <div class="flex gap-2 rounded-lg border shadow p-4 " :class="{ 'border-orange-500': !colorFull, 'border-gray-400': colorFull}">
                                    <img src="../../../../../public/img/visibile.svg" alt="">
                                    <span class="text-[18px]" >= Visibile dai clienti </span>
                                </div>
                            </div>
                            <div class="flex gap-2 items-center w-72 ">
                                <div class="flex ">
                                    <input type="radio" name="visible" id="notVisible" class="" value="false" v-model="newPlate.visible" @click="colorFull">
                                </div>

                                <div class="flex gap-2 rounded-lg border shadow p-4 " :class="{ 'border-orange-500': colorFull, 'border-gray-400': !colorFull}">
                                    <img src="../../../../../public/img/nonVisibile.svg" alt="">
                                    <span class="text-[14px]">= Non visibile dai clienti</span>
                                </div>
                            </div>

                        </div>

                        
                        <div class="flex justify-center gap-5 mt-10">
                            <button type="submit" class="bg-orange-500 text-white font-bold py-1 px-3 rounded-lg">Salva
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

<script setup>
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/inertia-vue3';

let props = defineProps({
    restaurant: Object,
    errors: Object
});

const newPlate = useForm({
    restaurant_id: props.restaurant.id,
    name: null,
    description: null,
    price: null,
    visible: true,
    category: null,
    image: null
});



const categories = ['Giapponese', 'Italiana', 'Cinese', 'Messicano', 'Indiana'];

function submit(restaurantId) {

    if(newPlate.visible === 'true'){
        newPlate.visible = true
    } else {
        newPlate.visible = false
    };
    console.log(newPlate);
    router.post(`/restaurant/${restaurantId}/dishes`, newPlate);
}

;

function handleImageChange(event) {
    const file = event.target.files[0];
    newPlate.image = file;
}





</script>

<style>
.shadow {
    box-shadow: 0px 0px 8.0px rgba(0, 0, 0, 0.25);

}
.borderOrange{

    border-color: #F98F00;
}
.errBorder{
    border-color: gray;
}
</style>
