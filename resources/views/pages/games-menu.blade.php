<x-app-layout>
    <style>
        #tsparticles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            transition: opacity 0.3s ease-in-out;
        }

        body.dimmed #tsparticles {
            opacity: 0.1;
        }
    </style>

    <!-- ✨ Particle Background -->
    <div id="tsparticles"></div>

    <div class="min-h-screen bg-gradient-to-br from-[#fdfcfb] to-[#e2d1c3] flex flex-col items-center justify-start px-6 pt-8 pb-16 relative z-10">
        <!-- 🧠 Heading moved up -->
        <h1 class="text-4xl sm:text-5xl font-extrabold text-indigo-800 mb-2 mt-4 animate-bounce drop-shadow-md">🎮 Kies een spel</h1>
        <p class="text-gray-700 text-center max-w-xl mb-10 text-lg">Kies een leuk en leerzaam spel om je leesvaardigheid te verbeteren!</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 w-full max-w-6xl">
        <!-- 🏁 TypRace  -->
            <div class="game-card bg-white/80 backdrop-blur-md border border-green-200 rounded-3xl shadow-xl p-6 flex flex-col items-center text-center transition duration-300 hover:shadow-green-300 hover:-translate-y-1 hover:scale-105 cursor-pointer">
                <img src="{{ asset('images/previews/race.gif') }}" alt="TypRace Preview" class="w-full h-44 object-cover rounded-xl mb-4 shadow-md">
                <h2 class="text-2xl font-bold text-green-700 mb-2">🏎️ TypRace</h2>
                <p class="text-green-800 mb-4">Wie typt het snelst over meerdere ronden en wint de race?</p>
                <a href="{{ route('race') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-full font-semibold shadow-md transition hover:scale-110">
                    🚀 Speel Nu
                </a>
            </div>

            <!-- 🏁 Woordenstrijd -->
            <div class="game-card bg-white/80 backdrop-blur-md border border-gray-200 rounded-3xl shadow-xl p-6 flex flex-col items-center text-center transition duration-300 hover:shadow-indigo-300 hover:-translate-y-1 hover:scale-105 cursor-pointer">
                <img src="{{ asset('images/previews/race-preview.gif') }}" alt="Race Game Preview" class="w-full h-44 object-cover rounded-xl mb-4 shadow-md">
                <h2 class="text-2xl font-bold text-indigo-700 mb-2">🏁 Woordenstrijd</h2>
                <p class="text-gray-600 mb-4">Typ het juiste woord sneller dan je tegenstander!</p>
                <a href="{{ route('library.game') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-full font-semibold shadow-md transition hover:scale-110">
                    🚗💨 Speel Nu
                </a>
            </div>
            <!-- 🌟 Typing Battle  -->
            <div class="game-card bg-white/80 backdrop-blur-md border border-blue-200 rounded-3xl shadow-xl p-6 flex flex-col items-center text-center transition duration-300 hover:shadow-blue-300 hover:-translate-y-1 hover:scale-105 cursor-pointer">
                <img src="{{ asset('images/previews/ztype-preview.gif') }}" alt="Typing Battle Preview" class="w-full h-44 object-cover rounded-xl mb-4 shadow-md">
                <h2 class="text-2xl font-bold text-blue-700 mb-2">🌟 Typegevecht</h2>
                <p class="text-blue-800 mb-4">Typ woorden om vallende vijanden te verslaan en je skills te verbeteren!</p>
                <a href="{{ route('typing.battle') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full font-semibold shadow-md transition hover:scale-110">
                    🎮 Speel Nu
                </a>
            </div>


            <!-- 🎯 Emoji Quiz -->
            <div class="game-card bg-white/80 backdrop-blur-md border border-gray-200 rounded-3xl shadow-xl p-6 flex flex-col items-center text-center transition duration-300 hover:shadow-yellow-300 hover:-translate-y-1 hover:scale-105 cursor-pointer">
                <img src="{{ asset('images/previews/emoji-preview.gif') }}" alt="Emoji Quiz Preview" class="w-full h-44 object-cover rounded-xl mb-4 shadow-md">
                <h2 class="text-2xl font-bold text-yellow-700 mb-2">🎯 Emoji Betekenis Quiz</h2>
                <p class="text-gray-600 mb-4">Raad de betekenis van grappige emoji-combo’s!</p>
                <a href="{{ route('library.emoji') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-full font-semibold shadow-md transition hover:scale-110">
                    🎮 Speel Nu
                </a>
            </div>
        </div>
    </div>

    <!-- 🔊 Hover Sound -->
    <audio id="hoverSound" src="{{ asset('sounds/hover.mp3') }}"></audio>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.12.0/tsparticles.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            tsParticles.load("tsparticles", {
                fullScreen: { enable: false },
                background: { color: "#fdfcfb" },
                particles: {
                    number: { value: 50 },
                    color: { value: "#a78bfa" },
                    shape: { type: "circle" },
                    opacity: { value: 0.5 },
                    size: { value: 3 },
                    links: {
                        enable: true,
                        color: "#d8b4fe",
                        distance: 120,
                        opacity: 0.4,
                        width: 1
                    },
                    move: { enable: true, speed: 1 }
                }
            });

            // 🎵 Hover Sound
            const hoverSound = document.getElementById("hoverSound");
            document.querySelectorAll('.game-card').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    if (hoverSound) {
                        hoverSound.pause();
                        hoverSound.currentTime = 0;
                        hoverSound.play().catch(() => {});
                    }
                });
            });

            // 🌌 Optional: Dim when dropdown opens
            const dropdownButtons = document.querySelectorAll('[x-data] [@click]');
            dropdownButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    document.body.classList.toggle('dimmed');
                });
            });
        });
    </script>
</x-app-layout>
