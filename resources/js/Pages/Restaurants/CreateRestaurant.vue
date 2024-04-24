<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3'; 
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/inertia-vue3';


defineProps({ errors: Object, typologies: Array });

const newRestaurant = useForm({
     name: null,
     address: null,
     p_iva: null,
     image: null,
     description: null,
     user_id : 1,
     selectedTypologies: []
 });
0


 function submit(){
    router.post('/restaurant',newRestaurant)
 }

const handleImageChange = (event) => {
    newRestaurant.image = event.target.files[0];
};
</script>

<template>
    <Head title="Crea Ristorante"></Head>
    <AuthenticatedLayout>
        <div class="flex flex-col gap-9 justify-center items-center">
        <h1 class="text-black text-5xl font-bold">Crea un nuovo post</h1>

        <form class="flex flex-col text-black text-lg text-center gap-7" action="" @submit.prevent="submit" enctype="multipart/form-data">
            
            <div class="flex flex-col">
                <label for="">Inserisci nome Ristorante</label>
                <input class="text-black" type="text" name="title" v-model="newRestaurant.name">
                <div v-if="errors.name"><span class="text-red-700">{{ errors.name }}</span></div>
            </div>
            
            <div class="flex flex-col">
                <label for="">Inserisci indirizzo</label>
                <input class="text-black" type="text" name="title" v-model="newRestaurant.address">
                <div v-if="errors.address"><span class="text-red-700">{{ errors.address }}</span></div>
            </div>
            
            <div class="flex flex-col">
                <label for="">Inserisci Partita Iva</label>
                <input class="text-black" type="text" name="title" v-model="newRestaurant.p_iva">
                <div v-if="errors.p_iva"><span class="text-red-700">{{ errors.p_iva }}</span></div>
            </div>
            
            <div class="flex flex-col">
                <label for="">Carica immagine</label>
                <input type="file" name="image" accept="image/*" @change="handleImageChange">
                <div v-if="errors.image"><span class="text-red-700">{{ errors.image }}</span></div>
            </div>
            
            <div class="flex flex-col">
                <label for="">Inserisci descrizione</label>
                <textarea class="text-black" name="description" cols="30" rows="10" v-model="newRestaurant.description"></textarea>
                <div v-if="errors.description"><span class="text-red-700">{{ errors.description }}</span></div>
            </div>
            <div class="flex flex-col">
                    <label for="">Seleziona tipologie di cucina</label>
                    <select v-model="newRestaurant.selectedTypologies" multiple>
                        <option v-for="typology in typologies" :value="typology.id">{{ typology.typology_name }}</option>
                    </select>
                    <div v-if="errors.selectedTypologies"><span class="text-red-700">{{ errors.selectedTypologies }}</span></div>
                </div>
            
            <button type="submit" class="bg-blue-950 hover:bg-black hover:text-white text-black font-bold py-2 px-4 rounded-full uppercase">Salva post</button>
        </form>
    </div>
    </AuthenticatedLayout>
   
</template>
