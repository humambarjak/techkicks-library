<x-app-layout>
    <x-slot name="header">
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
        <section class="text-center mt-10">
            <h4 class="text-xl font-bold text-indigo-600">❓ Hulp Nodig?</h4>
            <p class="text-gray-700">
                Neem contact op met je docent of stuur ons een e-mail op <a href="mailto:support@techkicks.nl" class="text-indigo-600 underline">Rian@techkicks.nl</a>
            </p>
        </section>

    </div>
</x-app-layout>
