<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
const mobileMenuOpen = ref(false);
const toggleMobileMenu = () => {
    mobileMenuOpen.value = !mobileMenuOpen.value;
};

</script>

<template>
    <header class="bg-opacity-90 fixed z-40 w-full px-4 bg-white shadow-md">
        <nav class="container mx-auto flex items-center justify-between  px-4 py-4 pr-8">
            <div class="logo text-primary flex items-center text-2xl font-bold">
                <a href="/">Reinu Ratsatalu</a>
            </div>

            <div class="hidden items-center space-x-4 md:flex">
                <a href="services" class="rounded-md px-4 py-2 transition hover:bg-gray-100">Teenused</a>
                <a href="about" class="rounded-md px-4 py-2 transition hover:bg-gray-100">Meist</a>
                <a href="gallery" class="rounded-md px-4 py-2 transition hover:bg-gray-100">Galerii</a>
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Minu konto
                </Link>
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                    >
                        Logi sisse
                    </Link>
                </template>
            </div>

            <!-- Mobile menu button -->
            <div class="burger cursor-pointer md:hidden" @click="toggleMobileMenu">
                <div class="line1 bg-primary my-1.5 h-0.5 w-6 transition"></div>
                <div class="line2 bg-primary my-1.5 h-0.5 w-6 transition"></div>
                <div class="line3 bg-primary my-1.5 h-0.5 w-6 transition"></div>
            </div>

            <!-- Mobile menu (hidden on desktop) -->
            <ul v-if="mobileMenuOpen"
                class="nav-links absolute top-20 left-0 w-full bg-white px-4 py-4 transition-all duration-500 ease-out md:hidden"
                :class="{ 'active pointer-events-auto': mobileMenuOpen, 'pointer-events-none': !mobileMenuOpen }"
            >
                <li class="my-2"><a href="/" class="hover:text-primary transition">Avaleht</a></li>
                <li class="my-2"><a href="services" class="hover:text-primary transition">Teenused</a></li>
                <li class="my-2"><a href="about" class="hover:text-primary transition">Meist</a></li>
                <li class="my-2"><a href="gallery" class="hover:text-primary transition">Galerii</a></li>
                <li class="my-2"><a href="login" class="hover:text-primary transition">Logi sisse</a></li>
            </ul>
        </nav>
    </header>
</template>
