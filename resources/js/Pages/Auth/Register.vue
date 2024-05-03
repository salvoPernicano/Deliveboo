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
    const password = registrationForm.get('password');
    const confirmPassword = registrationForm.get('password_confirmation');

    if (password === confirmPassword) {

        registrationForm.post(route('register'), {
            onFinish: () => registrationForm.reset('password', 'password_confirmation'),
        });
    } else {

        alert('Le password non coincidono. Per favore, inserisci password e conferma password uguali.');
    }
}




const handleImageChange = (event) => {
    registrationForm.image = event.target.files[0];
};
</script>

<template>
    <Head title="Register" />

    <GuestLayout>
        <div class="bg-foto">

            <!-- Unico form per entrambi i form -->
            <form class="w-3/5 p-5 mx-auto rounded-lg bg-white"
                @submit.prevent="handleSubmit" enctype="multipart/form-data">
                <p class="italic text-center text-xs text-red-500 pb-4">I campi contrassegnati con * sono obbligatori</p>
                <!-- Campi utente -->
                <div>
                    <div>
                        <InputLabel for="name" value="Nome utente*"/>
                        <TextInput id="name" type="text" class="mt-1 block w-full"
                            v-model="registrationForm.name" required autofocus autocomplete="name"/>
                        <InputError class="mt-2" :message="registrationForm.errors.name" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="email" value="Email*"/>
                        <TextInput id="email" type="email" class="mt-1 block w-full"
                            v-model="registrationForm.email" required autocomplete="username"/>
                        <InputError class="mt-2" :message="registrationForm.errors.email" />
                    </div>
                    <!-- Campi password -->
                    <div class="mt-4">
                        <InputLabel for="password" value="Password*"/>
                        <p class="text-start text-xs text-gray-400">La password deve contere almeno 8 caratteri.</p>
                        <TextInput id="password" type="password" class="mt-1 block w-full"
                            v-model="registrationForm.password" required autocomplete="new-password"/>
                    </div>
                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Conferma password*"/>
                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                            v-model="registrationForm.password_confirmation" required autocomplete="new-password"/>
                    </div>
                    <!-- Validazione client password -->
                    <div v-if="registrationForm.password_confirmation && registrationForm.password !== registrationForm.password_confirmation"
                        class="text-red-500 text-sm">
                        Le password non coincidono. Per favore, controlla che siano uguali.
                    </div>
                </div>
                <hr class="my-6">
                <!-- Campi ristorante -->
                <div>
                    <div>
                        <InputLabel for="restaurantName" value="Nome del ristorante*"/>
                        <TextInput id="restaurantName" type="text" name="name" class="mt-1 block w-full"
                            v-model="registrationForm.restaurant_name" required/>
                        <div v-if="errors.name"><span class="text-red-500">{{ errors.name }}</span></div>
                    </div>
    
                    <div class="mt-4">
                        <InputLabel or="restaurantAddress" value="Indirizzo*"/>
                        <TextInput id="restaurantAddress" type="text" name="address" class="mt-1 block w-full"
                            v-model="registrationForm.address" required/>
                        <div v-if="errors.address"><span class="text-red-500">{{ errors.address }}</span></div>
                    </div>
    
                    <div class="mt-4">
                        <InputLabel for="restaurantPIVA" value="Partita IVA*"/>
                        <TextInput id="restaurantPIVA" type="text" name="p_iva" class="mt-1 block w-full"
                            v-model="registrationForm.p_iva" required/>
                        <div v-if="errors.p_iva"><span class="text-red-500">{{ errors.p_iva }}</span></div>
                    </div>
                    <!-- Validazione client partita IVA -->
                    <div v-if="registrationForm.p_iva && registrationForm.p_iva.length !== 11"
                        class="text-red-500 text-sm">
                        Codice non valido: servono 11 caratteri.
                    </div>
    
                    <div class="mt-4">
                        <InputLabel for="restaurantImage" value="Immagine copertina*"/>
                        <input id="restaurantImage" type="file" name="image" accept="image/*" class="mt-1 block w-full border rounded-e-lg text-gray-400"
                            @change="handleImageChange">
                        <div v-if="errors.image"><span class="text-red-500">{{ errors.image }}</span></div>
                    </div>
    
                    <div class="mt-4">
                        <InputLabel for="restaurantDescription" value="Descrizione"/>
                        <textarea id="restaurantDescription" name="description" cols="30"
                            rows="3" v-model="registrationForm.description" class="mt-1 block w-full border border-gray-300 rounded-lg focus:border-[#FFA500] focus:ring-[#FFA500]"></textarea>
                        <div v-if="errors.description"><span class="text-red-500">{{ errors.description }}</span></div>
                    </div>
    
                    <div class="mt-4 w-full">
                        <InputLabel for="restaurantTypologies" value="Tipologie*"/>
                        <p class="text-start text-xs text-gray-400">Tieni premuto Ctrl o Cmd per selezionare più di una tipologia.</p>
                        <select id="restaurantTypologies" class="border-gray-300 rounded-lg focus:border-[#FFA500] focus:ring-[#FFA500] w-full" v-model="registrationForm.selectedTypologies"
                            multiple>
                            <option v-for="typology in typologies" :value="typology.id">{{ typology.typology_name }}
                            </option>
                        </select>
                        <div v-if="errors.selectedTypologies"><span class="text-red-500">{{ errors.selectedTypologies
                                }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-5 mt-4">
                    <PrimaryButton type="submit"
                        class="btn-orange">registrati</Primarybutton>
                </div>


            </form>
        </div>
    </GuestLayout>
</template>


<style scoped>
.bg-foto {
    padding-block: 100px;
    background-image: url(../../../../public/img/food-login.jpg);
    background-size: cover;
    background-repeat: no-repeat
}
/* select option:hover {
  background: #FFA500;
}
select option:-moz-focusring {
  background: #FFA500 !important;
} */
</style>