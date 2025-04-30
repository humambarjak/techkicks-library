<x-app-layout>
    <x-slot name="header">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <h2 class="text-2xl font-extrabold text-indigo-700 tracking-tight">ℹ️ Over TechKicks Bibliotheek</h2>
    </x-slot>

    <div class="relative z-0 py-10 px-6 max-w-6xl mx-auto text-gray-800 space-y-12 leading-relaxed  ">


        <!-- 🧡 Uitleg Blokken -->
        <section>
            <h3 class="text-xl font-bold text-indigo-600 mb-2">📚 Wat is TechKicks Bibliotheek?</h3>
            <p>
                TechKicks is een interactieve digitale bibliotheek voor leerling  en docenten. 
                Hier kun je lezen, notities maken, boeken favoriet maken en zelfs leren door spelletjes te spelen!
            </p>
        </section>

        <section>
            <h3 class="text-xl font-bold text-indigo-600 mb-2">👨‍🏫 Voor Docenten</h3>
            <p>
                Docenten kunnen boeken toevoegen, bewerken en verwijderen, leerlingactiviteiten volgen en de voortgang stimuleren door middel van badges.
            </p>
        </section>

        <section>
            <h3 class="text-xl font-bold text-indigo-600 mb-2">👩‍🎓 Voor Leerling</h3>
            <p>
                Leerling kunnen hun eigen boekenplank vullen, notities maken bij pagina’s, en interactieve spellen spelen om hun leesvaardigheid te verbeteren.
            </p>
        </section>

        <!-- 🚀 Stappenplan -->
        <section>
            <h4 class="text-2xl font-semibold text-indigo-600 mb-4">🚀 Hoe werkt het?</h4>

            <ol class="relative border-l-4 border-indigo-300 pl-6 space-y-6">
                <li>
                    <div class="absolute w-4 h-4 bg-indigo-500 rounded-full -left-2 top-1"></div>
                    <h5 class="text-lg font-bold text-indigo-700">1. Inloggen of Registreren</h5>
                    <p>Maak een account aan of log in om toegang te krijgen tot de bibliotheek.</p>
                </li>
                <li>
                    <div class="absolute w-4 h-4 bg-indigo-500 rounded-full -left-2 top-1"></div>
                    <h5 class="text-lg font-bold text-indigo-700">2. Verken de Boeken</h5>
                    <p>Bekijk de categorieën en kies een boek om te lezen 📚.</p>
                </li>
                <li>
                    <div class="absolute w-4 h-4 bg-indigo-500 rounded-full -left-2 top-1"></div>
                    <h5 class="text-lg font-bold text-indigo-700">3. Lezen & Notities Maken</h5>
                    <p>Lees pagina's, voeg sticky notes toe en markeer bladwijzers.</p>
                </li>
                <li>
                    <div class="absolute w-4 h-4 bg-indigo-500 rounded-full -left-2 top-1"></div>
                    <h5 class="text-lg font-bold text-indigo-700">4. Speel het Woordspel!</h5>
                    <p>Test je kennis en woordenschat met het 2-speler spel 🎮.</p>
                </li>
                <li>
                    <div class="absolute w-4 h-4 bg-indigo-500 rounded-full -left-2 top-1"></div>
                    <h5 class="text-lg font-bold text-indigo-700">5. Verdien Badges</h5>
                    <p>Voor elke 5 gelezen boeken ontvang je een Superlezer badge 🏅!</p>
                </li>
            </ol>
        </section>

        <!-- 🎥 Video Tutorials -->
        <section>
            <h4 class="text-2xl font-semibold text-indigo-600 mb-4">🎥 Video Tutorials</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <!-- Video 1 -->
                <div class="rounded-lg overflow-hidden shadow-md">
                    <iframe class="w-full h-64 rounded-lg"
                        src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                        title="Intro Video" frameborder="0" allowfullscreen>
                    </iframe>
                    <p class="text-center mt-2 font-semibold text-indigo-700">📘 Introductie tot de bibliotheek</p>
                </div>

                <!-- Video 2 -->
                <div class="rounded-lg overflow-hidden shadow-md">
                    <iframe class="w-full h-64 rounded-lg"
                        src="https://www.youtube.com/embed/oHg5SJYRHA0"
                        title="Spel Uitleg" frameborder="0" allowfullscreen>
                    </iframe>
                    <p class="text-center mt-2 font-semibold text-indigo-700">🎮 Speluitleg: 2-speler woordstrijd</p>
                </div>
            </div>
        </section>

        <!-- 📬 Contact -->
        <footer class="w-full mt-24 text-indigo-900 py-16 px-6 border-t border-indigo-200">

