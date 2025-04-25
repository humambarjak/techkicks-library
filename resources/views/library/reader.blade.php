<audio id="flip-sound" src="{{ asset('sounds/page-flip.mp3') }}"></audio>
<audio id="bg-music" src="{{ asset('sounds/reading-music.mp3') }}" autoplay loop></audio>
<audio id="milestone-sound" src="{{ asset('sounds/ding.mp3') }}"></audio>

<!-- Motivation Toast -->
<div id="motivation-toast" class="fixed bottom-10 left-1/2 transform -translate-x-1/2 bg-white/90 text-indigo-800 font-bold border-2 border-yellow-400 px-6 py-3 rounded-xl shadow-lg hidden z-50 text-center animate-bounce-in">
    🚀 Je bent op dreef!
</div>

<!-- Milestone Toast -->
<div id="milestone-toast" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white text-indigo-700 border-4 border-yellow-400 px-8 py-5 rounded-2xl shadow-xl font-bold text-lg hidden z-50 text-center animate-bounce-in"></div>

<x-app-layout>
<div class="min-h-screen bg-gradient-to-r from-purple-100 via-blue-100 to-pink-100 py-12 px-4">
    <h2 class="text-4xl font-extrabold text-center text-indigo-700 drop-shadow mb-8">
        📖 Leesmodus
    </h2>

    <a href="{{ route('library.index') }}"
       class="fixed top-5 left-5 z-50 bg-white/90 text-indigo-700 font-semibold px-4 py-2 rounded-full shadow-lg border border-indigo-300 hover:bg-indigo-100 transition-transform hover:scale-105 hover:shadow-xl flex items-center gap-2">
        <span class="animate-bounce">🔙</span> teruggaan
    </a>

    <div class="max-w-5xl mx-auto flex flex-col md:flex-row gap-6 items-start">
        <!-- Cover & Music -->
        <div class="hidden md:flex flex-col items-center w-32 flex-shrink-0">
            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Book Cover"
                 class="rounded-lg shadow-md border border-indigo-200" />
            <p class="text-center text-xs text-gray-500 mt-2">📘 {{ $book->title }}</p>
            <button id="musicToggle" class="mt-4 bg-white/90 text-indigo-700 px-3 py-1 rounded-full shadow border border-indigo-300 hover:bg-indigo-100 transition hover:scale-105 text-sm">
                🔊 Muziek
            </button>
        </div>

        <!-- PDF Area -->
        <div class="flex-1 flex flex-col items-center">
            <canvas id="pdf-canvas" class="rounded-xl shadow-2xl border-4 border-indigo-300 mb-6"></canvas>

            <div class="flex items-center justify-between w-full max-w-md mb-4">
                <button id="prev" class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 transition">⬅ Vorige</button>
                <span id="page-info" class="text-indigo-800 font-semibold text-lg"></span>
                <button id="next" class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 transition">Volgende ➡</button>
            </div>

            <!-- Rating -->
            @if(Auth::user()->role === 'student')
            <form method="POST" action="{{ route('books.rate', $book) }}" class="mt-8 text-center">
                @csrf
                <label class="block text-lg font-semibold text-indigo-800 mb-2">Geef je beoordeling</label>
                <div class="inline-flex items-center gap-2">
                    @for($i = 1; $i <= 5; $i++)
                    <label>
                        <input type="radio" name="rating" value="{{ $i }}" class="hidden" onchange="this.form.submit()" />
                        <span class="text-3xl cursor-pointer hover:scale-110 transition transform duration-200">⭐</span>
                    </label>
                    @endfor
                </div>
                <p class="text-sm text-gray-500 mt-2">Klik op het aantal sterren dat je wilt geven</p>
            </form>
            @endif

            <!-- Bookmark -->
            <button id="bookmark" class="mt-6 bg-yellow-400 hover:bg-yellow-500 text-white font-bold px-6 py-2 rounded-lg shadow transition">
                🔖 Voeg deze pagina toe aan je bladwijzers
            </button>
        </div>
    </div>

    <!-- Notes Panel -->
    <div id="notesPanel" class="fixed right-0 top-20 bg-white/90 shadow-xl rounded-l-xl w-72 h-[85vh] p-4 overflow-y-auto border-l-4 border-yellow-400 hidden z-50">
        <h3 class="text-xl font-bold text-indigo-700 mb-4 flex items-center gap-2">📝 Notities</h3>
        <div id="notesList" class="space-y-2 text-sm text-gray-700"></div>
    </div>

    <button id="toggleNotes" class="fixed right-4 top-4 bg-yellow-400 text-white px-3 py-2 rounded-full shadow-lg hover:bg-yellow-500 transition z-50">
        📝 Notities
    </button>

    <!-- Styles -->
    <style>
        #pdf-canvas {
            transition: transform 0.6s ease-in-out;
            transform-origin: center center;
            backface-visibility: hidden;
            transform-style: preserve-3d;
            perspective: 1200px;
        }
        .flip-left { animation: flip 0.6s forwards; }
        @keyframes flip { 0% { transform: rotateY(0deg); } 100% { transform: rotateY(-180deg); } }
        .animate-bounce { animation: bounce 1.2s infinite; }
        @keyframes bounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-4px); } }
        .animate-bounce-in {
            animation: bounce-in 0.6s ease-out;
        }
        @keyframes bounce-in {
            0% { opacity: 0; transform: translateY(20px) scale(0.9); }
            50% { opacity: 1; transform: translateY(-5px) scale(1.05); }
            100% { transform: translateY(0) scale(1); }
        }
    </style>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>

    <script>
        const url = "{{ asset('storage/' . $book->pdf_file) }}";
        let pdfDoc = null,
            pageNum = 1,
            canvas = document.getElementById("pdf-canvas"),
            ctx = canvas.getContext('2d'),
            flipSound = document.getElementById("flip-sound"),
            pagesRead = 0;

        const renderPage = num => {
            pdfDoc.getPage(num).then(page => {
                const viewport = page.getViewport({ scale: 1.5 });
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                page.render({ canvasContext: ctx, viewport });
                document.getElementById("page-info").textContent = `Pagina ${pageNum} van ${pdfDoc.numPages}`;
            });
        };

        const loadPDF = () => {
            pdfjsLib.getDocument(url).promise.then(pdf => {
                pdfDoc = pdf;
                renderPage(pageNum);
            });
        };

        function flipPage(direction) {
            if ((direction === 'next' && pageNum >= pdfDoc.numPages) ||
                (direction === 'prev' && pageNum <= 1)) return;

            flipSound.currentTime = 0;
            flipSound.play();

            canvas.classList.add("flip-left");
            setTimeout(() => {
                pageNum += (direction === 'next') ? 1 : -1;
                renderPage(pageNum);
                canvas.classList.remove("flip-left");

                pagesRead++;
                if (pagesRead % 3 === 0) showMotivationMessage();
                triggerMilestoneCelebration(pageNum);
            }, 600);
        }

        function showMotivationMessage() {
            const toast = document.getElementById("motivation-toast");
            const messages = [
                "🚀 Je bent op dreef!", "👏 Goed bezig!", "🔥 Blijf lezen, kampioen!",
                "📚 Jij rockt deze pagina’s!", "🌟 Fantastisch tempo!", "💡 Iedere pagina telt!",
            ];
            toast.textContent = messages[Math.floor(Math.random() * messages.length)];
            toast.classList.remove("hidden");
            setTimeout(() => toast.classList.add("hidden"), 2500);
        }

        const milestoneToast = document.getElementById("milestone-toast");
        const milestoneSound = document.getElementById("milestone-sound");

        function triggerMilestoneCelebration(page) {
            const messages = {
                3: "🎯 Goed bezig! Je hebt 3 pagina's gelezen!",
                5: "🏆 Fantastisch! 5 pagina's gelezen, ga zo door!"
            };
            if (!messages[page]) return;

            milestoneToast.textContent = messages[page];
            milestoneToast.classList.remove("hidden");
            milestoneSound.play();
            confetti({ particleCount: 100, spread: 70, origin: { y: 0.6 } });

            setTimeout(() => milestoneToast.classList.add("hidden"), 3000);
        }

        document.getElementById("next").addEventListener("click", () => flipPage('next'));
        document.getElementById("prev").addEventListener("click", () => flipPage('prev'));
        document.getElementById("bookmark").addEventListener("click", () => {
            alert(`🔖 Pagina ${pageNum} is opgeslagen als bladwijzer!`);
        });

        loadPDF();
    </script>

    <script>
        const music = document.getElementById("bg-music");
        const toggleBtn = document.getElementById("musicToggle");
        let isMuted = false;

        toggleBtn.addEventListener("click", () => {
            isMuted = !isMuted;
            music.muted = isMuted;
            toggleBtn.textContent = isMuted ? "🔇 Muziek" : "🔊 Muziek";
        });

        music.volume = 0;
        let vol = 0;
        const fadeInterval = setInterval(() => {
            if (vol < 0.4) {
                vol += 0.01;
                music.volume = vol;
            } else {
                clearInterval(fadeInterval);
            }
        }, 80);
    </script>

    <script>
        const savedNotes = @json($notes);
        const notesPanel = document.getElementById("notesPanel");
        const toggleNotes = document.getElementById("toggleNotes");
        const notesList = document.getElementById("notesList");

        toggleNotes.addEventListener("click", () => notesPanel.classList.toggle("hidden"));

        function addNote(content = "", page = pageNum) {
            const note = document.createElement("div");
            note.className = "p-2 bg-yellow-100 border-l-4 border-yellow-400 rounded shadow";
            note.innerHTML = `
                <strong>📄 Pagina ${page}</strong>
                <textarea class="w-full mt-1 text-sm p-1 rounded border border-gray-300 bg-white">${content}</textarea>
            `;
            notesList.appendChild(note);
        }

        function loadNotesFromDatabase() {
            savedNotes.forEach(note => addNote(note.content, note.page));
        }

        document.getElementById("bookmark").insertAdjacentHTML("afterend", `
            <button id="addNote" class="mt-4 bg-indigo-400 hover:bg-indigo-500 text-white font-bold px-4 py-2 rounded shadow transition">
                ➕ Notitie voor pagina toevoegen
            </button>
        `);

        document.getElementById("addNote").addEventListener("click", () => addNote());

        function saveNotesToServer() {
            const allNotes = [];
            document.querySelectorAll("#notesList textarea").forEach(textarea => {
                const page = textarea.closest("div").querySelector("strong")?.innerText?.match(/\d+/)?.[0] || 1;
                allNotes.push({ page, content: textarea.value });
            });

            allNotes.forEach(note => {
                fetch("/notes", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        book_id: {{ $book->id }},
                        page: note.page,
                        content: note.content
                    })
                });
            });
        }

        let typingTimer;
        notesList.addEventListener("input", () => {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(saveNotesToServer, 800);
        });

        loadNotesFromDatabase();
    </script>
</div>
</x-app-layout>
