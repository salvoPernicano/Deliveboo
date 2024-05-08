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
        <!-- <div class="w-full p-5 overflow-x-auto">
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border-gray-600 border">
                    <thead>
                        <tr>
                            <th class="font-bold text-left border-gray-600 border px-4 py-2">Ordine</th>
                            <th class="font-bold text-left border-gray-600 border px-4 py-2">Nome</th>
                            <th class="font-bold text-left border-gray-600 border px-4 py-2">Indirizzo</th>
                            <th class="font-bold text-left border-gray-600 border px-4 py-2">Campanello</th>
                            <th class="font-bold text-left border-gray-600 border px-4 py-2">Email</th>
                            <th class="font-bold text-left border-gray-600 border px-4 py-2">Telefono</th>
                            <th class="font-bold text-left border-gray-600 border px-4 py-2">Piatti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in props.orders" :key="order.id">
                            <td class="border-gray-600 border px-4 py-2">{{ order.id }}</td>
                            <td class="border-gray-600 border px-4 py-2">{{ order.name }}</td>
                            <td class="border-gray-600 border px-4 py-2">{{ order.address }}</td>
                            <td class="border-gray-600 border px-4 py-2">{{ order.name_doorbell }}</td>
                            <td class="border-gray-600 border px-4 py-2">{{ order.email }}</td>
                            <td class="border-gray-600 border px-4 py-2">{{ order.phone }}</td>
                            <td class="border-gray-600 border px-4 py-2">
                                <ul>
                                    <li v-for="dish in order.dishes" :key="dish.id" class="text-sm text-red-700">
                                        {{ dish.name }} ({{ dish.price }}€)
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> -->

        <div class="p-5 h-screen bg-gray-100">
            <h1 class="text-xl mb-2">I tuoi Ordini</h1>

            <div class="overflow-auto rounded-lg shadow hidden md:block">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">No.</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Piatti</th>
                            <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">Nome</th>
                            <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">Indirizzo</th>
                            <th class="w-32 p-3 text-sm font-semibold tracking-wide text-left">Campanello</th>
                            <th class="w-32 p-3 text-sm font-semibold tracking-wide text-left">Email</th>
                            <th class="w-32 p-3 text-sm font-semibold tracking-wide text-left">Telefono</th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="bg-white" v-for="order in props.orders" :key="order.id">
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                <a href="#" class="font-bold text-blue-500 hover:underline">#{{ order.id }}</a>
                            </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                <li v-for="dish in order.dishes" :key="dish.id" class="text-sm text-red-700">
                                    {{ dish.name }} ({{ dish.price }}€)
                                </li>
                            </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                <span class="p-1.5 text-xs font-medium uppercase tracking-wider">{{
                            order.name }}</span>
                            </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ order.address }}</td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ order.name_doorbell }}</td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ order.email }}</td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ order.phone }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
                <div class="bg-white space-y-3 p-4 rounded-lg shadow" v-for="order in props.orders" :key="order.id">
                    <div class="flex items-center space-x-2 text-sm">
                        <div>
                            <a href="#" class="text-blue-500 font-bold hover:underline">{{ order.id }}</a>
                        </div>

                        <div>
                            <span class="p-1.5 text-xs font-medium uppercase tracking-wider">{{ order.email }}</span>
                        </div>
                        <div>
                            <span class="p-1.5 text-xs font-medium uppercase tracking-wider">{{
                            order.name }}</span>
                        </div>
                    </div>
                    <div class="text-sm text-gray-700">
                        <li v-for="dish in order.dishes" :key="dish.id" class="text-sm text-red-700">
                            {{ dish.name }} ({{ dish.price }}€)
                        </li>
                    </div>
                    <div class="text-sm font-medium">
                        <span class="text-black">{{ order.address }}</span>, <span class="text-gray-500">campanello: {{
                            order.name_doorbell
                        }}</span>
                    </div>
                    <div class="text-sm font-medium">
                        <span class="text-black">{{ order.phone }}</span>
                    </div>
                </div>


            </div>
        </div>

    </AuthenticatedLayout>
</template>
