<!-- 🔊 Sound FX -->
<audio id="moveSound" src="{{ asset('sounds/moveSound.mp3') }}" preload="auto"></audio>
<audio id="winSound" src="{{ asset('sounds/winSound.mp3') }}" preload="auto"></audio>
<audio id="failSound" src="{{ asset('sounds/failSound.mp3') }}" preload="auto"></audio>
<audio id="tickSound" src="{{ asset('sounds/tickSound.mp3') }}" preload="auto"></audio>

<!-- 🎉 Confetti Library -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-yellow-100 via-pink-100 to-green-100 py-12 px-6 flex flex-col items-center">
        <h1 class="text-4xl font-extrabold text-center text-indigo-800 mb-4">⚔️ Woordenstrijd – 2 Spelers</h1>
        <p class="text-gray-700 mb-8 text-center max-w-xl">Typ het juiste woord voordat de tijd op is! Beurt per beurt. 🕒</p>

        <!-- 🔁 Start Button -->
        <div id="startArea" class="text-center mt-6">
            <button id="startBtn" onclick="startGame()" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full text-lg shadow-lg transition hover:scale-105">
                🎮 Start Spel
            </button>
        </div>

      


        <!-- 🎮 Game Box -->
        <div id="gameBox" class="bg-white rounded-2xl shadow-xl p-6 max-w-xl w-full text-center relative hidden">
            <h2 class="text-xl font-bold text-indigo-700 mb-2">Beurt: <span id="turnPlayer">Speler 1</span></h2>
            <p class="text-lg text-gray-700 mb-4">Wat is het juiste woord voor:</p>
            <div class="text-2xl font-semibold text-purple-700 mb-6" id="wordHint">...</div>

            <input type="text" id="playerInput" class="border-2 rounded w-full px-4 py-2 mb-4" placeholder="Typ hier het woord...">
            
            <button onclick="submitAnswer()" 
                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-full transition-all duration-300 animate-pulse">
                ✅ Bevestigen
            </button>

            <div class="mt-4 font-bold text-lg fade" id="feedback"></div>

            <!-- Timer -->
            <div class="absolute top-4 right-4 text-sm text-red-500 font-semibold">⏱️ Tijd: <span id="timer">10</span>s</div>
        </div>
          <!-- 🚗 Race Track -->
          <div class="absolute right-0 top-0 h-full w-1 bg-red-600 z-10"></div>

          <div class="w-full max-w-3xl mb-10">
            <div class="mb-2 text-center text-lg font-bold text-indigo-700">🚗 Race naar de overwinning!</div>
            <div class="absolute right-0 top-0 h-full w-1 bg-red-600 z-10"></div>

            <div class="relative bg-gray-200 h-12 rounded-full mb-6 overflow-hidden">
                <img id="car1" src="{{ asset('images/red-car.png') }}" class="absolute left-0 top-1 w-10 h-10 transition-all duration-500">
            </div>
            <div class="absolute right-0 top-0 h-full w-1 bg-red-600 z-10"></div>

            <div class="relative bg-gray-200 h-12 rounded-full overflow-hidden">
                <img id="car2" src="{{ asset('images/grean-car.png') }}" class="absolute left-0 top-1 w-10 h-10 transition-all duration-500">
            </div>
        </div>
        <!-- 🏁 Winner Screen Placeholder -->
        <div id="winnerScreen" class="hidden"></div>

        <!-- 📊 Scoreboard -->
        <div class="mt-10 text-center">
            <p class="text-xl text-indigo-700">🎯 Score</p>
            <p class="text-lg">Speler 1: <span id="score1">0</span> | Speler 2: <span id="score2">0</span></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <style>
        .fade {
            transition: all 0.5s ease;
            opacity: 0;
        }
        .fade.show {
            opacity: 1;
        }
        .turn-flash {
            animation: flashTurn 0.4s ease-in-out;
        }

        @keyframes flashTurn {
            0% { transform: scale(1); background-color: #fef3c7; }
            50% { transform: scale(1.05); background-color: #fde68a; }
            100% { transform: scale(1); background-color: transparent; }
        }
    </style>


<script>
const wordSets = {
    makkelijk: [
        { hint: "Een rode vrucht 🍎", answer: "appel" },
        { hint: "Gele vrucht 🍌", answer: "banaan" },
        { hint: "Dier dat blaft 🐶", answer: "hond" },
        { hint: "Je leest het 📖", answer: "boek" },
        { hint: "Je schrijft ermee ✏️", answer: "pen" },
        { hint: "Het is nat en drinkbaar 💧", answer: "water" },
        { hint: "Je trekt het aan 👟", answer: "schoen" },
        { hint: "Tegenovergestelde van dag 🌙", answer: "nacht" },
        { hint: "Iets dat je leest op school 📘", answer: "schrift" },
        { hint: "Beroep in de rechtbank ⚖️", answer: "advocaat" }
    ],
    gemiddeld: [
        { hint: "Iets dat vliegt ✈️", answer: "vliegtuig" },
        { hint: "Iets dat je leest op school 📘", answer: "schrift" },
        { hint: "Groene groente 🥦", answer: "broccoli" },
        { hint: "Je gebruikt het om te luisteren 🎧", answer: "koptelefoon" },
        { hint: "Waar je mee tekent 🎨", answer: "kwast" },
        { hint: "Voorwerpen in je klas 🪑", answer: "stoelen" },
        { hint: "Iets wat rijdt 🚗", answer: "auto" },
        { hint: "Tegenovergestelde van dag 🌙", answer: "nacht" },
        { hint: "Beroep in de rechtbank ⚖️", answer: "advocaat" },
        { hint: "Wat je gebruikt in chemie 🧪", answer: "pipet" }
    ],
    moeilijk: [
        { hint: "Iets dat elektriciteit meet ⚡", answer: "volt" },
        { hint: "Wat je gebruikt in chemie 🧪", answer: "pipet" },
        { hint: "Een planeet met ringen 🪐", answer: "saturnus" },
        { hint: "Tegenstelling van introvert 😎", answer: "extravert" },
        { hint: "Kunst met woorden ✍️", answer: "poëzie" },
        { hint: "Vogels migreren in deze tijd 🍂", answer: "herfst" },
        { hint: "Hoofdstad van Frankrijk 🗼", answer: "parijs" },
        { hint: "Beroep in de rechtbank ⚖️", answer: "advocaat" },
        { hint: "Natuurkundig verschijnsel 🌪️", answer: "tornado" },
        { hint: "Eenhoorn met vleugels 🦄", answer: "pegasus" }
    ]
};


// Globals
let rounds = [];
let player1Turns = 0;
let player2Turns = 0;
const maxTurnsPerPlayer = 5;
let currentRound = 0;
let currentPlayer = 1;
let score1 = 0;
let score2 = 0;
let timer;
let timeLeft = 10;

// Sounds
const moveSound = document.getElementById("moveSound");
const winSound = document.getElementById("winSound");
const failSound = document.getElementById("failSound");
const tickSound = document.getElementById("tickSound");

function startGame() {
    document.getElementById("startArea").classList.add("hidden");
    document.getElementById("gameBox").classList.remove("hidden");
    resetGame();

    const sets = Object.entries(wordSets).filter(([_, words]) => words.length >= maxTurnsPerPlayer * 2);
    
    if (sets.length === 0) {
        alert("Geen enkele woordenset bevat genoeg woorden! Voeg meer toe.");
        return;
    }

    const [setName, selectedWords] = sets[Math.floor(Math.random() * sets.length)];
    rounds = shuffleArray(selectedWords).slice(0, maxTurnsPerPlayer * 2);
    
    loadRound();
}


function resetGame() {
    score1 = 0;
    score2 = 0;
    currentRound = 0;
    currentPlayer = 1;
    player1Turns = 0;
    player2Turns = 0;
    document.getElementById("score1").textContent = "0";
    document.getElementById("score2").textContent = "0";
    moveCar("car1", 0);
    moveCar("car2", 0);
}

function shuffleArray(arr) {
    return arr.slice().sort(() => Math.random() - 0.5);
}

function loadRound() {
    if (currentRound >= rounds.length) return;

    const word = rounds[currentRound];
    document.getElementById("wordHint").textContent = word.hint;
    document.getElementById("turnPlayer").textContent = `Speler ${currentPlayer}`;

    // Counter update
    const counter = document.getElementById("turnCounter");
    if (counter) counter.textContent = `Beurt ${player1Turns + player2Turns + 1} van ${maxTurnsPerPlayer * 2}`;
    else {
        const newCounter = document.createElement("div");
        newCounter.id = "turnCounter";
        newCounter.className = "mt-2 text-sm text-indigo-600";
        newCounter.textContent = `Beurt ${player1Turns + player2Turns + 1} van ${maxTurnsPerPlayer * 2}`;
        document.getElementById("gameBox").appendChild(newCounter);
    }

    document.getElementById("playerInput").value = "";
    document.getElementById("feedback").textContent = "";
    document.getElementById("feedback").classList.remove("show");

    startTimer();
}

function startTimer() {
    clearInterval(timer);
    timeLeft = 10;
    document.getElementById("timer").textContent = timeLeft;
    tickSound.currentTime = 0;
    tickSound.play();

    timer = setInterval(() => {
        timeLeft--;
        document.getElementById("timer").textContent = timeLeft;
        if (timeLeft <= 0) {
            clearInterval(timer);
            tickSound.pause();
            handleTimeOut();
        }
    }, 1000);
}

function handleTimeOut() {
    failSound.play();
    showFeedback(`⏰ Tijd is op! Het juiste woord was "${rounds[currentRound].answer}"`, false);
    nextTurn();
}

function submitAnswer() {
    const input = document.getElementById("playerInput").value.trim().toLowerCase();
    const correct = rounds[currentRound].answer;
    clearInterval(timer);
    tickSound.pause();

    if (input === correct) {
        showFeedback("✅ Goed gedaan!", true);
        moveSound.play();

        if (currentPlayer === 1) {
            score1++;
            document.getElementById("score1").textContent = score1;
            moveCar("car1", score1);
        } else {
            score2++;
            document.getElementById("score2").textContent = score2;
            moveCar("car2", score2);
        }
    } else {
        failSound.play();
        showFeedback(`❌ Fout. Het juiste antwoord was "${correct}"`, false);
    }

    nextTurn();
}

function moveCar(carId, score) {
    const car = document.getElementById(carId);
    const position = (score / maxTurnsPerPlayer) * 90;
    car.style.left = `${position}%`;
    car.classList.add("scale-110");
    setTimeout(() => car.classList.remove("scale-110"), 300);
}

function showFeedback(message, correct) {
    const el = document.getElementById("feedback");
    el.textContent = message;
    el.classList.add("show");
    el.classList.remove("text-red-500", "text-green-500");
    el.classList.add(correct ? "text-green-500" : "text-red-500");
}

function nextTurn() {
    if (currentPlayer === 1) player1Turns++;
    else player2Turns++;

    currentPlayer = currentPlayer === 1 ? 2 : 1;
    currentRound++;

    if (player1Turns >= maxTurnsPerPlayer && player2Turns >= maxTurnsPerPlayer) {
        setTimeout(showWinner, 1500);
    } else {
        setTimeout(loadRound, 1500);
    }
}

function showWinner() {
    let message = "🤝 Gelijkspel!";
    if (score1 > score2) message = "🏆 Speler 1 wint!";
    else if (score2 > score1) message = "🏆 Speler 2 wint!";

    winSound.play();
    confetti({ particleCount: 200, spread: 120, origin: { y: 0.6 } });

    // 👇 Hide game content
    document.getElementById("gameBox").classList.add("hidden");
    document.getElementById("startArea").classList.add("hidden");

    // 👇 Show styled winner screen inside placeholder
    const screen = document.getElementById("winnerScreen");
    screen.classList.remove("hidden");
    screen.innerHTML = `
        <div class="flex flex-col justify-center items-center text-center bg-gradient-to-br from-pink-100 to-green-100 py-12 px-6 rounded-xl shadow-xl mt-10 max-w-2xl mx-auto">
            <h1 class="text-4xl font-extrabold text-indigo-800 mb-6 animate-bounce">${message}</h1>
            <p class="text-xl text-gray-700 mb-2">🎯 Eindscore:</p>
            <p class="text-lg text-indigo-600 mb-6">Speler 1: ${score1} | Speler 2: ${score2}</p>
            <a href='${window.location.href}' 
               class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-full transition hover:scale-105">
               🔁 Opnieuw spelen
            </a>
        </div>
    `;
}

</script>


</x-app-layout>
