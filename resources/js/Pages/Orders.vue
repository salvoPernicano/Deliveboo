<script setup>
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({

    orders: Array
});


</script>

<style></style>
<template>

    <Head title="Crea piatto"></Head>
    <AuthenticatedLayout>

        <div class="p-3">
            <div class="p-3 rounded-lg shadow max-h-2/3 overflow-scroll">
                <h4 class="font-bold pb-3">Ordini</h4>
                <!-- Lista degli ordini -->
                <ul class="divide-y divide-gray-200">
                    <li v-for="order in props.orders" :key="order.id" class="py-4">
                        <div class="flex justify-between items-center">
                            <div class="text-sm font-medium text-gray-900">
                                Ordine #{{ order.id }}
                            </div>
                            <!-- Aggiungi qui eventuali azioni per l'ordine -->
                        </div>
                        <div class="mt-2">
                            <div class="text-sm text-gray-500">{{ order.name }}</div>
                            <div class="text-sm text-gray-500">{{ order.address }}</div>
                            <div class="text-sm text-gray-500">{{ order.name_doorbell }}</div>
                            <div class="text-sm text-gray-500">{{ order.email }}</div>
                            <div class="text-sm text-gray-500">{{ order.phone }}</div>
                            <!-- Lista dei piatti ordinati -->
                            <ul class="mt-2">
                                <li v-for="dish in order.dishes" :key="dish.id" class="text-sm text-gray-500">
                                    - {{ dish.name }} ({{ dish.price }}€)
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>



    </AuthenticatedLayout>
</template>
