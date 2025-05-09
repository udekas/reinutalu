<script setup></script>

<template>
    <header class="bg-opacity-90 fixed z-40 w-full bg-white shadow-md" :class="{ 'mt-10': showAuthNav }">
        <nav class="container mx-auto flex items-center justify-between py-4 pr-8">
            <div class="logo text-primary flex items-center text-2xl font-bold">
                <i class="fas fa-horse mr-2"></i>
                <a href="welcome">Reinu Ratsatalu</a>
            </div>

            <div class="hidden items-center space-x-4 md:flex">
                <a href="services" class="rounded-md px-4 py-2 transition hover:bg-gray-100">Teenused</a>
                <a href="about" class="rounded-md px-4 py-2 transition hover:bg-gray-100">Meist</a>
                <a href="gallery" class="rounded-md px-4 py-2 transition hover:bg-gray-100">Galerii</a>
                <a href="login" class="rounded-md px-4 py-2 transition hover:bg-gray-100">Log in</a>
                <a href="register" class="rounded-md px-4 py-2 transition hover:bg-gray-100">Register</a>
            </div>

            <!-- Mobile menu button -->
            <div class="burger cursor-pointer md:hidden" @click="toggleMobileMenu">
                <div class="line1 bg-primary my-1.5 h-0.5 w-6 transition"></div>
                <div class="line2 bg-primary my-1.5 h-0.5 w-6 transition"></div>
                <div class="line3 bg-primary my-1.5 h-0.5 w-6 transition"></div>
            </div>

            <!-- Mobile menu (hidden on desktop) -->
            <ul
                class="nav-links absolute top-20 left-0 w-full bg-white px-4 py-4 transition-all duration-500 ease-out md:hidden"
                :class="{ 'active pointer-events-auto': mobileMenuOpen, 'pointer-events-none': !mobileMenuOpen }"
            >
                <li class="my-2"><a href="welcome" class="hover:text-primary transition">Avaleht</a></li>
                <li class="my-2"><a href="services" class="hover:text-primary transition">Teenused</a></li>
                <li class="my-2"><a href="about" class="hover:text-primary transition">Meist</a></li>
                <li class="my-2"><a href="gallery" class="hover:text-primary transition">Galerii</a></li>
                <li class="my-2"><a href="contact" class="hover:text-primary transition">Kontakt</a></li>
            </ul>
        </nav>
    </header>
</template>
