
<template>
  <div class="font-sans text-gray-800">
    <!-- Auth Navigation -->
    <header v-if="showAuthNav" class="fixed top-0 right-0 z-50 mb-6 w-full max-w-[335px] text-sm lg:max-w-4xl">
      <nav class="flex items-center justify-end gap-4 p-4">
        <a
          v-if="user"
          href="/dashboard"
          class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
        >
          Dashboard
        </a>
        <template v-else>
          <a
            href="/login"
            class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
          >
            Log in
          </a>
          <a
            href="/register"
            class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
          >
            Register
          </a>
        </template>
      </nav>
    </header>

    <!-- Main Navigation -->
    <header class="fixed w-full bg-white bg-opacity-90 z-40 shadow-md" :class="{'mt-10': showAuthNav}">
      <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="logo flex items-center text-primary text-2xl font-bold">
          <i class="fas fa-horse mr-2"></i>
          <span>Reinu Ratsatalu</span>
        </div>
        
        <!-- Right-aligned action buttons -->
        <div class="hidden md:flex items-center space-x-4">
          <a href="gallery.html" class="px-4 py-2 rounded-md hover:bg-gray-100 transition">Galerii</a>
          <a href="about.html" class="px-4 py-2 rounded-md hover:bg-gray-100 transition">Meist</a>
          <a href="#broneeri" class="bg-primary hover:bg-[#6d4a2a] text-white px-4 py-2 rounded-md transition">Broneeri</a>
        </div>
        
        <!-- Mobile menu button -->
        <div class="burger md:hidden cursor-pointer" @click="toggleMobileMenu">
          <div class="line1 w-6 h-0.5 bg-primary my-1.5 transition"></div>
          <div class="line2 w-6 h-0.5 bg-primary my-1.5 transition"></div>
          <div class="line3 w-6 h-0.5 bg-primary my-1.5 transition"></div>
        </div>
        
        <!-- Mobile menu (hidden on desktop) -->
        <ul 
          class="nav-links md:hidden absolute bg-white w-full left-0 top-20 py-4 px-4 transition-all duration-500 ease-out"
          :class="{'active pointer-events-auto': mobileMenuOpen, 'pointer-events-none': !mobileMenuOpen}"
        >
          <li class="my-2"><a href="index.html" class="hover:text-primary transition">Avaleht</a></li>
          <li class="my-2"><a href="#teenused" class="hover:text-primary transition">Teenused</a></li>
          <li class="my-2"><a href="gallery.html" class="hover:text-primary transition">Galerii</a></li>
          <li class="my-2"><a href="about.html" class="hover:text-primary transition">Meist</a></li>
          <li class="my-2"><a href="#broneeri" class="hover:text-primary transition">Broneeri</a></li>
          <li class="my-2"><a href="#kontakt" class="hover:text-primary transition">Kontakt</a></li>
        </ul>
      </nav>
    </header>

    <!-- Hero Section -->
    <section 
      class="h-screen flex items-center justify-center text-center text-white bg-cover bg-center"
      :class="{'pt-32': showAuthNav, 'pt-20': !showAuthNav}"
    :style="{'background-image': 'linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('./resources/js/pages/assets/DSC_1078.JPG')}">
      <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">Koge vabadust hobuse seljas</h1>
        <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto">Avastage maalilisi radu või õppige ratsutama meie kogenud treenerite juhendamisel</p>
        <a href="#broneeri" class="inline-block bg-primary hover:bg-[#6d4a2a] text-white px-8 py-3 rounded-md transition">Broneeri sõit</a>
      </div>
    </section>

    <!-- Booking Section -->
    <section id="broneeri" class="py-16 bg-secondary">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-primary mb-12">Broneerige oma seiklus</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
          <!-- Trail Rides -->
          <div class="bg-white p-8 rounded-lg shadow-lg hover:-translate-y-2 transition text-center">
            <i class="fas fa-horse-head text-primary text-5xl mb-4"></i>
            <h3 class="text-xl font-bold text-primary mb-3">Matkad looduses</h3>
            <p class="mb-4">1-2 tunni pikkused ratsamatkad maalilises looduses</p>
            <a href="#" class="inline-block bg-primary hover:bg-[#6d4a2a] text-white px-6 py-2 rounded-md text-sm transition">Broneeri</a>
          </div>
          
          <!-- Riding Lessons -->
          <div class="bg-white p-8 rounded-lg shadow-lg hover:-translate-y-2 transition text-center">
            <i class="fas fa-graduation-cap text-primary text-5xl mb-4"></i>
            <h3 class="text-xl font-bold text-primary mb-3">Ratsutamise tunnid</h3>
            <p class="mb-4">Algajatele ja edasijõudnutele kõikidele vanusegruppidele</p>
            <a href="#" class="inline-block bg-primary hover:bg-[#6d4a2a] text-white px-6 py-2 rounded-md text-sm transition">Broneeri</a>
          </div>
          
          <!-- Special Events -->
          <div class="bg-white p-8 rounded-lg shadow-lg hover:-translate-y-2 transition text-center">
            <i class="fas fa-calendar-alt text-primary text-5xl mb-4"></i>
            <h3 class="text-xl font-bold text-primary mb-3">Eritellimused</h3>
            <p class="mb-4">Sünnipäevapeod ja grupiüritused</p>
            <a href="#" class="inline-block bg-primary hover:bg-[#6d4a2a] text-white px-6 py-2 rounded-md text-sm transition">Küsi pakkumist</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Preview of Horses -->
    <section class="py-16">
      <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-6">Meie hobused</h2>
        <p class="max-w-2xl mx-auto mb-8">Tutvuge meie sõbralike ja kogenud hobustega, kes teevad iga sõidu eriliseks kogemuseks.</p>
        <a href="gallery.html" class="inline-block bg-primary hover:bg-[#6d4a2a] text-white px-6 py-2 rounded-md transition">Vaata galeriid</a>
      </div>
    </section>

    <!-- Preview of Farm -->
    <section class="bg-secondary">
      <div class="container mx-auto flex flex-col md:flex-row">
        <div class="md:w-1/2 p-12 flex flex-col justify-center">
          <h2 class="text-3xl md:text-4xl font-bold text-primary mb-6">Meie talu</h2>
          <p class="mb-6">Meie 50 hektari suurune talu pakub ideaalsed tingimused nii algajatele kui kogenud ratsanikele. Avarad karjamaad, ratsakooli väljakud ja ligipääs maalilistele matkaradadele tagavad meeldiva ja turvalise ratsutamiskogemuse.</p>
          <a href="about.html" class="inline-block bg-primary hover:bg-[#6d4a2a] text-white px-6 py-2 rounded-md self-start transition">Loe lähemalt</a>
        </div>
        
        <div class="md:w-1/2 min-h-[400px] bg-cover bg-center" :style="{'background-image': 'url(./src/assets/William.png)'}"></div>
      </div>
    </section>

    <!-- Footer -->
    <footer id="kontakt" class="bg-gray-800 text-white pt-12 pb-6">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
          <!-- Contact Info -->
          <div>
            <h3 class="text-xl font-bold text-primary mb-4">Kontakt</h3>
            <div class="space-y-3">
              <p class="flex items-start">
                <i class="fas fa-map-marker-alt text-primary mt-1 mr-3"></i>
                <span>Reinu Ratsatalu, Kõruse küla, 93440, Saaremaa,  Eesti</span>
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
            <h3 class="text-xl font-bold text-primary mb-4">Lahtiolekuajad</h3>
            <div class="space-y-3">
              <p>E-R: 9:00 - 21:00</p>
              <p>Laupäev-Pühapäev: 10:00 - 20:00</p>
            </div>
          </div>
          
          <!-- Social -->
          <div>
            <h3 class="text-xl font-bold text-primary mb-4">Jälgi meid</h3>
            <div class="flex space-x-4">
              <a href="#" class="text-white hover:text-primary transition text-2xl">
                <i class="fab fa-facebook"></i>
              </a>
              <a href="#" class="text-white hover:text-primary transition text-2xl">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
          </div>
        </div>
        
        <div class="pt-6 border-t border-gray-700 text-center">
          <p>&copy; 2025 R Ratsatalu. Kõik õigused kaitstud.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  data() {
    return {
      mobileMenuOpen: false,
      showAuthNav: true, // Set this based on your auth logic
      user: null // Set this based on your auth state
    }
  },
  methods: {
    toggleMobileMenu() {
      this.mobileMenuOpen = !this.mobileMenuOpen
    },
    closeMobileMenu() {
      this.mobileMenuOpen = false
    }
  }
}
</script>

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