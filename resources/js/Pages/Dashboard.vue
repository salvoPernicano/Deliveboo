<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';



const showCardOrderTable = ref(false);
const toggleCardOrderTable = () => {
    showCardOrderTable.value = !showCardOrderTable.value;
};


</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout :auth="authData">
        <!-- main dashboard  -->
        <div class="overflow-hidden w-full">

            <div class="px-3 py-4 flex justify-between ">
                <div>
                    <h4>Bentornato, NomeAccount</h4>
                </div>

                <div class="gap-3 flex w-80 justify-end ">
                    <div class="content-center items-center flex gap-2">
                        <Link :href="`/restaurant/${$page.props.auth.user.id}/dishes/create`"
                            class="py-5 px-2 rounded-lg text-white bg-[#F98F00] font-semibold capitalize flex text-sm/[8px] h-8 gap-2 items-center">
                        Crea nuovo piatto
                        <img class="h-3 w-3" src="../../../public/img/PiuBianco.svg" width="30" alt="Icona" />
                        </Link>

                        <!-- <div class="hidden content-center sm:block">
                            <img class="h-5 w-5" src="../../../public/img/Bell.svg" alt="Icona" />
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- order -->
            <div class="p-3">
                <div class="p-3 rounded-lg bg-white shadow max-h-2/3 overflow-scroll">
                    <div>
                        <h4 class="font-bold">Orders</h4>
                    </div>
                    <!-- order card -->
                    <div class="  p-3 rounded-lg mt-3 sm:hidden">

                        <h5 class="rounded-lg  px-2">Order #1234</h5>

                        <div class="flex flex-col gap-2">
                            <div class="flex gap-2 bg-gray-100 rounded-lg px-2 mt-2">
                                <span>Name: Federico</span>
                                <span>Phone: 4633394763</span>
                            </div>
                            <span class="rounded-lg  px-2">Andress: Via le mani dal
                                Naso</span>
                        </div>

                        <div class="flex justify-start gap-3  mt-2">
                            <div class="flex flex-col w-full ">
                                <div class="flex">
                                    <div class="flex flex-col w-full p-2">
                                        <h6>Pizza</h6>
                                        <div class="flex justify-between">
                                            <span class="text-orange-500">Tot: $6.00</span>
                                            <span>Qty:2</span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mx-3 m-3 border border-orange-500">
                                <div class="flex ">
                                    <div class="flex flex-col w-full p-2">
                                        <h6>Pizza</h6>
                                        <div class="flex justify-between">
                                            <span class="text-orange-500"> Tot: $6.00</span>
                                            <span>Qty:17</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- secondo ordine di prova -->
                    <div class=" p-3 rounded-lg  mt-5 sm:hidden">

                        <h5 class="rounded-lg  px-2">Order #1234</h5>

                        <div class="flex flex-col gap-1">
                            <div class="flex gap-2 bg-gray-100 rounded-lg px-2 mt-2">
                                <span>Name: Federico</span>
                                <span>Phone: 4633394763</span>
                            </div>
                            <span class="rounded-lg  px-2">Andress: Via le mani dal
                                Naso</span>
                        </div>

                        <div class="flex justify-start gap-3  mt-2">
                            <div class="flex flex-col w-full ">
                                <div class="flex">

                                    <div class="flex flex-col w-full p-2">
                                        <h6>Pizza</h6>
                                        <div class="flex justify-between">
                                            <span class="text-orange-500">Tot: $6.00</span>
                                            <span>Qty:2</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- table lapTop orders -->
                    <div class="sm:flex hidden">
                        <table class="w-full">
                            <thead>
                                <tr class="flex px-1">
                                    <th class="flex-1 text-[14px] text-start  ">Numero Ordine</th>
                                    <th class="flex-1 text-[14px] text-start   ">Nome</th>
                                    <th class="flex-1 text-[14px] text-start   ">Indirizzo</th>
                                    <th class="flex-1 text-[14px] text-start   ">Campanello</th>
                                    <th class="flex-1 text-[14px] text-start   ">Mail</th>
                                    <th class="flex-1 text-[14px] text-end   ">Telefono</th>
                                    <th class="flex-1 text-[14px] text-end   ">Totale</th>
                                </tr>


                            </thead>
                            <tbody>
                                <tr class="bg-gray-100 rounded-lg flex mt-2 px-1">
                                    <td class="flex flex-1 gap-2 text-[12px] text-start relative"
                                        @click="toggleCardOrderTable">
                                        <img v-if="!showCardOrderTable" height="10" width="10" class=""
                                            src="../../../public/img/Arrow2.svg" alt="">
                                        <img v-else height="16" width="16 " class=""
                                            src="../../../public/img/down_arrow.svg" alt="">
                                        001
                                    </td>
                                    <td class="flex-1 text-[14px] text-start">Mario Rossi</td>
                                    <td class="flex-1 text-[14px] text-start">Via Roma 123</td>
                                    <td class="flex-1 text-[14px] text-start">Campanello 1</td>
                                    <td class="flex-1 text-[14px] text-start">mario@example.com</td>
                                    <td class="flex-1 text-[14px] text-end">1234567890</td>
                                    <td class="flex-1 text-[14px] text-end">$50.00</td>
                                </tr>
                                <tr>
                                    <td>
                                        <!-- card orders table -->
                                        <div v-if="showCardOrderTable"
                                            :class="{ 'hidden': !showCardOrderTable, 'block': showCardOrderTable }"
                                            class="rounded-lg mt-2 flex justify-end ">

                                            <div class=" w-[60%]">

                                                <div class="flex justify-start gap-3  mt-2">
                                                    <div class="flex flex-col w-full ">

                                                        <div class="flex px-1 mb-2">
                                                            <div class="flex  w-full justify-between">
                                                                <span class="text-[13px]">Qty:17</span>
                                                                <h6 class="w-[230px] text-[13px]">Pizza</h6>
                                                                <span class="text-[13px]">$6.00</span>
                                                            </div>
                                                        </div>

                                                        <div class="flex bg-gray-100 rounded-lg px-1">
                                                            <div class="flex  w-full justify-between">
                                                                <span class="text-[13px]">Qty:17</span>
                                                                <h6 class="w-[230px] text-[13px]">Pizza</h6>
                                                                <span class="text-[13px]">$6.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </td>
                                </tr>
                                <tr class=" bg-gray-100 rounded-lg flex mt-2 px-1">
                                    <td class="flex flex-1 gap-2 text-[12px] text-start ">
                                        <img height="10" width="10" class="" src="../../../public/img/Arrow2.svg"
                                            alt=""> 002
                                    </td>
                                    <td class="flex-1 text-[14px] text-start  ">Mario Rossi</td>
                                    <td class="flex-1 text-[14px]  text-start  ">Via Roma 123</td>
                                    <td class="flex-1 text-[14px]  text-start  ">Campanello 1</td>
                                    <td class="flex-1 text-[14px]  text-start  ">mario@example.com</td>
                                    <td class="flex-1 text-[14px]  text-end">1234567890</td>
                                    <td class="flex-1 text-[14px]  text-end  ">$50.00</td>
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
                    <Link :href="`/restaurant/${$page.props.auth.user.id}/dishes/create`"
                        class="w-fit py-5 px-2 rounded-lg text-white bg-[#F98F00] font-semibold capitalize flex text-sm/[8px] h-8 gap-2 items-center mt-2">
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
            <div class="p-3 sm:hidden bg-white">
                <div class="p-3  rounded-lg shadow sm:w-2/4">
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


