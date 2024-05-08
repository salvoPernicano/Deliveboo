<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import { defineProps } from 'vue';
import Chart from 'chart.js/auto';
import { onMounted } from 'vue';

onMounted(() => {
    (async function () {
        const data = [
            { month: 'Gennaio', count: 10 },
            { month: ' Febbraio', count: 20 },
            { month: 'Marzo', count: 15 },
            { month: 'Aprile', count: 25 },
            { month: 'Maggio', count: 22 },
            { month: 'Giugno', count: 0 },
            { month: 'Luglio', count: 0 },
            { month: 'Agosto', count: 0 },
            { month: 'Settembre', count: 0 },
            { month: ' Ottobre', count: 0 },
            { month: 'Novembre', count: 0 },
            { month: 'Dicembre', count: 0 },
        ];

        const mayOrders = props.orders.filter(order => {
            const orderDate = new Date(order.created_at);
            return orderDate.getMonth() === 4;
        });

        console.log(mayOrders);


        const mayIndex = data.findIndex(monthData => monthData.month === 'Maggio');


        if (mayIndex !== -1) {
            data[mayIndex].count = mayOrders.length;
        }

        console.log(data);

        new Chart(
            document.getElementById('acquisitions'),
            {
                type: 'bar',
                options: {
                    animation: true,
                    plugins: {
                        legend: {
                            display: true,
                        },
                        tooltip: {
                            enabled: true,
                        }
                    }
                },
                data: {
                    labels: data.map(row => row.month),
                    datasets: [
                        {
                            label: 'Totali ordini di questo mese:',
                            backgroundColor: '#F98F00',
                            data: data.map(row => row.count)
                        }
                    ]
                }
            }
        );
    })();


});
const props = defineProps({
    restaurants: Object,
    orders: Array
});


