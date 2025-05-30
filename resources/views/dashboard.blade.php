@section('page-background', 'bg-animated-pattern')


<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-sans text-indigo-700 font-sans drop-shadow-sm tracking-wide">
            {{ __('Dashboard') }}
        </h1>
    </x-slot>

    @if(Auth::user()->role === 'student')
        <audio id="welcomeSound" src="/sounds/welcome.mp3" preload="auto"></audio>
    @endif

    <div class="min-h-screen py-12 px-4">
        <div class="relative z-10 max-w-2xl mx-auto bg-white p-8 rounded-3xl shadow-2xl text-center border-2 border-indigo-200 animate-fade-in welcome-box overflow-hidden">

            @if(Auth::user()->role === 'student')
                <div class="absolute inset-0 pointer-events-none z-0">
                    <div class="floating-inside">📚</div>
                    <div class="floating-inside delay-1">📘</div>
                    <div class="floating-inside delay-2">📖</div>
                </div>
            @endif
            <div class="relative z-10">
                <h1 class="text-3xl sm:text-4xl  text-indigo-700 mb-2 {{ Auth::user()->role === 'student' ? 'typing' : 'glow-text' }}">
                    <span class="wave-emoji">👋</span> Welkom, {{ Auth::user()->name }}
                </h1>

                <p class="text-lg text-gray-600 mb-6">
                    <span class="text-sm text-gray-400">({{ ucfirst(Auth::user()->role) }})</span>
                </p>

            @if(Auth::user()->role === 'student')
                <!-- 🔥 Reading Streak Counter -->
                <div class="mt-4 bg-indigo-50 text-indigo-700 rounded-xl py-3 px-5 shadow">
                    <p class="font-sans">📆 Leesreeks</p>
                    <p class="text-sm mt-1">
                        Je hebt <strong>{{ $streakDays }}</strong> dagen achter elkaar gelezen
                        @if($streakDays >= 2) <span class="text-xl">🔥</span> @endif
                    </p>
                </div>

                @php
                    $badgeGoal = 7;
                    $remaining = max(0, $badgeGoal - $streakDays);
                    $progressPercent = min(100, ($streakDays / $badgeGoal) * 100);
                @endphp

                <div class="mt-3 text-sm text-indigo-600">
                    @if($streakDays >= $badgeGoal)
                        🎉 Je hebt een badge verdiend voor je leesreeks! 🏅
                    @else
                        Je bent nog {{ $remaining }} dag{{ $remaining > 1 ? 'en' : '' }} verwijderd van een badge! 🎯
                    @endif

                    <div class="w-full bg-indigo-100 rounded-full h-3 mt-2">
                        <div class="bg-indigo-500 h-3 rounded-full transition-all duration-500 ease-out" style="width: {{ $progressPercent }}%;"></div>
                    </div>
                </div>

        <!-- Student Action -->
        <p class="text-green-600 text-lg font-sans mt-6 mb-4">📚 Laten we op zoek gaan naar jouw volgende boek</p>
        <a href="{{ route('library.index') }}" class="btn-yellow">Ga naar bibliotheek 📖</a>


             <!-- 📝 Reflection Journal -->
            <div class="mt-6 bg-blue-50 text-blue-800 rounded-xl py-3 px-5 shadow">
             <p class="text-lg font-sans text-indigo-700 mt-6 mb-2">📝 Wat heb je vandaag geleerd?</p>
            <div class="flex justify-center space-x-4 mb-4">
                <button onclick="saveJournalEmoji('👍')" class="emoji-button">👍</button>
                <button onclick="saveJournalEmoji('❤️')" class="emoji-button">❤️</button>
                <button onclick="saveJournalEmoji('🤯')" class="emoji-button">🤯</button>
                <button onclick="saveJournalEmoji('👎')" class="emoji-button">👎</button>
            </div>
            <p id="emojiSaved" class="text-green-600 mt-2 hidden">Bedankt voor je feedback! ✅</p>

            <textarea id="journalEntry" class="mt-2 w-full rounded border border-blue-200 p-2 text-sm focus:outline-none focus:ring focus:ring-blue-300" rows="3" placeholder="Typ hier je reflectie..."></textarea>
            <button id="saveJournal" class="button">
            <span>O</span>
            <span>P</span>
            <span>S</span>
            <span>L</span>
            <span>A</span>
            <span>A</span>
            <span>N</span>
        </button>
            <p id="saveMessage" class="text-green-600 mt-2 text-sm hidden">Opgeslagen ✅</p>
        </div>

        <!-- 📔 Journal History -->
        <div class="mt-8">
            <h2 class="font-sans text-indigo-700 mb-4 text-xl"> Mijn Reflecties</h2>    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse ($journalEntries as $entry)
                    <div class="bg-white border border-indigo-200 rounded-xl shadow-sm p-4 hover:shadow-md transition">
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                            <span>🗓 {{ \Carbon\Carbon::parse($entry->date)->format('d M Y') }}</span>
                            <span class="text-indigo-600 font-sans">#Reflectie</span>
                        </div>
                        <p class="text-gray-800 text-3xl leading-relaxed">
                        @if (!empty($entry->emoji))
                            {{ $entry->emoji }}
                        @elseif (!empty($entry->content))
                            {{ $entry->content }}
                        @else
                            <span class="italic text-gray-400">Geen reflectie toegevoegd.</span>
                        @endif
                        </p>

                    </div>
                @empty
                    <p class="italic text-gray-500">Je hebt nog geen reflecties geschreven.</p>
                @endforelse
            </div>
        </div>


        @elseif(Auth::user()->role === 'teacher')
            <p class="text-blue-600 text-lg font-sans mb-4">🧑‍🏫 Tijd om kennis te delen</p>
            <a href="{{ route('books.index') }}" class="btn-blue">Beheer mijn boeken 📘</a>
        @endif

        <!-- 💡 Daily Tip (visible to all) -->
        <!-- <div class="mt-6 bg-indigo-100 text-indigo-800 rounded-xl py-4 px-6 shadow-inner animate-pulse-slow">
            <p class="font-family: 'Comic Neue'>💡 Tip van de dag:</p>
            <p id="dailyTip" class="mt-1 text-sm italic"></p>
        </div>
    </div> -->


    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        .typing {
            display: inline-block;
            overflow: hidden;
            border-right: .15em solid orange;
            white-space: nowrap;
            animation: typing 3s steps(40, end), blink-caret 0.75s step-end infinite;
        }

        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: orange; }
        }

        @keyframes pulse-slow {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.02); opacity: 0.9; }
        }

        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
        }

        .bg-animated-pattern {
            background: linear-gradient(270deg, #fdf6fd, #f0faff, #fdfde7, #e8fff0);
            background-size: 400% 400%;
            animation: bg-wave 20s ease infinite;
        }

        @keyframes bg-wave {
            0% { background-position: 0 0; }
            100% { background-position: 400% 0; }
        }

        .glow-text {
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from { text-shadow: 0 0 5px #9f7aea, 0 0 10px #9f7aea; }
            to { text-shadow: 0 0 10px #6b46c1, 0 0 20px #6b46c1; }
        }

        .floating-inside {
            position: absolute;
            font-size: 1.5rem;
            animation: float-inside 2s linear infinite;
            top: 100%;
            left: 10%;
            opacity: 0.7;
        }

        .floating-inside.delay-1 { left: 50%; animation-delay: 4s; }
        .floating-inside.delay-2 { left: 80%; animation-delay: 8s; }

        @keyframes float-inside {
            0% { transform: translateY(0); opacity: 0; }
            10% { opacity: 1; }
            100% { transform: translateY(-120%); opacity: 0; }
        }
        @keyframes wave {
        0% { transform: rotate(0deg); }
        15% { transform: rotate(14deg); }
        30% { transform: rotate(-8deg); }
        40% { transform: rotate(14deg); }
        50% { transform: rotate(-4deg); }
        60% { transform: rotate(10deg); }
        70% { transform: rotate(0deg); }
        100% { transform: rotate(0deg); }
        }

        .wave-emoji {
        display: inline-block;
        animation: wave 2.2s ease-in-out infinite;
        transform-origin: 70% 70%;
        }
        .button {
        cursor: pointer;
        padding: 6px 12px; /* smaller padding */
        border-radius: 20px;
        border: none;
        display: inline-block;
        overflow: hidden;
        background:rgb(162, 243, 203);
        box-shadow:
            inset 4px 4px 8px rgba(0, 0, 0, 0.1),
            inset -4px -4px 8px rgba(255, 255, 255, 0.7),
            4px 4px 8px rgba(0, 0, 0, 0.1),
            -4px -4px 8px rgba(255, 255, 255, 0.7);
        transition:
            box-shadow 0.3s ease,
            transform 0.1s ease;
        }

        .button span {
        font-family: Arial, sans-serif;
        font-weight: 900;
        font-size: 14px; /* smaller font */
        color: #555;
        text-shadow:
            1px 1px 2px rgba(0, 0, 0, 0.2),
            -1px -1px 2px rgba(255, 255, 255, 0.8);
        position: relative;
        display: inline-block;
        transition: transform 0.3s ease-out;
        z-index: 1;
        padding: 0 2px;
        }

        .button span:hover {
        transform: translateY(-4px); /* slightly smaller lift */
        color: #333;
        text-shadow:
            1px 1px 3px rgba(0, 0, 0, 0.3),
            -1px -1px 3px rgba(255, 255, 255, 0.9);
        }

        .button:hover {
        box-shadow:
            inset 2px 2px 4px rgba(0, 0, 0, 0.1),
            inset -2px -2px 4px rgba(255, 255, 255, 0.9),
            3px 3px 6px rgba(0, 0, 0, 0.1),
            -3px -3px 6px rgba(255, 255, 255, 0.9);
        }

        .button:active {
        box-shadow:
            inset 1px 1px 3px rgba(0, 0, 0, 0.2),
            inset -1px -1px 3px rgba(255, 255, 255, 0.8);
        transform: scale(0.97);
        }
        /* button yelow */
        .btn-yellow {
        position: relative;
        font-size: 16px;
        text-transform: uppercase;
        text-decoration: none;
        padding: 0.75em 2em;
        display: inline-block;
        border-radius: 50px;
        transition: all 0.3s;
        border: none;
        font-family: Arial, sans-serif;
        font-weight: 600;
        color: #3b3b3b;
        background-color: #fde047; /* Tailwind yellow-300 */
        box-shadow:
            inset 2px 2px 4px rgba(255, 255, 255, 0.6),
            inset -2px -2px 4px rgba(0, 0, 0, 0.05),
            4px 4px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        }

        .btn-yellow:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-yellow:active {
        transform: scale(0.95);
        box-shadow: none;
        }

        .btn-yellow::after {
        content: "";
        display: inline-block;
        height: 100%;
        width: 100%;
        border-radius: 50px;
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        background-color: #facc15; /* Tailwind yellow-400 */
        transition: all 0.4s;
        }

        .btn-yellow:hover::after {
        transform: scaleX(1.2) scaleY(1.4);
        opacity: 0;
        }
        /* button blue */
        .btn-blue {
        position: relative;
        font-size: 16px;
        text-transform: uppercase;
        text-decoration: none;
        padding: 0.75em 2em;
        display: inline-block;
        border-radius: 50px;
        transition: all 0.3s;
        border: none;
        font-family: Arial, sans-serif;
        font-weight: 600;
        color: #1e3a8a; /* Tailwind blue-800 */
        background-color: #bfdbfe; /* Tailwind blue-200 */
        box-shadow:
            inset 2px 2px 4px rgba(255, 255, 255, 0.6),
            inset -2px -2px 4px rgba(0, 0, 0, 0.05),
            4px 4px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        }

        .btn-blue:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-blue:active {
        transform: scale(0.95);
        box-shadow: none;
        }

        .btn-blue::after {
        content: "";
        display: inline-block;
        height: 100%;
        width: 100%;
        border-radius: 50px;
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        background-color: #93c5fd; /* Tailwind blue-300 */
        transition: all 0.4s;
        }

        .btn-blue:hover::after {
        transform: scaleX(1.2) scaleY(1.4);
        opacity: 0;
        }
        .bot-btn {
                width: 100%;
                background-color: #6366f1; /* indigo-500 */
                color: white;
                padding: 0.5rem 1rem;
                font-size: 0.75rem;
                border-radius: 0.75rem;
                transition: background 0.3s;
            }
            .bot-btn:hover {
                background-color: #4f46e5; /* indigo-600 */
            }
          .emoji-button {
         font-size: 2.2rem;
            transition: transform 0.2s ease;
             background-color: white;
             border-radius: 50%;
            padding: 10px;
             box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            }

            .emoji-button:hover {
             transform: scale(1.3);
             background-color: #e0e7ff; /* light indigo background */
            }
         .emoji-button.clicked {
          animation: pop 0.3s ease;
             }

         @keyframes pop {
         0% { transform: scale(1); }
        50% { transform: scale(1.6); }
        100% { transform: scale(1); }
         }

        .emoji-button:active {
            transform: scale(1.1);
        }
        .emoji-button:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.5); /* indigo-500 */
        }
        
    </style>

    <!-- script for  it  -->
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        // Play sound for students
        @if(Auth::user()->role === 'student')
            const sound = document.getElementById('welcomeSound');
            if (sound) sound.play();
        @endif

        // Tip of the day logic
        const tips = {
            student: [
                "📚 Wist je dat je boeken als favoriet kunt markeren met ❤️?",
                "💡 Probeer vandaag een nieuwe categorie te verkennen!",
                "📝 Vergeet niet om notities te maken terwijl je leest!",
                "🎯 Daag jezelf uit met de emoji quiz!",
            ],
            teacher: [
                "📘 Voeg vandaag een nieuw boek toe voor je klas!",
                "💡 Houd de voortgang van je studenten bij via het dashboard.",
                "🛠️ Je kunt boeken snel bewerken of verwijderen in je overzicht.",
                "✨ Vergeet niet: motivatie begint met inspiratie!",
            ]
        };

    const role = "{{ Auth::user()->role }}";
    const randomTip = tips[role][Math.floor(Math.random() * tips[role].length)];
    document.getElementById('dailyTip').textContent = randomTip;

    // Journal save
    const saveBtn = document.getElementById('saveJournal');
    if (saveBtn) {
        saveBtn.addEventListener('click', function () {
            const entry = document.getElementById('journalEntry').value;
            if (!entry.trim()) return;

            fetch('{{ route('journal.save') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ content: entry })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('saveMessage').classList.remove('hidden');
                    setTimeout(() => {
                        document.getElementById('saveMessage').classList.add('hidden');
                    }, 2000);
                }
            });
        });
    }

   // Emoji save
   window.saveJournalEmoji = function(emoji) {
    const buttons = document.querySelectorAll('.emoji-button');
    buttons.forEach(btn => {
        if (btn.textContent === emoji) {
            btn.classList.add('clicked');
            setTimeout(() => btn.classList.remove('clicked'), 300);
        }
    });

    fetch('{{ route('journal.save') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ content: emoji })
    }).then(res => res.json())
    .then(data => {
        if (data.success) {
            const saved = document.getElementById('emojiSaved');
            saved.classList.remove('hidden');
            setTimeout(() => saved.classList.add('hidden'), 2000);
        }
    });
}


    // Toggle chatbot
    document.getElementById('chatToggle').addEventListener('click', () => {
        document.getElementById('chatbot').classList.toggle('hidden');
    });

    // Chat message logic
    window.sendBotMessage = function(type) {
        const chat = document.getElementById('chatArea');
        const responses = {
            suggest: "📘 Op basis van jouw leesgeschiedenis raden we 'Het Geheim van de Zand Bibliotheek' aan!",
            readMost: "📚 Je leest het vaakst boeken in de categorie 'Avontuur' en 'Wetenschap'.",
            topBooks: "🔥 Deze week populair: 'De Knalclub – Wetenschap die niet stilzit', 'De Reis van Nova', en 'Het Ondergrondse Raadsellab'!",
            idea: "💡 Denk aan korte verhalen met illustraties voor beginnende lezers – zoals 'De kleine held' of 'Robotvrienden'.",
            mustRead: "✅ Elke leerling zou 'Het geheim van de bibliotheek' minstens één keer moeten lezen!",
            trend: "📈 Populaire boeken onder studenten deze maand: 'Stella’s Sterrenreis', 'De Klimaatdetectives', en 'Een dag zonder zwaartekracht'."
        };

        const btn = document.querySelector(`button[onclick="sendBotMessage('${type}')"]`);
        const userMsg = document.createElement('p');
        userMsg.className = "text-right bg-yellow-100 p-2 rounded-xl";
        userMsg.textContent = "👤 " + btn.innerText;
        chat.appendChild(userMsg);

        setTimeout(() => {
            const botMsg = document.createElement('p');
            botMsg.className = "bg-indigo-100 p-2 rounded-xl";
            botMsg.textContent = responses[type] || "🤖 Ik begrijp dat nog niet.";
            chat.appendChild(botMsg);
            chat.scrollTop = chat.scrollHeight;
        }, 500);
    };
});
</script>

        <!-- 📚 Chatbot Toggle Button
    <button id="chatToggle" class="fixed bottom-6 right-6 z-50 bg-indigo-600 hover:bg-indigo-700 text-white p-3 rounded-full shadow-lg">
        💬
    </button> -->

    <!-- 📢 Chatbot Box -->
    <!-- <div id="chatbot" class="fixed bottom-20 right-6 bg-white rounded-2xl shadow-2xl w-80 max-h-[500px] overflow-hidden flex flex-col z-40 hidden">
        <div class="bg-indigo-600 text-white px-4 py-3 font-bold">🤖 BookBot</div>
        <div id="chatArea" class="flex-1 p-4 space-y-2 overflow-y-auto text-sm text-gray-700">
            <p class="bg-indigo-100 p-2 rounded-xl">Hallo! Hoe kan ik je helpen?</p>
        </div>
        <div class="border-t border-gray-200 p-3 space-y-2 bg-gray-50">
            @if(Auth::user()->role === 'student')
                <button onclick="sendBotMessage('suggest')" class="bot-btn">📖  Heb je een boekentip voor mij?</button>
                <button onclick="sendBotMessage('readMost')" class="bot-btn">📊 Wat lees ik het meest?</button>
                <button onclick="sendBotMessage('topBooks')" class="bot-btn">🔥 Topboeken van deze week</button>
            @elseif(Auth::user()->role === 'teacher')
                <button onclick="sendBotMessage('idea')" class="bot-btn">💡 Boekideeën voor studenten</button>
                <button onclick="sendBotMessage('mustRead')" class="bot-btn">✅ Boeken die elke student moet lezen</button>
                <button onclick="sendBotMessage('trend')" class="bot-btn">📈 Populair deze maand</button>
            @endif
        </div>
    </div> -->

    <!--test  -->
    <script>
document.addEventListener("DOMContentLoaded", () => {
    const starsContainer = document.getElementById("falling-stars");
    if (!starsContainer) return;

    function createStarOrBubble() {
        const el = document.createElement("div");
        el.classList.add(Math.random() > 0.5 ? 'star' : 'bubble');
        el.style.left = Math.random() * 100 + "vw";
        el.style.animationDuration = (Math.random() * 7 + 8) + "s";
        el.innerHTML = Math.random() > 0.5 ? "⭐" : "🔵";
        starsContainer.appendChild(el);

        setTimeout(() => el.remove(), 12000);
    }

    setInterval(createStarOrBubble, 500);
});
</script>

    

</x-app-layout>
