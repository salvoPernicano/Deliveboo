<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({ errors: Object, dish: Object });

const editDish = useForm({
    editDish: props.dish.id,
    restaurant_id: props.dish.restaurant_id,
    name: props.dish.name,
    price: props.dish.price,
    description: props.dish.description,
    category: props.dish.category,
    image: props.dish.image
});

const categories = ['Giapponese', 'Italiana', 'Cinese', 'Messicano', 'Indiana'];

function submit() {
    const dishId = editDish.id;
   router.put(`/restaurant/${props.dish.restaurant_id}/dishes/${props.dish.id}`, editDish);
}

const handleImageChange = (event) => {
    editDish.image = event.target.files[0];
};

</script>

<template>
    <AuthenticatedLayout>
        <form @submit.prevent="submit" id="editDishForm" class="flex flex-col text-black text-lg text-center gap-7" enctype="multipart/form-data">
          <div class="flex flex-col">
            <label class="text-white font-semibold text-xl p-2" for="">Modifica nome piatto</label>
            <input class="text-black" type="text" name="title" v-model="editDish.name">
            <div v-if="errors.name"><span class="text-red-700">{{ errors.name }}</span></div>
          </div>
          
          <!-- <div class="flex flex-col">
            <label class="text-white font-semibold text-xl p-2" for="">Modifica descrizione</label>
            <input class="text-black" type="text" name="title" v-model="editDish.description">
            <div v-if="errors.description"><span class="text-red-700">{{ errors.description }}</span></div>
          </div> -->
          
          <div class="flex flex-col">
            <label for="">Prezzo</label>
            <input class="text-black" type="number" step="0.01" name="price" v-model="editDish.price">
            <div v-if="errors.price"><span class="text-red-700">{{ errors.price }}</span></div>
          </div>
          
          <div class="flex flex-col">
            <label class="text-white font-semibold text-xl p-2" for="">Modifica immagine</label>
            <input type="file" name="image" accept="image/*" @change="handleImageChange">
            <div v-if="errors.image"><span class="text-red-700">{{ errors.image }}</span></div>
          </div>
          
          <div class="flex flex-col">
            <label class="text-white font-semibold text-xl p-2" for="">Modifica descrizione</label>
            <textarea class="text-black" name="description" cols="30" rows="10" v-model="editDish.description">{{ props.dish.description }}</textarea>
            <div v-if="errors.description"><span class="text-red-700">{{ errors.description }}</span></div>
          </div>
          
           <div class="flex flex-col">
            <label class="text-white font-semibold text-xl p-2" for="">Modifica la categoria del piatto</label>
            <select class="text-black" name="category" >
              <option v-for="category in categories" :value="category">{{ category }}</option>
            </select>
            <div v-if="errors.selectedCategories"><span class="text-red-700">{{ errors.selectedCategories }}</span></div>
          </div>
          <button form="editDishForm" type="submit" class="bg-blue-500 hover:bg-black hover:text-white text-white font-bold py-2 px-4 m-5 rounded-full uppercase">Salva modifiche</button>
          
        </form>
    </AuthenticatedLayout>
</template>