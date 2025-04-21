<x-app-layout>
    <!-- 🎊 Confetti & Sound Files -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <audio id="sound-correct" src="/sounds/bonus.mp3" preload="auto"></audio>
    <audio id="sound-wrong" src="/sounds/Fail.mp3" preload="auto"></audio>
    <audio id="sound-win" src="/sounds/Win.mp3" preload="auto"></audio>

    <div class="min-h-screen bg-gradient-to-br from-pink-100 via-yellow-100 to-green-100 py-12 px-6 flex flex-col items-center">
        <h1 class="text-4xl font-extrabold text-center text-indigo-800 mb-4">🧠 Emoji Betekenis Quiz</h1>
        <p class="text-gray-700 mb-6 text-center max-w-xl">Raad wat deze emoji’s betekenen! Beurt per beurt. 🕒</p>

        <!-- Start Button -->
        <div id="startArea" class="mb-6">
            <button onclick="startGame()" class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-full text-lg shadow-lg transition hover:scale-105">
                🎮 Start Spel
            </button>
        </div>

        <!-- Game Box -->
        <div id="gameBox" class="hidden bg-white rounded-xl shadow-xl p-6 max-w-xl w-full text-center relative">
            <h2 class="text-xl font-bold text-indigo-700 mb-2">Beurt: <span id="turnPlayer">Speler 1</span></h2>
            <p class="text-4xl mb-6" id="emojiCombo">🤔❓</p>

            <input id="playerInput" type="text" placeholder="Wat betekenen de emoji's?" class="border-2 rounded w-full px-4 py-2 mb-4">
            <button onclick="submitAnswer()" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-full">✅ Bevestigen</button>

            <div id="feedback" class="mt-4 font-bold text-lg fade"></div>
            <div class="absolute top-4 right-4 text-sm text-red-500 font-semibold">⏱️ Tijd: <span id="timer">10</span>s</div>
        </div>

        <!-- Scoreboard -->
        <div class="mt-10 text-center">
            <p class="text-xl text-indigo-700">🎯 Score</p>
            <p class="text-lg">Speler 1: <span id="score1">0</span> | Speler 2: <span id="score2">0</span></p>
        </div>

        <!-- Winner -->
        <div id="winnerScreen" class="hidden mt-10"></div>
    </div>

    <style>
       @keyframes fade-glow {
    0% {
        opacity: 0;
        transform: translateY(20px) scale(0.98);
        box-shadow: 0 0 0 rgba(0,0,0,0);
    }
    100% {
        opacity: 1;
        transform: translateY(0) scale(1);
        box-shadow: 0 0 20px rgba(139, 92, 246, 0.4); /* soft purple glow */
    }
}

.animate-glow {
    animation: fade-glow 0.8s ease-out both;
}

.fade {
    transition: all 0.5s ease;
    opacity: 0;
}

