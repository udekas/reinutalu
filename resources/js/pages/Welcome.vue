<script setup lang="ts">
import Calendar from '@/components/Calendar.vue';
import MasterFooter from '@/components/MasterFooter.vue';
import Navigation from '@/components/Navigation.vue';
</script>

<template>
    <Navigation />

    <div class="font-sans text-gray-800">
        <!-- Hero Section -->
        <section class="container aspect-video max-w-screen bg-[url(/assets/DSC_1078.webp)] bg-cover bg-center px-4 text-center">
            <h1 class="mx-auto hidden pt-24 text-4xl font-bold sm:block sm:text-[5vw]">Koge vabadust hobuse seljas</h1>
        </section>
        <!-- Booking Section -->
        <section id="broneeri" class="bg-secondary py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-primary mb-12 text-center text-3xl font-bold md:text-4xl">Broneerige oma seiklus</h2>

                <div class="flex w-full flex-col gap-8 px-8 md:flex-row md:justify-between">
                    <!-- Trail Rides -->
                    <div class="flex-1 rounded-lg bg-white p-8 text-center shadow-lg transition hover:-translate-y-2">
                        <i class="fas fa-horse-head text-primary mb-4 text-5xl" aria-hidden="true"></i>
                        <h3 class="text-primary mb-3 text-xl font-bold">Matkad looduses</h3>
                        <p class="mb-4">1-2 tunni pikkused ratsamatkad maalilises looduses</p>
                        <router-link
                            to="/booking"
                            class="bg-primary inline-block rounded-md px-6 py-2 text-sm text-white transition hover:bg-[#6d4a2a]"
                        >
                            Broneeri
                        </router-link>
                    </div>

                    <!-- Riding Lessons -->
                    <div class="flex-1 rounded-lg bg-white p-8 text-center shadow-lg transition hover:-translate-y-2">
                        <i class="fas fa-graduation-cap text-primary mb-4 text-5xl" aria-hidden="true"></i>
                        <h3 class="text-primary mb-3 text-xl font-bold">Ratsutamise tunnid</h3>
                        <p class="mb-4">Algajatele ja edasijõudnutele kõikidele vanusegruppidele</p>
                        <router-link
                            to="/booking"
                            class="bg-primary inline-block rounded-md px-6 py-2 text-sm text-white transition hover:bg-[#6d4a2a]"
                        >
                            Broneeri
                        </router-link>
                    </div>

                    <!-- Special Events -->
                    <div class="flex-1 rounded-lg bg-white p-8 text-center shadow-lg transition hover:-translate-y-2">
                        <i class="fas fa-calendar-alt text-primary mb-4 text-5xl" aria-hidden="true"></i>
                        <h3 class="text-primary mb-3 text-xl font-bold">Eritellimused</h3>
                        <p class="mb-4">Sünnipäevapeod ja grupiüritused</p>
                        <router-link
                            to="/inquiry"
                            class="bg-primary inline-block rounded-md px-6 py-2 text-sm text-white transition hover:bg-[#6d4a2a]"
                        >
                            Küsi pakkumist
                        </router-link>
                        <div class="my-10">
                            <a
                                href="/booking"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="bg-primary inline-block rounded-md px-8 py-3 text-white transition hover:bg-[#6d4a2a8d]"
                            >
                                Broneeri sõit
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Calendar -->
                <div class="mt-10 flex w-full flex-col px-4 md:px-48">
                    <Calendar class="mx-auto max-h-[400px] w-full max-w-[1000px] bg-white" />
                </div>
            </div>
        </section>

        <!-- Preview of Horses -->
        <section class="py-16">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-primary mb-6 text-3xl font-bold md:text-4xl">Meie hobused</h2>
                <p class="mx-auto mb-8 max-w-2xl">Tutvuge meie sõbralike ja kogenud hobustega, kes teevad iga sõidu eriliseks kogemuseks.</p>
                <router-link to="/gallery" class="bg-primary inline-block rounded-md px-6 py-2 text-white transition hover:bg-[#6d4a2a]">
                    Vaata galeriid
                </router-link>
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
                    <router-link to="/about" class="bg-primary inline-block self-start rounded-md px-6 py-2 text-white transition hover:bg-[#6d4a2a]">
                        Loe lähemalt
                    </router-link>
                </div>

                <div
                    class="flex h-full min-h-[400px] flex-col items-center justify-center bg-[url(/assets/William.webp)] bg-cover bg-center text-center md:w-1/2"
                ></div>
            </div>
        </section>

        <MasterFooter />
    </div>
</template>
