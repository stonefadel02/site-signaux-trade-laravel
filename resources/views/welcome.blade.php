{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Triple1SignalsPerDay - Accueil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Importe le CSS et le JS compilés par Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#121417]">
    {{-- La Navbar publique sera probablement dans un layout principal,
         mais pour un exemple direct, on peut l'inclure ici. --}}
    {{-- <x-navbar /> --}}

    <main>
            <x-public-navbar />
        {{-- On assemble la page en appelant chaque composant de section --}}
       <section id="accueil">
            <x-hero-section />
        </section>
        
        <section id="fonctionnalites">
            <x-features-section />
            <x-signals-clarification-section />
            <x-reasons-section />
        </section>

        <section id="comment-ca-marche">
            <x-signal-types-section />
            <x-how-to-use-section />
            <x-getting-started-section />
        </section>

        <section id="temoignages">
            <x-testimonials-section />
        </section>

        <section id="tarifs">
            <x-pricing-section />
        </section>

        <section id="contact">
            <x-contact-section />
        </section>

        <section id="faq">
            <x-faq-section />
        </section>
    </main>

    <x-footer />
</body>
</html>