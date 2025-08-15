{{-- resources/views/components/hero-section.blade.php --}}

 <section
     class="relative flex min-h-[800px] w-full items-center bg-cover bg-center pt-20"
     style="background-image: url('{{ asset('bg.png') }}')"
 >
     {{-- Superposition de couleur sombre pour la lisibilité du texte --}}
     <div class="absolute inset-0 bg-black/40"></div>

     {{-- Conteneur du contenu, centré et au-dessus de la superposition --}}
     <div class="relative z-10 mx-auto w-full max-w-6xl px-10 sm:px-6 lg:px-8">
         <div class="max-w-2xl">
             {{-- Titre principal --}}
             <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl md:text-[55px]">
                 TRIPLE1SIGNALSPERDAY -
                 <br />
                 <span class="text-blue-400">NOS MEILLEURS SIGNAUX </span>
                 DE TRADING EN TEMPS RÉEL
             </h1>

             {{-- Paragraphe de description --}}
             <p class="mt-6 w-5/6 text-[20px] leading-8 text-white">
                 Rejoignez des milliers de traders et boostez vos profits avec nos
                 signaux de Forex, matières premières, indices, actions et
                 cryptomonnaies !
             </p>

             {{-- Conteneur pour les boîtes d'information --}}
             <div class="mt-10 flex max-w-sm flex-col gap-4">
                 {{-- Boîte 1 : 3 sessions --}}
                 <div class="flex items-center gap-4 rounded-lg border-l-4 border-yellow-400 bg-gradient-to-r from-[#25283A] to-[#1E2027] p-4 backdrop-blur-sm">
                     <i class="fa-regular fa-clock fa-shake ml-5 text-yellow-400 text-6xl"></i>
                     <span class="text-[30px] font-semibold text-white">
                         3 sessions de trading par jour
                     </span>
                 </div>
             </div>

             {{-- Boîte 2 : 10 signaux --}}
             <div class="mt-10 flex max-w-[320px] items-center gap-4 rounded-lg bg-gradient-to-r from-[#25283A] to-[#3A51A1] p-3 backdrop-blur-sm">
                 <i class="fa-solid fa-beat fa-chart-bar ml-5 text-cyan-300 text-6xl"></i>
                 <span class="text-[33px] font-semibold text-white">
                     7 signaux par session
                 </span>
             </div>
         </div>
     </div>
 </section>