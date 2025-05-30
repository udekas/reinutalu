<script setup>
import MasterFooter from '@/components/MasterFooter.vue';
import Navigation from '@/components/Navigation.vue';
</script>

<template>
    <Navigation />
    <section class="container aspect-video max-w-screen bg-[url(/assets/DSC_0978.webp)] bg-cover bg-center px-4 text-center">
        <h1 class="mx-auto hidden pt-26 text-sm font-bold shadow-2xl sm:block sm:text-[3vw]">
            Reinu talu on koht, kus igaüks leiab enda jaoks midagi
        </h1>
    </section>

    <section class="bg-secondary py-16">
        <!-- Text Boxes Section -->
        
        
        <div class="container mx-auto px-4">
            <div class="flex flex-col gap-6 px-4">
                <!-- Box 1 -->
                <div class="w-full rounded-lg bg-white p-6 shadow">
                    <h2 class="mb-4 text-2xl font-semibold md:text-3xl">Meie talu lugu</h2>
                    <p class="mb-4">
                        Reinu talu on pereettevõte. Talu on alati olnud koht, kus väärtustatakse loodust, loomi ja kogukonda. Aastate jooksul oleme
                        arendanud oma ratsatalu, et pakkuda parimaid võimalusi nii hobustele kui inimestele.
                    </p>
                    <p>
                        Meie tallis elab mitmekesine hobuste seltskond – alates rahulikest ponidest kuni energiliste sporthobusteni. Kõik meie hobused
                        saavad igapäevaselt hoolt ja armastust ning nende heaolu on meie jaoks esmatähtis.
                    </p>
                </div>
    
                <!-- Box 2 -->
                <div class="w-full rounded-lg bg-white p-6 shadow">
                    <h2 class="mb-4 text-2xl font-semibold md:text-3xl">Meie meeskond</h2>
                    <p class="mb-4">
                        Reinutalu südameks on meie pühendunud meeskond. Talu perenaine Anne hoolitseb igapäevaselt hobuste ja külaliste eest ning
                        korraldab treeninguid. Samuti on ta ka kogenud treener, ratsutaja ja õpetaja, kelle juhendamisel on paljud meie õpilased
                        jõudnud võistlustel edukate tulemusteni.
                    </p>
                    <p>
                        Lisaks on meie tiimis abivalmid tallitöötajad ja noored vabatahtlikud, kes aitavad hobuseid hooldada ning külalisi vastu
                        võtta. Meie jaoks on oluline, et iga külastaja tunneks end siin oodatuna ja turvaliselt.
                    </p>
                </div>
    
                <!-- Box 3 -->
                <div class="w-full rounded-lg bg-white p-6 shadow">
                    <h2 class="mb-4 text-2xl font-semibold md:text-3xl">Mida veel pakume?</h2>
                    <ul class="mb-4 list-inside list-disc">
                        <li>Ratsalaagrid lastele ja noortele</li>
                        <li>Hobustega sünnipäevade ja ürituste korraldamine</li>
                        <li>Loodusmatkad ja piknikud talu territooriumil</li>
                        <li>Õppepäevad koolidele ja lasteaedadele</li>
                        <li>Võimalus osaleda talutöödes ja õppida loomade eest hoolitsemist</li>
                    </ul>
                    <p>
                        Reinutalu on koht, kus igaüks leiab endale midagi – olgu see siis ratsutamine, looduse nautimine või lihtsalt rahulik puhkus
                        maal. Ootame teid avastama meie talu võlusid!
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16">
    </section>

    <MasterFooter />
</template>
