<script setup lang="ts">
import Calendar from '@/components/Calendar.vue';
</script>
<template>
    <div class="font-sans text-gray-800">
        <header class="bg-opacity-90 fixed z-40 w-full bg-white shadow-md" :class="{ 'mt-10': showAuthNav }">
            <nav class="container mx-auto flex items-center justify-between px-4 py-4">
                <div class="logo text-primary flex items-center text-2xl font-bold">
                    <i class="fas fa-horse mr-2"></i>
                    <span>Reinu Ratsatalu</span>
                </div>

                <div class="hidden items-center space-x-4 md:flex">
                    <a href="'teenused'" class="rounded-md px-4 py-2 transition hover:bg-gray-100">Teenused</a>
                    <a href="about.html" class="rounded-md px-4 py-2 transition hover:bg-gray-100">Meist</a>
                    <a href="/gallery" class="rounded-md px-4 py-2 transition hover:bg-gray-100">Galerii</a>
                    <a href="/login" class="rounded-md px-4 py-2 transition hover:bg-gray-100">Log in</a>
                    <a href="/register" class="rounded-md px-4 py-2 transition hover:bg-gray-100">Register</a>
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
                    <li class="my-2"><a href="index.html" class="hover:text-primary transition">Avaleht</a></li>
                    <li class="my-2"><a href="#teenused" class="hover:text-primary transition">Teenused</a></li>
                    <li class="my-2"><a href="about.html" class="hover:text-primary transition">Meist</a></li>
                    <li class="my-2"><a href="Gallery.vue" class="hover:text-primary transition">Galerii</a></li>
                    <li class="my-2"><a href="#kontakt" class="hover:text-primary transition">Kontakt</a></li>
                </ul>
            </nav>
        </header>

        <!-- Hero Section -->
        <section class="flex h-screen items-center justify-center bg-cover bg-center text-center text-white">
            <div
                class="justify-top container mx-auto flex h-full flex-col items-center bg-[url(/assets/DSC_1078.JPG)] bg-cover bg-center px-4 text-center"
            >
                <h1 class="mx-auto mt-24 text-4xl font-bold text-yellow-950 md:text-5xl lg:text-6xl">Koge vabadust hobuse seljas</h1>
                <p class="mx-auto my-12 max-w-2xl text-xl text-yellow-950 md:text-2xl">
                    Avastage maalilisi radu või õppige ratsutama meie kogenud treenerite juhendamisel
                </p>
                <a href="#broneeri" class="bg-primary my-20 inline-block rounded-md px-8 py-3 text-white transition hover:bg-[#6d4a2a8d]"
                    >Broneeri sõit</a
                >
            </div>
            <div class="">
                <Calendar />
            </div>
        </section>

        <!-- Booking Section -->
        <section id="broneeri" class="bg-secondary py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-primary mb-12 text-center text-3xl font-bold md:text-4xl">Broneerige oma seiklus</h2>

                <div class="mx-auto grid max-w-5xl grid-cols-1 gap-8 md:grid-cols-3">
                    <!-- Trail Rides -->
                    <div class="rounded-lg bg-white p-8 text-center shadow-lg transition hover:-translate-y-2">
                        <i class="fas fa-horse-head text-primary mb-4 text-5xl"></i>
                        <h3 class="text-primary mb-3 text-xl font-bold">Matkad looduses</h3>
                        <p class="mb-4">1-2 tunni pikkused ratsamatkad maalilises looduses</p>
                        <a href="#" class="bg-primary inline-block rounded-md px-6 py-2 text-sm text-white transition hover:bg-[#6d4a2a]">Broneeri</a>
                    </div>

                    <!-- Riding Lessons -->
                    <div class="rounded-lg bg-white p-8 text-center shadow-lg transition hover:-translate-y-2">
                        <i class="fas fa-graduation-cap text-primary mb-4 text-5xl"></i>
                        <h3 class="text-primary mb-3 text-xl font-bold">Ratsutamise tunnid</h3>
                        <p class="mb-4">Algajatele ja edasijõudnutele kõikidele vanusegruppidele</p>
                        <a href="#" class="bg-primary inline-block rounded-md px-6 py-2 text-sm text-white transition hover:bg-[#6d4a2a]">Broneeri</a>
                    </div>

                    <!-- Special Events -->
                    <div class="rounded-lg bg-white p-8 text-center shadow-lg transition hover:-translate-y-2">
                        <i class="fas fa-calendar-alt text-primary mb-4 text-5xl"></i>
                        <h3 class="text-primary mb-3 text-xl font-bold">Eritellimused</h3>
                        <p class="mb-4">Sünnipäevapeod ja grupiüritused</p>
                        <a href="#" class="bg-primary inline-block rounded-md px-6 py-2 text-sm text-white transition hover:bg-[#6d4a2a]"
                            >Küsi pakkumist</a
                        >
                    </div>
                </div>
            </div>
        </section>

        <!-- Preview of Horses -->
        <section class="py-16">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-primary mb-6 text-3xl font-bold md:text-4xl">Meie hobused</h2>
                <p class="mx-auto mb-8 max-w-2xl">Tutvuge meie sõbralike ja kogenud hobustega, kes teevad iga sõidu eriliseks kogemuseks.</p>
                <a href="gallery.html" class="bg-primary inline-block rounded-md px-6 py-2 text-white transition hover:bg-[#6d4a2a]"
                    >Vaata galeriid</a
                >
            </div>
        </section>

        <!-- Preview of Farm -->
        <section class="bg-secondary">
            <div class="container mx-auto flex flex-col md:flex-row">
                <div class="flex flex-col justify-center p-12 md:w-1/2">
                    <h2 class="text-primary mb-6 text-3xl font-bold md:text-4xl">Meie talu</h2>
                    <p class="mb-6">
                        Meie 50 hektari suurune talu pakub ideaalsed tingimused nii algajatele kui kogenud ratsanikele. Avarad karjamaad, ratsakooli
                        väljakud ja ligipääs maalilistele matkaradadele tagavad meeldiva ja turvalise ratsutamiskogemuse.
                    </p>
                    <a href="about.html" class="bg-primary inline-block self-start rounded-md px-6 py-2 text-white transition hover:bg-[#6d4a2a]"
                        >Loe lähemalt</a
                    >
                </div>

                <div
                    class="flex h-full min-h-[400px] flex-col items-center justify-center bg-[url(/assets/William.png)] bg-cover bg-center text-center md:w-1/2"
                ></div>
            </div>
        </section>

        <!-- Footer -->
        <footer id="kontakt" class="bg-gray-800 pt-12 pb-6 text-white">
            <div class="container mx-auto px-4">
                <div class="mb-8 grid grid-cols-1 gap-8 md:grid-cols-3">
                    <!-- Contact Info -->
                    <div>
                        <h3 class="text-primary mb-4 text-xl font-bold">Kontakt</h3>
                        <div class="space-y-3">
                            <p class="flex items-start">
                                <i class="fas fa-map-marker-alt text-primary mt-1 mr-3"></i>
                                <span>Reinu Ratsatalu, Kõruse küla, 93440, Saaremaa, Eesti</span>
                            </p>
                            <p class="flex items-start">
                                <i class="fas fa-phone text-primary mt-1 mr-3"></i>
                                <span>+372 525 32 65</span>
                            </p>
                            <p class="flex items-start">
                                <i class="fas fa-envelope text-primary mt-1 mr-3"></i>
                                <span>reinuratsatalu@gmail.com</span>
                            </p>
                        </div>
                    </div>

                    <!-- Hours -->
                    <div>
                        <h3 class="text-primary mb-4 text-xl font-bold">Lahtiolekuajad</h3>
                        <div class="space-y-3">
                            <p>E-R: 9:00 - 21:00</p>
                            <p>Laupäev-Pühapäev: 10:00 - 20:00</p>
                        </div>
                    </div>

                    <!-- Social -->
                    <div>
                        <h3 class="text-primary mb-4 text-xl font-bold">Jälgi meid</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="hover:text-primary text-2xl text-white transition">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="#" class="hover:text-primary text-2xl text-white transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-700 pt-6 text-center">
                    <p>&copy; 2025 R Ratsatalu. Kõik õigused kaitstud.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

.nav-links {
    clip-path: circle(0px at 90% -10%);
}

.nav-links.active {
    clip-path: circle(1000px at 90% -10%);
}

.toggle .line1 {
    transform: rotate(-45deg) translate(-5px, 6px);
}
.toggle .line2 {
    opacity: 0;
}
.toggle .line3 {
    transform: rotate(45deg) translate(-5px, -6px);
}
</style>
