<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
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

        <div class="flex flex-col gap-9 justify-center items-center">
            <h1 class="text-black text-5xl font-bold">Crea un nuovo post</h1>

            <!-- Unico form per entrambi i form -->
            <form class="flex flex-col text-black text-lg text-center gap-7" @submit.prevent="handleSubmit" enctype="multipart/form-data">

                <!-- Campi per il nuovo ristorante -->
                <div class="flex flex-col">
                    <label for="restaurantName">Inserisci nome Ristorante</label>
                    <input id="restaurantName" class="text-black" type="text" name="name" v-model="registrationForm.restaurant_name">
                    <div v-if="errors.name"><span class="text-red-700">{{ errors.name }}</span></div>
                </div>

                <div class="flex flex-col">
                    <label for="restaurantAddress">Inserisci indirizzo</label>
                    <input id="restaurantAddress" class="text-black" type="text" name="address" v-model="registrationForm.address">
                    <div v-if="errors.address"><span class="text-red-700">{{ errors.address }}</span></div>
                </div>

                <div class="flex flex-col">
                    <label for="restaurantPIVA">Inserisci Partita Iva</label>
                    <input id="restaurantPIVA" class="text-black" type="text" name="p_iva" v-model="registrationForm.p_iva">
                    <div v-if="errors.p_iva"><span class="text-red-700">{{ errors.p_iva }}</span></div>
                </div>

                <div class="flex flex-col">
                    <label for="restaurantImage">Carica immagine</label>
                    <input id="restaurantImage" type="file" name="image" accept="image/*" @change="handleImageChange">
                    <div v-if="errors.image"><span class="text-red-700">{{ errors.image }}</span></div>
                </div>

                <div class="flex flex-col">
                    <label for="restaurantDescription">Inserisci descrizione</label>
                    <textarea id="restaurantDescription" class="text-black" name="description" cols="30" rows="10" v-model="registrationForm.description"></textarea>
                    <div v-if="errors.description"><span class="text-red-700">{{ errors.description }}</span></div>
                </div>

                <div class="flex flex-col">
                    <label for="restaurantTypologies">Seleziona tipologie di cucina</label>
                    <select id="restaurantTypologies" v-model="registrationForm.selectedTypologies" multiple>
                        <option v-for="typology in typologies" :value="typology.id">{{ typology.typology_name }}</option>
                    </select>
                    <div v-if="errors.selectedTypologies"><span class="text-red-700">{{ errors.selectedTypologies }}</span></div>
                </div>

                <!-- Campi per la registrazione -->
                <div>
                    <label for="name">Name</label>
                    <input id="name" type="text" class="mt-1 block w-full" v-model="registrationForm.name" required autofocus autocomplete="name">
                    <InputError class="mt-2" :message="registrationForm.errors.name" />
                </div>

                <div class="mt-4">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="mt-1 block w-full" v-model="registrationForm.email" required autocomplete="username">
                    <InputError class="mt-2" :message="registrationForm.errors.email" />
                </div>

                <div class="mt-4">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="mt-1 block w-full" v-model="registrationForm.password" required autocomplete="new-password">
                    <InputError class="mt-2" :message="registrationForm.errors.password" />
                </div>

                <div class="mt-4">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="registrationForm.password_confirmation" required autocomplete="new-password">
                    <InputError class="mt-2" :message="registrationForm.errors.password_confirmation" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <!-- <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Already registered?
                    </Link> -->
                    <button type="submit" class="bg-blue-950 hover:bg-black hover:text-white text-black font-bold py-2 px-4 rounded-full uppercase">registrti</button>
                </div>

       
            </form>
        </div>

</template>

