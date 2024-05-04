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
    <header id="color" class="flex justify-start items-center pt-0 fixed top-0 w-full z-10">
        <div class="sm:mx-auto lg:w-10/12 flex items-center gap-10">
            <Link href="/">
                <img id="logo-header" src="../../../public/img/logo-deliveBoo.svg" alt="logo deliveBoo">
            </Link>

            <Link href="/" class="text-white hover:text-black font-bold hidden sm:block">Home</Link>
        </div>
    </header>
    <main>
            <slot />
        </main>

    <footer class="w-full text-white">
        <div class="w-10/12 mx-auto py-4 md:py-10">
            <div class="md:flex-column flex flex-wrap md:gap-10 justify-between">
                <figure>
                    <Link href="/">
                        <img id="logo-footer" src="../../../public/img/logo-deliveBoo.svg" alt="logo deliveBoo">
                    </Link>
                </figure>
                <div class="w-1/2 px-2 mb-6 md:mb-0 md:px-0" v-for="(item) in 3">
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
            <hr class="my-2">
            <div>
                © 2024 DeliveBoo - Termini & Condizioni - Cookie & Privacy
            </div>
        </div>
    </footer>
</template>

<style scoped>
header {
    background-color: transparent;
    height: 80px;
}
#logo-header {
    height: 70px;
}
#logo-footer {
    height: 120px;
}
footer {
    display: flex;
    align-items: center;
    background-color: #F98F00;
}
</style>
