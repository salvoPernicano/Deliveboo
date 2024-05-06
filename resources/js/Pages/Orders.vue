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
            <div class="p-3 rounded-lg  shadow max-h-2/3 overflow-scroll">
                <h4 class="font-bold pb-3">Ordini</h4>
                <!-- table lapTop orders -->
                <div class="flex ">
                    <table class="w-full">
                        <thead>
                            <tr class="flex px-1">
                                <th class="flex-1 text-[14px] text-start">Numero Ordine</th>
                                <th class="flex-1 text-[14px] text-start">Nome cliente</th>
                                <th class="flex-1 text-[14px] text-start">Indirizzo</th>
                                <th class="flex-1 text-[14px] text-start">Campanello</th>
                                <th class="flex-1 text-[14px] text-start">Mail</th>
                                <th class="flex-1 text-[14px] text-end">Telefono</th>

                            </tr>


                        </thead>
                        <tbody>
                            <tr v-for="order in props.orders" class="bg-gray-100 rounded-lg flex mt-2 px-1">
                                <td class="flex flex-1 gap-2 text-[12px] text-start relative">
                                    {{ order.id }}
                                </td>
                                <td class="flex-1 text-[14px] text-start">{{ order.name }}</td>
                                <td class="flex-1 text-[14px] text-start">{{ order.address }}</td>
                                <td class="flex-1 text-[14px] text-start">{{ order.name_doorbell }}</td>
                                <td class="flex-1 text-[14px] text-start">{{ order.email }}</td>
                                <td class="flex-1 text-[14px] text-end">{{ order.phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
