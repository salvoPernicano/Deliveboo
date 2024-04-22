<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

defineProps({ errors: Object });

const newRestaurant = useForm({
     name: null,
     address: null,
     p_iva: null,
     image: null,
     description: null,
     user_id : 1
 });

const handleImageChange = (event) => {
    newRestaurant.image = event.target.files[0];
};
</script>

<template>
    <div class="flex flex-col gap-9 justify-center items-center">
        <h1 class="text-black text-5xl font-bold">Crea un nuovo post</h1>

        <form class="flex flex-col text-black text-lg text-center gap-7" action="" @submit.prevent="newRestaurant.post('/restaurant')" enctype="multipart/form-data">
            
            <div class="flex flex-col">
                <label for="">Inserisci nome Ristorante</label>
                <input class="text-black" type="text" name="title" v-model="newRestaurant.name">
                <div v-if="errors.name">{{ errors.name }}</div>
            </div>
            
            <div class="flex flex-col">
                <label for="">Inserisci indirizzo</label>
                <input class="text-black" type="text" name="title" v-model="newRestaurant.address">
                <div v-if="errors.address">{{ errors.address }}</div>
            </div>
            
            <div class="flex flex-col">
                <label for="">Inserisci Partita Iva</label>
                <input class="text-black" type="text" name="title" v-model="newRestaurant.p_iva">
                <div v-if="errors.p_iva">{{ errors.p_iva }}</div>
            </div>
            
            <div class="flex flex-col">
                <label for="">Carica immagine</label>
                <input type="file" name="image" accept="image/*" @change="handleImageChange">
                <div v-if="errors.image">{{ errors.image }}</div>
            </div>
            
            <div class="flex flex-col">
                <label for="">Inserisci descrizione</label>
                <textarea class="text-black" name="description" cols="30" rows="10" v-model="newRestaurant.description"></textarea>
                <div v-if="errors.description">{{ errors.description }}</div>
            </div>
            
            <button class="bg-blue-950 hover:bg-black hover:text-white text-black font-bold py-2 px-4 rounded-full uppercase">Salva post</button>
        </form>
    </div>
</template>
