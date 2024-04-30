<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({ errors: Object, typologies: Array, userId: Number });



const registrationForm = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    restaurant_name: null,
    address: null,
    p_iva: null,
    image: null,
    description: null,
    user_id: null,
    selectedTypologies: []
});

function handleSubmit() {
    // Invia i dati del nuovo ristorante all'endpoint appropriato
    registrationForm.post(route('register'), {
        onFinish: () => registrationForm.reset('password', 'password_confirmation'),
    });

}

const handleImageChange = (event) => {
    newRestaurant.image = event.target.files[0];
};
</script>

<template>

    <div class="flex home flex-col h-full gap-3 justify-center items-center">
        <h1 class=" text-orange-400 text-5xl font-bold">Registra il tuo ristorante</h1>

        <!-- Unico form per entrambi i form -->
        <form
            class="bg-orange-400 w-1/3 max-w-3xl p-5 mb-10 rounded-lg flex flex-col  text-black text-lg text-center gap-7"
            @submit.prevent="handleSubmit" enctype="multipart/form-data">
            <span class="italic text-start text-sm">I campi contrassegnati con * sono obbligatori</span>
            <!-- Campi per il nuovo ristorante -->
            <div class="flex items-center justify-center mx-auto w-4/5 s gap-4">
                <div class="w-full">
                    <label class="font-bold" for="name">Nome utente *</label>
                    <input id="name" type="text" class="mt-1 block w-full rounded-lg" v-model="registrationForm.name"
                        required autofocus autocomplete="name">
                    <InputError class="mt-2" :message="registrationForm.errors.name" />
                </div>
                <div class="w-full">
                    <label class="font-bold" for="email">Email *</label>
                    <input id="email" type="email" class="mt-1 block w-full rounded-lg" v-model="registrationForm.email"
                        required autocomplete="username">
                    <InputError class="mt-2" :message="registrationForm.errors.email" />
                </div>
            </div>



            <div class="flex items-center justify-center mx-auto w-4/5 s gap-4">
                <div class="w-full">
                    <label class="font-bold" for="password">Password *</label>
                    <input id="password" type="password" class="mt-1 block w-full rounded-lg"
                        v-model="registrationForm.password" required autocomplete="new-password">
                    <InputError class="mt-2" :message="registrationForm.errors.password" />
                </div>
                <div class="w-full">
                    <label class="font-bold" for="password_confirmation">Conferma Password *</label>
                    <input id="password_confirmation" type="password" class="mt-1 block w-full rounded-lg"
                        v-model="registrationForm.password_confirmation" required autocomplete="new-password">
                    <InputError class="mt-2" :message="registrationForm.errors.password_confirmation" />

                </div>
            </div>


            <div class="flex flex-col w-4/5 mx-auto">
                <label class="font-bold" for="restaurantName">Inserisci nome Ristorante *</label>
                <input id="restaurantName" class="text-black rounded-md" type="text" name="name"
                    v-model="registrationForm.restaurant_name" required>
                <div v-if="errors.name"><span class="text-red-700">{{ errors.name }}</span></div>
            </div>

            <div class="flex flex-col w-4/5 mx-auto">
                <label class="font-bold" for="restaurantAddress">Inserisci indirizzo *</label>
                <input id="restaurantAddress" class="text-black rounded-md" type="text" name="address"
                    v-model="registrationForm.address" required>
                <div v-if="errors.address"><span class="text-red-700">{{ errors.address }}</span></div>
            </div>

            <div class="flex flex-col w-4/5 mx-auto">
                <label class="font-bold" for="restaurantPIVA">Inserisci Partita Iva *</label>
                <input id="restaurantPIVA" class="text-black rounded-md" type="text" name="p_iva"
                    v-model="registrationForm.p_iva" required>
                <div v-if="errors.p_iva"><span class="text-red-700">{{ errors.p_iva }}</span></div>
            </div>

            <div class="flex flex-col w-4/5 bg-white rounded-lg p-2 border border-gray-500  mx-auto">
                <label class="font-bold" for="restaurantImage">Carica immagine</label>
                <input id="restaurantImage" class="mx-auto" type="file" name="image" accept="image/*"
                    @change="handleImageChange">
                <div v-if="errors.image"><span class="text-red-700">{{ errors.image }}</span></div>
            </div>

            <div class="flex flex-col  w-4/5 mx-auto">
                <label class="font-bold" for="restaurantDescription">Inserisci una descrizione del ristorante</label>
                <textarea id="restaurantDescription" class="text-black rounded-lg" name="description" cols="30" rows="3"
                    v-model="registrationForm.description"></textarea>
                <div v-if="errors.description"><span class="text-red-700">{{ errors.description }}</span></div>
            </div>

            <div class="flex flex-col  mx-auto">
                <label class="font-bold" for="restaurantTypologies">Seleziona le tipologie di cucina del
                    ristorante</label>
                <select id="restaurantTypologies" class="rounded-lg" v-model="registrationForm.selectedTypologies"
                    multiple>
                    <option v-for="typology in typologies" :value="typology.id">{{ typology.typology_name }}</option>
                </select>
                <div v-if="errors.selectedTypologies"><span class="text-red-700">{{ errors.selectedTypologies }}</span>
                </div>
            </div>

            <!-- Campi per la registrazione -->


            <div class="flex items-center justify-center gap-5 mt-4">
                <button type="submit"
                    class="bg-white hover:bg-black hover:text-white text-black font-bold py-2 px-4 rounded-full uppercase">registati</button>
            </div>


        </form>
    </div>

</template>
<style>
.home {
    background-image: url('../../../../public/img/food-login.jpg');
    background-size: cover;
    background-repeat: no-repeat;
}
</style>
