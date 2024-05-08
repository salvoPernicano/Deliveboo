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
        <div class="p-5 h-screen bg-gray-100">
            <h1 class="text-xl mb-2">I tuoi Ordini</h1>

            <div class="overflow-auto rounded-lg shadow hidden sm:block ">
                <table class="w-full">
                    <thead class="bg-white">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Numero Ordine</th>
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
                                <a href="#" class="font-bold hover:underline">#{{ order.id }}</a>
                            </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                <li v-for="dish in order.dishes" :key="dish.id" class="capitalize">
                                    {{ dish.name }} {{ dish.price }} €
                                </li>
                            </td>
                            <td class="p-1 text-sm text-gray-700 whitespace-nowrap">
                                <span class="p-1.5 text-xs font-medium capitalize tracking-wider">{{
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

            <!-- orders resposive -->
            <div v-for="order in props.orders" class="mb-4 p-3 rounded-lg shadow bg-white sm:hidden ">

                <div class="flex justify-between">
                    <div class="flex items-center">
                        <span class="flex-1 text-[18px] text-start font-bold"># {{ order.id }}</span>
                    </div>
                    <div>
                        <h6 class="font-extrabold text-black text-start"> {{ order.name }}</h6>
                    </div>
                </div>

                <div class="mt-4 flex justify-between ">

                    <div class="flex flex-col gap-2 justify-end">
                        <span v-for="dish in order.dishes" :key="dish.id" class="text-sm ">
                            • {{ dish.name }} {{ dish.price }}€
                        </span>
                        <span class="flex-1 text-[14px] text-start">{{ order.address }}</span>
                        <span class="text-black">{{ order.phone }}</span>
                        <span class="text-black">{{ order.email }}</span>
                    </div>

                </div>

                <div class="flex justify-start gap-3  mt-2">
                    <div class="flex flex-col w-full ">
                        <div class="flex">
                            <div class="flex flex-col w-full">

                                <div class="flex">

                                    <span class="">{{ order.name_doorbell }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



        </div>

    </AuthenticatedLayout>
</template>
