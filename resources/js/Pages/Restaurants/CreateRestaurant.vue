<script setup>
import { useForm } from '@inertiajs/inertia-vue3';


const newRestaurant = useForm({
     name: null,
     address: null,
     p_iva: null,
     image: null,
     description: null,
 });

 const handleImageChange = (event) => {
  newRestaurant.image = event.target.files[0];
};
</script>

<template>
        <div class="flex flex-col gap-9  justify-center items-center  ">
        <h1 class="text-black text-5xl font-bold">Crea un nuovo post</h1>

        <form class="flex flex-col text-black text-lg text-center gap-7" action="" @submit.prevent="newRestaurant.post('/restaurant', {onBefore: () => {console.log(newRestaurant)}})" enctype="multipart/form-data">
            
            <div class="flex flex-col">
                <label for="">Inserisci nome Ristorante</label>
                <input class="text-black" type="text" name="title" v-model="newRestaurant.name">
            </div>
            <div class="flex flex-col">
                <label for="">Inserisci indirizzo</label>
                <input class="text-black" type="text" name="title" v-model="newRestaurant.address">
            </div>
            <div class="flex flex-col">
                <label for="">Inserisci Partita Iva</label>
                <input class="text-black" type="text" name="title" v-model="newRestaurant.p_iva">
            </div>
            <div class="flex flex-col">
                <label for="">Inserisci Immagine</label>
                <input type="file" v-on:change="handleImageChange">
            </div>
            <div class="flex flex-col">
                <label for="">Inserisci descrizione</label>
                <textarea class="text-black" name="description" id="" cols="30" rows="10" v-model="newRestaurant.description"></textarea>
            </div>
            <button @click="console.log(newRestaurant)" class="bg-blue-950 hover:bg-black hover:text-white text-black font-bold py-2 px-4 rounded-full uppercase">salva
                post</button>
        </form>
    </div>

    <p>ciao</p>

</template>



<style></style>
