<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="sm:flex">
        <nav class="bg-white border-b border-gray-100 sm:h-screen sm:w-1/4">
            <!-- Primary Navigation Menu -->
            <div class="lg:px-8 h-full py-10 items-start">
                <div class="flex flex-col items-start justify-between max-sm:flex w-full h-full">
                    <div class="flex flex-col gap-5">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <Link :href="route('dashboard')">
                            <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                            </Link>
                            DeliveBoo
                        </div>

                        <!-- <div>
                            <h4 class="text-white">
                                {{ $page.props.auth.user.name }}
                            </h4>
                        </div> -->

                        <!-- Navigation Links -->
                        <div class="font-bold text-white flex flex-col gap-5 ">
                            <Link :href="route('dashboard')" class="flex items-center link-hover p-1">
                            <img src="../../../public/img/receipt.svg" class="h-10 w-10">
                            Ordini Ricevuti
                            </Link>
                            <Link :href="`/restaurant/${$page.props.auth.user.id}/dishes`"
                                class="flex items-center link-hover p-1">
                            <img src="../../../public/img/dish_plate.svg" class="h-10 w-10">
                            I tuoi piatti
                            </Link>

                            <Link :href="route('dashboard')" class="flex items-center link-hover p-1">
                            <img src="../../../public/img/stats.svg" class="h-10 w-10">
                            Statistiche
                            </Link>

                            <Link :href="`/restaurant/${$page.props.auth.user.id}/dishes/create`" class="py-5 px-1 rounded-lg bg-white text-[#F98F00] capitalize flex text-sm/[8px] h-8 gap-2 items-center">
                                Crea nuovo piatto
                                <img class="h-3 w-3" src="../../../public/img/PiuArancio.svg" width="30" alt="Icona" />
                            </Link>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center font-bold text-white">
                        <Link :href="route('logout')" class="flex items-center link-hover p-1">
                        <img src="../../../public/img/quit.svg" class="h-10 w-10">
                        Logout
                        </Link>
                        <!-- Settings Dropdown -->
                        <!-- <div class="ms-3 relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class=" inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            {{ $page.props.auth.user.name }}

                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

<template #content>
                                    <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Log Out
                                    </DropdownLink>
                                </template>
</Dropdown>
</div> -->
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
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
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </ResponsiveNavLink>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">
                            {{ $page.props.auth.user.name }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                            Log Out
                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <!-- <header class="bg-white shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header> -->

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>

</template>

<style scoped>
nav {
    background-color: #F98F00;
}

.link-hover:hover {
    background-color: #ffffff30;
    border-radius: 15px;
}
</style>
