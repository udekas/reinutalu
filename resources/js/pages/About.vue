<script setup>
import MasterFooter from '@/components/MasterFooter.vue';
import Navigation from '@/components/Navigation.vue';
</script>

<template>
    <Navigation />
    <section class="container aspect-video max-w-screen bg-[url(/assets/DSC_0978.JPG)] bg-cover bg-center px-4 text-center">
            <h1 class="hidden sm:block pt-24 mx-auto text-4xl font-bold sm:text-[5vw]">Meist</h1>
        </section>

    <section>

        <!-- Text Boxes Section -->
        <div class="px-4 pt-10">
            <div class="flex flex-wrap justify-center gap-6">
                <!-- Box 1 -->
                <div class="w-full rounded-lg bg-white p-6 shadow sm:w-[45%] lg:w-[30%]">
                    <p class="text-xl text-yellow-950 md:text-2xl">
                        Meie ratsakeskus asub maalilises looduse keskel, kus pakume mitmekesiseid ratsutamisvõimalusi igas vanuses ja tasemel
                        huvilistele.
                    </p>
                </div>

                <!-- Box 2 -->
                <div class="w-full rounded-lg bg-white p-6 shadow sm:w-[45%] lg:w-[30%]">
                    <p class="text-xl text-yellow-950 md:text-2xl">
                        Meie kogenud treenerid aitavad teil saavutada oma ratsutamise eesmärke, olgu need siis algaja tasemel või edasijõudnud.
                    </p>
                </div>

                <!-- Box 3 -->
                <div class="w-full rounded-lg bg-white p-6 shadow sm:w-[45%] lg:w-[30%]">
                    <p class="text-xl text-yellow-950 md:text-2xl">
                        Pakume individuaal- ja grupitrenne, ratsamatku ning võimalust tutvuda hobustega lähemalt. Meie tallis elavad sõbralikud ja
                        hästi hooldatud hobused, kes sobivad nii lastele kui täiskasvanutele.
                    </p>
                </div>

                <!-- Box 4 -->
                <div class="w-full rounded-lg bg-white p-6 shadow sm:w-[45%] lg:w-[30%]">
                    <p class="text-xl text-yellow-950 md:text-2xl">
                        Ootame teid külla, et koos avastada ratsutamise rõõmu ning nautida rahulikku looduskeskkonda. Võtke meiega ühendust ja leiame
                        just teile sobiva lahenduse!
                    </p>
                </div>
            </div>

            <!-- Detailed Box Below -->
            <div class="mx-auto mt-10 max-w-5xl rounded-lg bg-white p-6 text-left text-xl text-yellow-950 shadow md:text-2xl">
                <h2 class="mb-4 text-2xl font-semibold md:text-3xl">Meie talu lugu</h2>
                <p class="mb-6">
                    Reinu talu on pereettevõte. Talu on alati olnud koht, kus väärtustatakse loodust, loomi ja kogukonda. Aastate jooksul oleme
                    arendanud oma ratsakeskust, et pakkuda parimaid võimalusi nii hobustele kui inimestele.
                </p>
                <p class="mb-6">
                    Meie tallis elab mitmekesine hobuste seltskond – alates rahulikest ponidest kuni energiliste sporthobusteni. Kõik meie hobused
                    saavad igapäevaselt hoolt ja armastust ning nende heaolu on meie jaoks esmatähtis.
                </p>

                <h2 class="mb-4 text-2xl font-semibold md:text-3xl">Meie meeskond</h2>
                <p class="mb-6">
                    Reinutalu südameks on meie pühendunud meeskond. Talu perenaine, Anne, hoolitseb igapäevaselt hobuste ja külaliste eest ning
                    korraldab treeninguid. Samuti on ta ka kogenud treener, ratsutaja ja õpetaja, kelle juhendamisel on paljud meie õpilased jõudnud
                    võistlustel edukate tulemusteni.
                </p>
                <p class="mb-6">
                    Lisaks on meie tiimis abivalmid tallitöötajad ja noored vabatahtlikud, kes aitavad hobuseid hooldada ning külalisi vastu võtta.
                    Meie jaoks on oluline, et iga külastaja tunneks end siin oodatuna ja turvaliselt.
                </p>

                <h2 class="mb-4 text-2xl font-semibold md:text-3xl">Mida veel pakume?</h2>
                <ul class="mb-6 list-inside list-disc">
                    <li>Ratsalaagrid lastele ja noortele</li>
                    <li>Hobustega sünnipäevade ja ürituste korraldamine</li>
                    <li>Loodusmatkad ja piknikud talu territooriumil</li>
                    <li>Õppepäevad koolidele ja lasteaedadele</li>
                    <li>Võimalus osaleda talutöödes ja õppida loomade eest hoolitsemist</li>
                </ul>
                <p>
                    Reinutalu on koht, kus igaüks leiab endale midagi – olgu see siis ratsutamine, looduse nautimine või lihtsalt rahulik puhkus maal.
                    Ootame teid avastama meie talu võlusid!
                </p>
            </div>
        </div>
    </section>

    <MasterFooter />
</template>