<div class="w-full max-w-screen-2xl mx-auto grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-10 text-sm">
    <div>
        <h4 class="font-bold mb-3">TechKicks</h4>
        <ul class="space-y-1">
        <li><a href="https://techkicks.nl/en/over-ons/" target="_blank" rel="noopener">Over</a></li>
        <li><a href="https://techkicks.nl/en/contact/" target="_blank" rel="noopener">contact</a></li>
        </ul>
    </div>
    <div>
        <h4 class="font-bold mb-3">Bronnen</h4>
        <ul class="space-y-1">
            <li><a href="#">Blog</a></li>
            <li><a href="#">Apps</a></li>
        </ul>
    </div>
    <div>
        <h4 class="font-bold mb-3">Service</h4>
        <ul class="space-y-1">
            <li><a href="#">Veelgestelde vragen</a></li>
            <li><a href="#">Wachtwoord vergeten</a></li>
            <li><a href="#">Klachtenregeling</a></li>
        </ul>
    </div>
    <div>
        <h4 class="font-bold mb-3">Merken</h4>
        <ul class="space-y-1">
            <li><a href="#">TechKicks Junior</a></li>
            <li><a href="#">FutureLearn</a></li>
        </ul>
    </div>
    <div>
        <h4 class="font-bold mb-3">Legal</h4>
        <ul class="space-y-1">
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Cookies</a></li>
            <li><a href="#">Algemene Voorwaarden</a></li>
        </ul>
    </div>
</div>

<div class="w-full max-w-screen-2xl mx-auto mt-10 border-t border-indigo-300 pt-8 flex flex-col md:flex-row justify-between items-center gap-6">
    <!-- Newsletter -->
    <div class="w-full md:w-auto text-center md:text-left">
        <h5 class="font-semibold mb-2">Blijf op de hoogte!</h5>
        <form class="flex flex-col sm:flex-row gap-2 items-center justify-center md:justify-start">
            <input type="email" placeholder="Je e-mailadres"
                   class="px-4 py-2 rounded-lg border border-indigo-300 focus:ring-2 focus:ring-indigo-400 shadow-sm w-full sm:w-64">
            <button type="submit"
                    class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition">
                Verstuur
            </button>
        </form>
    </div>
         <!-- 🎯 New 3D Hover Social Media Buttons -->
                <div class="parent">
        <div class="child child-1">
            <a href="https://twitter.com/techkicks" target="_blank" rel="noopener">
            <button class="button">
                <i class="fab fa-twitter text-blue-400 fa-2x"></i>
            </button>
            </a>
        </div>

        <div class="child child-2">
            <a href="https://www.instagram.com/techkicksnl/" target="_blank" rel="noopener">
            <button class="button">
                <i class="fab fa-instagram text-pink-500 fa-2x"></i>
            </button>
            </a>
        </div>

        <div class="child child-3">
            <a href="https://www.youtube.com/@techkicks" target="_blank" rel="noopener">
            <button class="button">
                <i class="fab fa-youtube text-red-500 fa-2x"></i>
            </button>
            </a>
        </div>

        <div class="child child-4">
            <a href="https://www.facebook.com/techkicksnl" target="_blank" rel="noopener">
            <button class="button">
                <i class="fab fa-facebook-f text-blue-600 fa-2x"></i>
            </button>
            </a>
        </div>
        </div>
        </div>
        <div class="w-full text-center mt-8 text-sm text-gray-700">
            © {{ now()->year }} TechKicks. Alle rechten voorbehouden.
        </div>
        </footer>
    </div>
    <style>
    /* 🎯 3D Animated Social Media Buttons */
    .parent {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    }

    .child {
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    transform-style: preserve-3d;
    transition: all 0.3s cubic-bezier(0.68, 0.85, 0.265, 1.85);
    border-radius: 5px;
    margin: 0 5px;
    box-shadow: inset 1px 1px 2px #fff, 0 0 5px #4442;
    }

    .child:hover {
    background-color: white;
    transform: perspective(180px) rotateX(60deg) translateY(2px);
    }

    .child-1:hover {
    box-shadow: 0px 10px 10px #1e90ff;
    }
    .child-2:hover {
    box-shadow: 0px 10px 10px #ff00ff;
    }
    .child-3:hover {
    box-shadow: 0px 10px 10px #000;
    }
    .child-4:hover {
    box-shadow: 0px 10px 10px #4267b2;
    }

    .button {
    cursor: pointer;
    width: 100%;
    height: 100%;
    border: none;
    background-color: transparent;
    font-size: 20px;
    transition-duration: 0.5s;
    transition-timing-function: cubic-bezier(0.68, -0.85, 0.265, 1.55);
    }

    .child:hover > .button {
    transform: translate3d(0px, 20px, 30px) perspective(80px) rotateX(-60deg)
        translateY(2px) translateZ(10px);
    }
    </style>

</x-app-layout>
