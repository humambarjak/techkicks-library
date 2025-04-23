<audio id="flip-sound" src="{{ asset('sounds/page-flip.mp3') }}"></audio>

<x-app-layout>
    <div>
        <h2>
            Leesmodus
        </h2>

        <a href="{{ route('library.index') }}">
            teruggaan
        </a>

        <div>
            <!-- Book Cover -->
            <div>
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Book Cover" />
                <p>{{ $book->title }}</p>
            </div>

            <!-- PDF & Controls -->
            <div>
                <canvas id="pdf-canvas"></canvas>

                <div>
                    <button id="prev">Vorige</button>

                    <span id="page-info"></span>

                    <button id="next">Volgende</button>
                </div>

                @if(Auth::user()->role === 'student')
                    <form method="POST" action="{{ route('books.rate', $book) }}">
                        @csrf
                        <label>Geef je beoordeling</label>
                        <div>
                            @for($i = 1; $i <= 5; $i++)
                                <label>
                                    <input type="radio" name="rating" value="{{ $i }}" onchange="this.form.submit()" />
                                    <span>*</span>
                                </label>
                            @endfor
                        </div>
                        <p>Klik op het aantal sterren dat je wilt geven</p>
                    </form>
                @endif

                <button id="bookmark">
                    Voeg deze pagina toe aan je bladwijzers
                </button>
            </div>
        </div>

        <!-- Notes Panel -->
        <div id="notesPanel" class="hidden">
            <h3>Notities</h3>
            <div id="notesList"></div>
        </div>

        <button id="toggleNotes">
            Notities
        </button>

        <script>
            const savedNotes = @json($notes);
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>

        <style>
            #pdf-canvas {
                transition: transform 0.6s ease-in-out;
                transform-origin: center center;
                backface-visibility: hidden;
                transform-style: preserve-3d;
                perspective: 1200px;
            }

            .flip-left {
                animation: flip 0.6s forwards;
            }

            @keyframes flip {
                0% { transform: rotateY(0deg); }
                100% { transform: rotateY(-180deg); }
            }
        </style>

        <script>
            const url = "{{ asset('storage/' . $book->pdf_file) }}";
            let pdfDoc = null,
                pageNum = 1,
                canvas = document.getElementById("pdf-canvas"),
                ctx = canvas.getContext('2d'),
                flipSound = document.getElementById("flip-sound");

            const renderPage = num => {
                pdfDoc.getPage(num).then(page => {
                    const viewport = page.getViewport({ scale: 1.5 });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    page.render({ canvasContext: ctx, viewport });
                    document.getElementById("page-info").textContent = `Page ${pageNum} of ${pdfDoc.numPages}`;
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
                }, 600);
            }

            document.getElementById("next").addEventListener("click", () => flipPage('next'));
            document.getElementById("prev").addEventListener("click", () => flipPage('prev'));
            document.getElementById("bookmark").addEventListener("click", () => {
                alert(`Bookmarked Page ${pageNum}`);
            });

            loadPDF();
        </script>

        <!-- Sticky Notes -->
        <script>
            const notesPanel = document.getElementById("notesPanel");
            const toggleNotes = document.getElementById("toggleNotes");
            const notesList = document.getElementById("notesList");

            toggleNotes.addEventListener("click", () => {
                notesPanel.classList.toggle("hidden");
            });

            function addNote(content = "", page = pageNum) {
                const note = document.createElement("div");
                note.innerHTML = `
                    <strong>Page ${page}</strong>
                    <textarea>${content}</textarea>
                `;
                notesList.appendChild(note);
            }

            function loadNotesFromDatabase() {
                savedNotes.forEach(note => addNote(note.content, note.page));
            }

            // Add Note Button
            document.getElementById("bookmark").insertAdjacentHTML("afterend", `
                <button id="addNote">Notitie voor pagina toevoegen</button>
            `);

            document.getElementById("addNote").addEventListener("click", () => {
                addNote();
            });

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
                typingTimer = setTimeout(() => {
                    saveNotesToServer();
                }, 800);
            });

            loadNotesFromDatabase();
        </script>
    </div>
</x-app-layout>
