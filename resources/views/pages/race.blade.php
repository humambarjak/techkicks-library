<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <audio id="winSound" src="/sounds/Win.mp3" preload="auto"></audio>

    <style>
        .car-track { height: 100px; position: relative; overflow: hidden; }
        .car { position: absolute; bottom: 0; transition: left 0.1s linear, transform 0.2s; height: 50px; }
        .nitro { filter: drop-shadow(0 0 10px #38bdf8); transform: scale(1.1); }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 py-12 px-6 flex flex-col items-center">
        <h1 class="text-4xl font-extrabold text-center text-indigo-800 mb-6">🏁 TypRace – Meerdere Ronden</h1>
        <p class="text-center max-w-2xl text-gray-700 text-lg mb-4">Speel 3 ronden. Wie het vaakst wint, is de ultieme typkampioen! 💪</p>

        <div class="mb-6 flex gap-4 items-center flex-wrap justify-center">
            <button onclick="startGame()" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-full shadow">🔄 Start ronde</button>
            <button onclick="clearScores()" class="bg-red-400 hover:bg-red-500 text-white font-semibold px-4 py-2 rounded-full shadow">🗑️ Verwijder geschiedenis</button>
            <span id="timer" class="text-lg font-bold text-indigo-800">⏱️ 0s</span>
            <span id="roundLabel" class="text-md text-gray-800">🔁 Huidige beurt: Speler <span id="roundNumber">1</span></span>
        </div>

        <div class="text-center text-lg text-indigo-800 font-semibold mb-4">
            🧮 Stand: Speler 1 (<span id="p1Wins">0</span>) – Speler 2 (<span id="p2Wins">0</span>)
        </div>

        <div id="prompt" class="bg-white text-indigo-700 font-semibold text-lg border border-indigo-300 px-6 py-4 rounded-xl shadow mb-8 text-center">Loading...</div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 w-full max-w-5xl">
            <div class="bg-white rounded-2xl p-6 shadow-xl">
                <h2 class="text-xl font-bold text-indigo-700 mb-4">👤 Speler 1</h2>
                <div class="car-track bg-gray-200 rounded mb-2">
                    <img src="/images/car1.png" id="car1" class="car" style="left: 0;">
                </div>
                <textarea id="player1" rows="4" class="w-full border border-indigo-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-indigo-400" placeholder="Begin met typen..." disabled></textarea>
                <p id="p1-status" class="text-sm mt-2 text-gray-600">⏳ Wachten op start...</p>
                <p class="text-sm text-indigo-600 mt-1">⏱️ Tijd: <span id="p1-time">-</span></p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xl">
                <h2 class="text-xl font-bold text-indigo-700 mb-4">👤 Speler 2</h2>
                <div class="car-track bg-gray-200 rounded mb-2">
                    <img src="/images/car2.png" id="car2" class="car" style="left: 0;">
                </div>
                <textarea id="player2" rows="4" class="w-full border border-indigo-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-indigo-400" placeholder="Begin met typen..." disabled></textarea>
                <p id="p2-status" class="text-sm mt-2 text-gray-600">⏳ Wachten op Speler 1...</p>
                <p class="text-sm text-indigo-600 mt-1">⏱️ Tijd: <span id="p2-time">-</span></p>
            </div>
        </div>

        <div id="winner" class="text-2xl font-bold text-green-600 mt-10 hidden">🎉 <span id="winner-name"></span> wint deze ronde!</div>

        <div id="finalWinner" class="text-3xl font-extrabold text-indigo-800 mt-10 hidden">🏆 <span id="final-winner-name"></span> wint het spel!</div>

        <div class="bg-white rounded-xl shadow-md p-6 mt-12 max-w-3xl w-full">
            <h2 class="text-lg font-bold text-indigo-800 mb-4">📜 Score Geschiedenis</h2>
            <ul id="scoreHistory" class="space-y-3"></ul>
        </div>
    </div>

    <script>
        const TOTAL_ROUNDS = 3;
        let currentRound = 1;
        let p1Wins = 0;
        let p2Wins = 0;

        const sentences = [
            "De zon schijnt helder terwijl kinderen in het park spelen.",
            "Mijn kat springt elke ochtend op het raamkozijn.",
            "We wandelen graag langs het strand bij zonsondergang.",
            "Het boek lag op tafel naast een kop warme thee.",
            "Vogels fluiten vrolijk in de lenteochtend."
        ];

        const player1 = document.getElementById('player1');
        const player2 = document.getElementById('player2');
        const car1 = document.getElementById('car1');
        const car2 = document.getElementById('car2');
        const p1TimeBox = document.getElementById('p1-time');
        const p2TimeBox = document.getElementById('p2-time');
        const p1Status = document.getElementById('p1-status');
        const p2Status = document.getElementById('p2-status');
        const roundNumber = document.getElementById('roundNumber');
        const timerBox = document.getElementById('timer');
        const winnerBox = document.getElementById('winner');
        const finalWinner = document.getElementById('finalWinner');
        const winnerName = document.getElementById('winner-name');
        const finalWinnerName = document.getElementById('final-winner-name');
        const scoreHistory = document.getElementById('scoreHistory');
        const winSound = document.getElementById('winSound');
        const promptBox = document.getElementById('prompt');

        const p1WinCount = document.getElementById('p1Wins');
        const p2WinCount = document.getElementById('p2Wins');

        let currentPrompt = "";
        let round = 1;
        let timer = 0;
        let interval;
        let p1Time = 0;
        let p2Time = 0;

        function startGame() {
            finalWinner.classList.add("hidden");
            winnerBox.classList.add("hidden");
            currentPrompt = sentences[Math.floor(Math.random() * sentences.length)];
            promptBox.textContent = currentPrompt;
            player1.value = "";
            player2.value = "";
            car1.style.left = "0px";
            car2.style.left = "0px";
            car1.classList.remove("nitro");
            car2.classList.remove("nitro");
            p1Status.textContent = "⏳ Bezig...";
            p2Status.textContent = "⏳ Wachten op Speler 1...";
            player1.disabled = false;
            player2.disabled = true;
            round = 1;
            roundNumber.textContent = "1";
            timer = 0;
            timerBox.textContent = `⏱️ 0s`;
            clearInterval(interval);
            interval = setInterval(() => {
                timer++;
                timerBox.textContent = `⏱️ ${timer}s`;
            }, 1000);
        }

        function clearScores() {
            localStorage.removeItem('typRaceScores');
            scoreHistory.innerHTML = '';
            p1Wins = 0;
            p2Wins = 0;
            p1WinCount.textContent = "0";
            p2WinCount.textContent = "0";
            finalWinner.classList.add("hidden");
        }

        function updateCar(textArea, promptText, carEl) {
            const container = textArea.parentElement.querySelector('.car-track');
            const progress = textArea.value.length / promptText.length;
            const containerWidth = container.offsetWidth;
            const carWidth = 50;
            const maxLeft = containerWidth - carWidth;
            carEl.style.left = `${Math.min(progress * maxLeft, maxLeft)}px`;

            const wpm = textArea.value.length / 5 / (timer / 60);
            if (wpm > 30) carEl.classList.add('nitro');
            else carEl.classList.remove('nitro');
        }

        function finishRound(player, textArea) {
            clearInterval(interval);
            if (player === 1) {
                p1Time = timer;
                p1TimeBox.textContent = `${p1Time}s`;
                player1.disabled = true;
                p1Status.textContent = "✅ Klaar!";
                round = 2;
                roundNumber.textContent = "2";
                timer = 0;
                timerBox.textContent = "⏱️ 0s";
                player2.disabled = false;
                p2Status.textContent = "⏳ Bezig...";
                interval = setInterval(() => {
                    timer++;
                    timerBox.textContent = `⏱️ ${timer}s`;
                }, 1000);
            } else {
                p2Time = timer;
                p2TimeBox.textContent = `${p2Time}s`;
                player2.disabled = true;
                p2Status.textContent = "✅ Klaar!";
                showWinner();
            }
        }

        function showWinner() {
            clearInterval(interval);
            let winner;
            if (p1Time < p2Time) {
                winner = "Speler 1";
                p1Wins++;
            } else if (p2Time < p1Time) {
                winner = "Speler 2";
                p2Wins++;
            } else {
                winner = "Gelijkspel!";
            }

            p1WinCount.textContent = p1Wins;
            p2WinCount.textContent = p2Wins;
            winnerName.textContent = winner;
            winnerBox.classList.remove("hidden");
            confetti();
            winSound.play();
            saveToLocalHistory(p1Time, p2Time, winner);

            if (p1Wins >= TOTAL_ROUNDS / 2 + 0.5 || p2Wins >= TOTAL_ROUNDS / 2 + 0.5) {
                finalWinnerName.textContent = p1Wins > p2Wins ? "Speler 1" : "Speler 2";
                finalWinner.classList.remove("hidden");
            } else {
                setTimeout(() => startGame(), 3000);
            }
        }

        function saveToLocalHistory(p1, p2, winner) {
            const data = JSON.parse(localStorage.getItem('typRaceScores') || '[]');
            data.push({ p1, p2, winner, date: new Date().toLocaleString() });
            localStorage.setItem('typRaceScores', JSON.stringify(data));
            renderScoreHistory();
        }

        function renderScoreHistory() {
            const data = JSON.parse(localStorage.getItem('typRaceScores') || '[]');
            scoreHistory.innerHTML = data.map(d => `
                <li class="flex items-center justify-between border-l-4 p-3 rounded-xl shadow-sm ${d.winner === 'Speler 1' ? 'border-green-400 bg-green-50' : d.winner === 'Speler 2' ? 'border-yellow-400 bg-yellow-50' : 'border-gray-300 bg-gray-50'}">
                    <div>
                        <div class="text-sm font-semibold text-indigo-800">P1: ${d.p1}s – P2: ${d.p2}s</div>
                        <div class="text-xs text-gray-500">${d.date}</div>
                    </div>
                    <div class="text-right">
                        <span class="font-bold text-sm ${d.winner === 'Speler 1' ? 'text-green-700 animate-pulse' : d.winner === 'Speler 2' ? 'text-yellow-700 animate-pulse' : 'text-gray-700'}">
                            ${d.winner === 'Gelijkspel!' ? '🤝 Gelijkspel' : '🏆 ' + d.winner}
                        </span>
                    </div>
                </li>`).reverse().join('');
        }

        renderScoreHistory();

        player1.addEventListener('input', () => {
            updateCar(player1, currentPrompt, car1);
            if (player1.value.trim() === currentPrompt && round === 1) finishRound(1, player1);
        });

        player2.addEventListener('input', () => {
            updateCar(player2, currentPrompt, car2);
            if (player2.value.trim() === currentPrompt && round === 2) finishRound(2, player2);
        });
    </script>
</x-app-layout>
