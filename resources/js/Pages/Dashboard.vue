<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import { defineProps } from 'vue';

const props = defineProps({
    restaurants: Object,
    orders: Array
});


</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout :auth="authData">
        <!-- main dashboard  -->
        <div class="overflow-hidden w-full">

            <div class="px-3 py-4 flex justify-between ">
                <div>
                    <h4 class="">Bentornato {{ restaurants[0].name }}, </h4>
                </div>

                <div class="gap-3 flex w-80 justify-end ">
                    <div class="content-center items-center flex gap-2">
                        <Link :href="`/restaurant/${$page.props.restaurants[0].slug}/dishes/create`"
                            class="w-fit py-5 px-1 rounded-lg text-white bg-[#F98F00] capitalize font-semibold flex text-sm/[8px] h-8 gap-2 items-center">
                        Crea nuovo piatto
                        <img class="h-3 w-3" src="../../../public/img/PiuBianco.svg" width="30" alt="Icona" />
                        </Link>
                    </div>
                </div>
            </div>
            <!-- order -->
            <div class="p-3">
                <div class="p-3 rounded-lg bg-white shadow max-h-2/3 overflow-scroll">
                    <h4 class="font-bold pb-3">Ordini</h4>
                    <!-- table lapTop orders -->
                    <div class="flex ">
                        <table class="w-full">
                            <thead>
                                <tr class="flex px-1">
                                    <th class="flex-1 text-[14px] text-start">Numero Ordine</th>
                                    <th class="flex-1 text-[14px] text-start">Nome clinte</th>
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

            <!-- best selling dishes -->

            <div class="p-3 flex sm:gap-3 w-full rounded-lg">
                <div class="p-3 rounded-lg shadow w-full bg-white">
                    <div>
                        <h4 class="font-bold capitalize">i piatti più venduti</h4>
                        <span class="capitalize">questo mese</span>
                    </div>
                    <div class="flex">
                        <table class="flex flex-col w-96 mt-5">
                            <thead class="w-full">
                                <tr class="flex justify-between px-1">
                                    <th class="capitalize w-1/3 flex">piatti</th>
                                    <th class="w-1/3 flex">N. Venduti</th>
                                    <th class="capitalize w-1/3 flex">totale</th>
                                </tr>
                            </thead>
                            <tbody class="w-full">
                                <tr class="flex justify-between px-1">
                                    <td class="capitalize w-1/3">lasagne</td>
                                    <td class="w-1/3">10</td>
                                    <td class="w-1/3">$100</td>
                                </tr>
                                <div class=" bg-gray-100 rounded-lg px-1">
                                    <tr class="flex justify-between">
                                        <td class="capitalize w-1/3">sushi</td>
                                        <td class="w-1/3">20</td>
                                        <td class="w-1/3">$200</td>
                                    </tr>
                                </div>
                                <tr class="flex justify-between px-1">
                                    <td class="capitalize w-1/3">pizza</td>
                                    <td class="w-1/3">15</td>
                                    <td class="w-1/3">$150</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Link :href="`/restaurant/${$page.props.restaurants[0].slug}/dishes/create`"
                        class="w-fit py-5 px-2 rounded-lg text-white bg-[#F98F00] capitalize font-semibold flex text-sm/[8px] h-8 gap-2 items-center">
                    Crea nuovo piatto
                    <img class="h-3 w-3" src="../../../public/img/PiuBianco.svg" width="30" alt="Icona" />
                    </Link>


                </div>
                <!-- statistics 2 -->
                <div class=" hidden sm:flex w-full bg-white">
                    <div class="p-3 rounded-lg shadow w-full">
                        <div class="pb-3">
                            <h4 class="font-bold capitalize">Statistics</h4>
                        </div>
                        <div class="flex gap-2">
                            <div class=" flex flex-col border-gray-300 border-2 rounded-lg w-full">
                                <h6 class="p-2">This month</h6>
                                <div class=" flex flex-col items-center">
                                    <span class="text-orange-500 text-xl font-bold">
                                        1422
                                    </span>
                                    <span>Order</span>
                                    <span class="text-orange-500 mt-4 text-xl font-bold">
                                        32.347$
                                    </span>
                                    <span>Enter</span>

                                </div>

                            </div>
                            <div class=" flex flex-col  border-gray-300 border-2 rounded-lg w-full">
                                <h6 class="p-2">This year</h6>
                                <div class=" flex flex-col items-center">
                                    <span class="text-orange-500 text-xl font-bold">
                                        31.620
                                    </span>
                                    <span>Order</span>
                                    <span class="text-orange-500 mt-4 text-xl font-bold">
                                        432.347$
                                    </span>
                                    <span>Enter</span>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- statistics  -->
            <div class="p-3 sm:hidden">
                <div class="p-3 bg-white rounded-lg shadow sm:w-2/4">
                    <div class="pb-3">
                        <h4 class="font-bold capitalize">Statistics</h4>
                    </div>
                    <div class=" flex flex-col  rounded-lg shadow">
                        <h6 class="p-2">This month</h6>
                        <div class=" flex flex-col items-center">
                            <span class="text-orange-500 text-xl font-bold">
                                1422
                            </span>
                            <span>Order</span>
                            <span class="text-orange-500 mt-4 text-xl font-bold">
                                32.347$
                            </span>
                            <span>Enter</span>

                        </div>

                    </div>
                    <div class=" flex flex-col mt-3 rounded-lg shadow">
                        <h6 class="p-2">This year</h6>
                        <div class=" flex flex-col items-center">
                            <span class="text-orange-500 text-xl font-bold">
                                31.620
                            </span>
                            <span>Order</span>
                            <span class="text-orange-500 mt-4 text-xl font-bold">
                                432.347$
                            </span>
                            <span>Enter</span>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
