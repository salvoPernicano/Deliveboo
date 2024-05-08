<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link, router } from '@inertiajs/vue3';
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
    (async function () {
        const data = [
            { month: 'Lasagna', count: 10 },
            { month: 'Carbonara', count: 20 },
            { month: 'Sashimi', count: 15 },
            { month: 'Pollo e Patate', count: 25 },
            { month: 'Pizza', count: 22 },
            { month: 'Guacamole', count: 17 },
            { month: 'Nighiri', count: 0 },
            { month: 'Tikka Masala', count: 2 },
            { month: 'Riso Cantonese', count: 32 },

        ];

        const colors = [
            '#FF5733',
            '#3A88EC',
            '#5FA03A',
            '#AC672B',
            '#FFD700',
            '#AF50C5',
            '#2F4F4F',
            '#FFA07A',
            '#4169E1'
        ]

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
            document.getElementById('doughnut'),
            {
                type: 'doughnut',
                data: {
                    labels: data.map(row => row.month),
                    datasets: [
                        {
                            label: 'Piatti Venduti',
                            data: data.map(row => row.count),
                            backgroundColor: colors.slice(0, data.length)
                        }
                    ]
                },
                options: {
                    animation: {
                        animateRotate: true
                    }
                }
            }
        );
    })();
});
const props = defineProps({
    restaurants: Object,
    orders: Array,
    dishes: Array
});


</script>

<template>

    <Head title="Statische Ordini" />

    <AuthenticatedLayout :auth="authData">
        <!-- main dashboard  -->
        <div class="overflow-hidden w-full">

            <div class="px-3 py-4 flex justify-between ">
                <div>
                    <h4 class="">{{ restaurants.name }}</h4>
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


            <div class="p-3 flex flex-col">
                <div
                    class="p-3 rounded-lg  shadow max-h-2/3 overflow-scroll bg-white flex flex-col justify-center items-center">
                    <div class="flex content-start w-full">
                        <h4 class="font-bold pb-3 flex justify-start">Andamento vendite</h4>
                    </div>


                    <div class="flex gap-4 content-start w-full">
                        <div class="flex gap-4 border rounded-lg p-3">
                            <span>Ordini Totali</span>
                            <span class="font-bold text-orange-500">31.620€</span>
                        </div>
                        <div class="flex gap-4 border rounded-lg p-3">
                            <span>Incassi Totali</span>
                            <span class="font-bold text-orange-500">432.247€</span>
                        </div>
                    </div>
                    <div class="flex justify-center  bg-white" style="width: 800px; height: 350px; "><canvas
                            id="acquisitions"></canvas></div>
                    <!-- table lapTop orders -->

                </div>
                <div class="flex mt-5 justify-center flex-col">
                    <div class="p-3 rounded-lg shadow w-full bg-white">
                        <div>
                            <h4 class="font-bold capitalize">i piatti più venduti</h4>
                            <span class="capitalize">questo mese</span>
                        </div>

                        <div class="flex flex-col sm:flex-row">
                            <div class=" w-full">
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
                                <Link :href="`/restaurant/${$page.props.restaurants[0].slug}/dishes/create`"
                                    class="w-fit py-5 px-2 mt-10 rounded-lg text-white bg-[#F98F00] capitalize font-semibold flex text-sm/[8px] h-8 gap-2 items-center ">
                                Crea nuovo piatto
                                <img class="h-3 w-3" src="../../../public/img/PiuBianco.svg" width="30" alt="Icona" />
                                </Link>
                            </div>

                            <div class="flex sm:justify-center bg-white mt-3 sm:mt-0"
                                style="width: 900px; height: 350px; "><canvas id="doughnut"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
<style>
.shadow {
    box-shadow: 0px 0px 8.0px rgba(0, 0, 0, 0.25);

}
</style>
