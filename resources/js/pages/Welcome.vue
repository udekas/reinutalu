<script setup lang="ts">
import Calendar from '@/components/Calendar.vue';
import MasterFooter from '@/components/MasterFooter.vue';
import Navigation from '@/components/Navigation.vue';

const submit = () => {
    post(route('booking'));
};
</script>
<template>
    <div class="font-sans text-gray-800">
        <Navigation></Navigation>
        <!-- Hero Section -->
        <section class="flex flex-col md:flex-row md:h-screen items-center justify-center bg-cover bg-center text-center text-white">
            <div
                class="justify-top container pt-10 mx-auto flex h-full flex-col items-center bg-[url(/assets/DSC_1078.JPG)] bg-cover bg-center px-4 text-center"
            >
                <h1 class="mx-auto mt-24 text-4xl font-bold text-yellow-950 md:text-5xl lg:text-6xl">Koge vabadust hobuse seljas</h1>
                <p class="mx-auto my-12 max-w-2xl text-xl text-yellow-950 md:text-2xl">
                    Avastage maalilisi radu või õppige ratsutama meie kogenud treenerite juhendamisel
                </p>

                >
            </div>
            <div class="my-10 mr-8">
                <Calendar />
                <a
                    :href="route('booking')"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="bg-primary inline-block rounded-md px-8 py-3 text-white transition hover:bg-[#6d4a2a8d]"
                >
                    Broneeri sõit
                </a>
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

        <MasterFooter></MasterFooter>
    </div>
</template>