</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout :auth="authData">
        <!-- main dashboard  -->
        <div class="overflow-hidden w-full p-3">

            <div class="px-3 py-4 flex justify-between ">
                <div>
                    <h4>Bentornato {{ restaurants[0].name }}, </h4>
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
            <div class="sm:mb-3">
                <div class="p-3 rounded-lg  shadow max-h-2/3 overflow-scroll bg-white hidden sm:block">
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
                                        # {{ order.id }}
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

            <!-- resposive orders -->
            <div v-for="order in props.orders"  class="mb-3  p-3 rounded-lg shadow bg-white sm:hidden ">

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

            <!-- best selling dishes -->

            <div class=" mt-3 sm:mt-0 flex sm:gap-3 w-full rounded-lg ">
                <div class="p-3 rounded-lg shadow w-full bg-white ">
                    <div>
                        <h4 class="font-bold capitalize">i piatti più venduti</h4>
                        <span class="capitalize">questo mese</span>
                    </div>
                    <div class="flex w-full">
                        <table class="flex flex-col w-full mt-5">
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
                                    <td class="w-1/3">100€</td>
                                </tr>
                                <div class=" bg-gray-100 rounded-lg px-1">
                                    <tr class="flex justify-between">
                                        <td class="capitalize w-1/3">sushi</td>
                                        <td class="w-1/3">20</td>
                                        <td class="w-1/3">200€</td>
                                    </tr>
                                </div>
                                <tr class="flex justify-between px-1">
                                    <td class="capitalize w-1/3">pizza</td>
                                    <td class="w-1/3">15</td>
                                    <td class="w-1/3">150€</td>
                                </tr>
                                <div class=" bg-gray-100 rounded-lg px-1">
                                    <tr class="flex justify-between">
                                        <td class="capitalize w-1/3">Spezzatino</td>
                                        <td class="w-1/3">11</td>
                                        <td class="w-1/3">245€</td>
                                    </tr>
                                </div>
                                <tr class="flex justify-between px-1">
                                    <td class="capitalize w-1/3">Pollo al Curry</td>
                                    <td class="w-1/3">36</td>
                                    <td class="w-1/3">160€</td>
                                </tr>
                                <div class=" bg-gray-100 rounded-lg px-1">
                                    <tr class="flex justify-between">
                                        <td class="capitalize w-1/3">Cotoletta impanata</td>
                                        <td class="w-1/3">45</td>
                                        <td class="w-1/3">50€</td>
                                    </tr>
                                </div>
                                <tr class="flex justify-between px-1">
                                    <td class="capitalize w-1/3">Carbonara</td>
                                    <td class="w-1/3">15</td>
                                    <td class="w-1/3">150€</td>
                                </tr>
                                <div class=" bg-gray-100 rounded-lg px-1">
                                    <tr class="flex justify-between">
                                        <td class="capitalize w-1/3">Nighiri</td>
                                        <td class="w-1/3">25</td>
                                        <td class="w-1/3">175€</td>
                                    </tr>
                                </div>
                                <tr class="flex justify-between px-1">
                                    <td class="capitalize w-1/3">Tiger Roll</td>
                                    <td class="w-1/3">11</td>
                                    <td class="w-1/3">150€</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Link :href="`/restaurant/${$page.props.restaurants[0].slug}/dishes/create`"
                        class="w-fit py-5 px-2 mt-10 rounded-lg text-white bg-[#F98F00] capitalize font-semibold flex text-sm/[8px] h-8 gap-2 items-center ">
                    Crea nuovo piatto
                    <img class="h-3 w-3" src="../../../public/img/PiuBianco.svg" width="30" alt="Icona" />
                    </Link>


                </div>
                <!-- statistics 2 -->
                <div class=" hidden sm:flex sm:flex-col w-full bg-gray-100 ">
                    <div class="p-3 rounded-lg shadow w-full bg-white ">
                        <div class="pb-3">
                            <h4 class="font-bold capitalize">Statistiche</h4>
                        </div>
                        <div class="flex gap-2">
                            <div class=" flex flex-col border-gray-300 border-2 rounded-lg w-full">
                                <h6 class="p-2">Questo mese</h6>
                                <div class=" flex flex-col items-center">
                                    <span class="text-orange-500 text-xl font-bold">
                                        1422€
                                    </span>
                                    <span>Ordini</span>
                                    <span class="text-orange-500 mt-4 text-xl font-bold">
                                        32.347€
                                    </span>
                                    <span>Entrate</span>

                                </div>

                            </div>
                            <div class=" flex flex-col  border-gray-300 border-2 rounded-lg w-full">
                                <h6 class="p-2">Quest'anno</h6>
                                <div class=" flex flex-col items-center">
                                    <span class="text-orange-500 text-xl font-bold">
                                        31.620€
                                    </span>
                                    <span>Ordini</span>
                                    <span class="text-orange-500 mt-4 text-xl font-bold">
                                        432.347€
                                    </span>
                                    <span>Entrate</span>
                                </div>
                            </div>

                        </div>
                        <div class="mt-10 bg-white flex justify-center" style=" height: 290px;"><canvas
                                id="acquisitions"></canvas></div>
                    </div>
                </div>
            </div>

            <!-- statistics  -->
            <div class="mt-3 sm:mt-0 sm:hidden">
                <div class="p-3 bg-white rounded-lg shadow sm:w-2/4">
                    <div class="pb-3">
                        <h4 class="font-bold capitalize">Statistiche</h4>
                    </div>
                    <div class=" flex flex-col  rounded-lg shadow">
                        <h6 class="p-2">Questo mese</h6>
                        <div class=" flex flex-col items-center">
                            <span class="text-orange-500 text-xl font-bold">
                                1422€
                            </span>
                            <span>Ordini</span>
                            <span class="text-orange-500 mt-4 text-xl font-bold">
                                32.347€
                            </span>
                            <span>Entrate</span>

                        </div>

                    </div>
                    <div class=" flex flex-col mt-3 rounded-lg shadow">
                        <h6 class="p-2">Quest'annp</h6>
                        <div class=" flex flex-col items-center">
                            <span class="text-orange-500 text-xl font-bold">
                                31.620€
                            </span>
                            <span>Ordini</span>
                            <span class="text-orange-500 mt-4 text-xl font-bold">
                                432.347€
                            </span>
                            <span>Entrate</span>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
<style>
#acquisitions {
    width: 85% !important;
}
</style>