.fade.show {
    opacity: 1;
}
    </style>

    <script>
        const emojis = [
            { emoji: "🔥📚", answer: "spannend boek" },
            { emoji: "🌧️☔", answer: "regenachtig weer" },
            { emoji: "🍕🎉", answer: "pizza feestje" },
            { emoji: "💤📖", answer: "saai boek" },
            { emoji: "🎓🎉", answer: "afstuderen" },
            { emoji: "🚴‍♂️🌳", answer: "fietsen in de natuur" },
            { emoji: "💡📘", answer: "leerzaam boek" },
        ];

        let currentRound = 0;
        let rounds = [];
        let currentPlayer = 1;
        let score1 = 0;
        let score2 = 0;
        let timer;
        let timeLeft = 10;

        function startGame() {
            document.getElementById("startArea").classList.add("hidden");
            document.getElementById("gameBox").classList.remove("hidden");
            resetGame();
            rounds = shuffleArray(emojis).slice(0, 6);
            loadRound();
        }

        function resetGame() {
            currentRound = 0;
            score1 = 0;
            score2 = 0;
            currentPlayer = 1;
            document.getElementById("score1").textContent = 0;
            document.getElementById("score2").textContent = 0;
        }

        function loadRound() {
            if (currentRound >= rounds.length) return showWinner();

            const round = rounds[currentRound];
            document.getElementById("emojiCombo").textContent = round.emoji;
            document.getElementById("turnPlayer").textContent = `Speler ${currentPlayer}`;
            document.getElementById("feedback").classList.remove("show");
            document.getElementById("playerInput").value = "";
            startTimer();
        }

        function shuffleArray(arr) {
            return arr.sort(() => Math.random() - 0.5);
        }

        function startTimer() {
            clearInterval(timer);
            timeLeft = 10;
            document.getElementById("timer").textContent = timeLeft;

            timer = setInterval(() => {
                timeLeft--;
                document.getElementById("timer").textContent = timeLeft;
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    handleTimeout();
                }
            }, 1000);
        }

        function handleTimeout() {
            playSound("wrong");
            showFeedback(`⏰ Tijd op! Antwoord was: "${rounds[currentRound].answer}"`, false);
            nextTurn();
        }

        function submitAnswer() {
            clearInterval(timer);
            const input = document.getElementById("playerInput").value.trim().toLowerCase();
            const correct = rounds[currentRound].answer.toLowerCase();

            if (input === correct) {
                playSound("correct");
                showFeedback("✅ Goed gedaan!", true);
                if (currentPlayer === 1) {
                    score1++;
                    document.getElementById("score1").textContent = score1;
                } else {
                    score2++;
                    document.getElementById("score2").textContent = score2;
                }
            } else {
                playSound("wrong");
                showFeedback(`❌ Fout. Antwoord was: "${correct}"`, false);
            }

            nextTurn();
        }

        function showFeedback(msg, correct) {
            const el = document.getElementById("feedback");
            el.textContent = msg;
            el.classList.add("show");
            el.classList.remove("text-green-500", "text-red-500");
            el.classList.add(correct ? "text-green-500" : "text-red-500");
        }

        function nextTurn() {
            currentRound++;
            currentPlayer = currentPlayer === 1 ? 2 : 1;

            if (currentRound < rounds.length) {
                setTimeout(loadRound, 1500);
            } else {
                setTimeout(showWinner, 1500);
            }
        }

        function showWinner() {
    let message = "🤝 Gelijkspel!";
    let emoji = "🤝";

    if (score1 > score2) {
        message = "🏆 Speler 1 wint!";
        emoji = "🥇";
    } else if (score2 > score1) {
        message = "🏆 Speler 2 wint!";
        emoji = "🥇";
    }

    playSound("win");
    confetti({ particleCount: 200, spread: 100 });

    document.getElementById("gameBox").classList.add("hidden");
    document.getElementById("winnerScreen").classList.remove("hidden");
    document.getElementById("winnerScreen").innerHTML = `
        <div class="bg-gradient-to-br from-indigo-100 via-pink-100 to-yellow-100 p-8 rounded-3xl shadow-2xl border-2 border-indigo-300 animate-glow max-w-xl mx-auto text-center">
            <h2 class="text-4xl font-extrabold mb-4 text-indigo-800 drop-shadow-sm">${emoji} ${message}</h2>
            <p class="text-lg text-gray-800 font-semibold mb-2">Speler 1: ${score1} | Speler 2: ${score2}</p>
            <a href="${window.location.href}" class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3 rounded-full shadow-lg transition-transform transform hover:scale-105">
                🔁 Opnieuw spelen
            </a>
        </div>
    `;
}


        function playSound(type) {
            if (type === "correct") document.getElementById("sound-correct").play();
            if (type === "wrong") document.getElementById("sound-wrong").play();
            if (type === "win") document.getElementById("sound-win").play();
        }
    </script>
</x-app-layout>
