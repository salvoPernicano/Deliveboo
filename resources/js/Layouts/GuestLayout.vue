<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';

// Change header color on scroll
function headerColor() {
    const header = document.getElementById("color");
    const scrolledPixels = window.scrollY;

    if (scrolledPixels >= 400) {
        header.style.backgroundColor = "#F98F00";
    } else if (scrolledPixels < 400) {
        header.style.backgroundColor = "";
    }
}
// Add event listener for the scroll event
window.addEventListener("scroll", headerColor);

// Footer menu
const footerMenu = [
    { name: "Chi siamo" },
    { name: "Ristoranti" },
    { name: "Lavora con noi" },
    { name: "Altro" }
];
</script>

<template>
    <header id="color" class="flex sm:justify-start items-center pt-6 sm:pt-0 fixed top-0 w-full">
        <div class="mx-auto lg:w-10/12 flex items-center gap-10">
            <Link href="/" class="flex items-center">
            <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            DeliveBoo
            </Link>

            <Link href="/" class="text-white hover:text-black font-bold">Home</Link>
        </div>
    </header>
    <slot />

    <footer class="">
        <div class="lg:w-10/12 mx-auto py-10 text-white">
            <div class="flex-column md:flex gap-10 justify-between">
                <figure>
                    <Link href="/" class="flex items-center">
                    <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
                    DeliveBoo
                    </Link>
                </figure>
                <div v-for="(item) in 3">
                    <h6>
                        Scopri DeliveBoo
                    </h6>
                    <ul>
                        <li v-for="(item, index) in footerMenu" :key="index" class="my-2 hover:text-black">
                            {{ item.name }}
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="my-5">
            <div>
                © 2024 DeliveBoo - Termini & Condizioni - Cookie & Privacy
            </div>
        </div>
    </footer>
</template>

<style scoped>
footer {
    background-color: #FF6900;
}
</style>