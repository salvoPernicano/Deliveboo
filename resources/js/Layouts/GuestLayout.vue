<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';


</script>

<template>
    <div class="flex sm:justify-start items-center pt-6 sm:pt-0 fixed top-0 w-full">
        <div class="mx-auto lg:w-10/12">
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
            
            
        </div>
    </div>
    <slot />
</template>
