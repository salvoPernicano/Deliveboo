<script setup>
import { ref } from 'vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

</script>

<template>
    <div class="sm:flex h-screen w-full ">
        <nav class="bg-white border-b border-gray-100  sm:w-64">
            <!-- Primary Navigation Menu -->
            <div class="lg:px-8 h-full py-2 items-start">
                <div class="flex sm:flex-col  max-sm:flex  w-full sm:h-full sm:justify-between">
                    <div class="flex flex-col items-center sm:items-start w-full gap-5 ">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center  w-full gap-4 justify-center">
                            <div class="w-60">
                                <Link :href="route('dashboard')">
                                <img id="logo-nav" src="../../../public/img/logo-deliveBoo.svg" alt="logo deliveBoo">
                                </Link>

                            </div>
                            <!-- Hamburger -->
                            <div class="flex items-center sm:hidden rounded-xl ">
                                <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                    <svg class="h-6 w-6" stroke="white" viewBox="0 0 24 24">
                                        <path :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16" />
                                        <path :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Navigation Links -->
                        <div class="font-bold text-white flex flex-col gap-5 sm:gap-2 ">

                            <div class="flex gap-2 justify-start sm:flex-col">
                                <Link :href="route('dashboard')" class="flex items-center link-hover ">
                                <img src="../../../public/img/receipt.svg" class="h-10 w-10">
                                Ordini Ricevuti
                                </Link>
                                <Link :href="route('dishes.index')" class="flex items-center link-hover " method="get"
                                    as="button">
                                <img src="../../../public/img/dish_plate.svg" class="h-10 w-10">
                                I tuoi piatti
                                </Link>

                            </div>


                            <div class="flex gap-2 justify-start sm:flex-col">
                                <Link :href="route('dashboard')" class="flex items-center link-hover p-1 sm:p-0">
                                <img src="../../../public/img/stats.svg" class="h-10 w-10">
                                Statistiche
                                </Link>
                                <div class="flex p-1">
                                    <Link :href="`/restaurant/${$page.props.auth.user.id}/dishes/create`"
                                        class="py-5 px-1 rounded-lg bg-white text-[#F98F00] capitalize flex text-sm/[8px] h-8 gap-2 items-center">
                                    Crea nuovo piatto
                                    <img class="h-3 w-3" src="../../../public/img/PiuArancio.svg" width="30"
                                        alt="Icona" />
                                    </Link>

                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center font-bold text-white">
                        <Link :href="route('logout')" class="flex items-center link-hover p-1 " method="post"
                            as="button">
                        <img src="../../../public/img/quit.svg" class="h-10 w-10">
                        Logout
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button"
                            class="text-white capitalize">
                            Log Out
                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="w-full overflow-scroll bg-gray-100">
            <slot />
        </main>
    </div>

</template>

<style scoped>
nav {
    background-color: #F98F00;
}

#logo-nav {
    height: 60px;
}

.link-hover:hover {
    background-color: #ffffff30;
    border-radius: 15px;
}
</style>
