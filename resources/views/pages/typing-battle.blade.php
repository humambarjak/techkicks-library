<x-app-layout>
<x-slot name="header">
    <h2 class="text-3xl font-extrabold text-center text-indigo-700 mt-4 drop-shadow animate-fade-in-top">
        🚀 Typing Battle – Versla de vallende woorden!
    </h2>
</x-slot>

@push('styles')
<style>
    body {
        overflow: hidden;
        background: url('/images/hunter.gif') no-repeat center center fixed;
        background-size: cover;
    }
    .game-area {
        position: relative;
        width: 100%;
        height: 80vh;
        background: rgba(0,0,0,0.4);
        border-radius: 1.5rem;
        overflow: hidden;
        margin-top: 2rem;
        box-shadow: 0 0 30px rgba(0,255,255,0.2);
    }
    .enemy-word {
        position: absolute;
        font-size: 2rem;
        font-weight: bold;
        color: white;
        text-shadow: 0 0 5px #00ffff, 0 0 10px #00ffff;
        background: rgba(0,0,0,0.5);
        padding: 0.4rem 1rem;
        border-radius: 0.5rem;
    }
    .player {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 60px;
        background: url('/images/spaceship.png') no-repeat center;
        background-size: contain;
        z-index: 10;
    }
    .bullet {
        position: absolute;
        width: 3px;
        height: 30px;
        background: linear-gradient(to top, #00f0ff, #0077ff);
        box-shadow: 0 0 10px #00f0ff;
        z-index: 9;
    }
    .health-bar {
        width: 100%;
        background: #e0e7ff;
        height: 20px;
        border-radius: 9999px;
        margin: 1rem 0;
        overflow: hidden;
    }
    .health-inner {
        height: 100%;
        background: #34d399;
        width: 100%;
        transition: width 0.5s;
    }
    .game-over-screen {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        color: white;
        display: none;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        font-size: 2rem;
        font-weight: bold;
        border-radius: 1.5rem;
        z-index: 20;
    }
    .restart-btn {
        margin-top: 1rem;
        background: #4f46e5;
        padding: 0.5rem 1.5rem;
        border-radius: 9999px;
        color: white;
        cursor: pointer;
    }
</style>
@endpush

<div class="max-w-5xl mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <div class="w-2/3">
            <div class="health-bar">
                <div id="health" class="health-inner"></div>
            </div>
        </div>
        <div class="text-indigo-700 font-bold text-lg">
            Score: <span id="score">0</span>
        </div>
        <button id="muteButton" class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded-full">🔊</button>
    </div>

    <div id="gameArea" class="game-area">
        <div id="player" class="player"></div>
        <div id="gameOver" class="game-over-screen">
            Game Over!<br>Score: <span id="finalScore"></span>
            <div id="restartButton" class="restart-btn">🔄 Play Again</div>
        </div>
    </div>

    <input id="hiddenInput" type="text" class="opacity-0 pointer-events-none absolute">
    <audio id="shootSound" src="/sounds/pew.mp3" preload="auto"></audio>
    <audio id="bgMusic" src="/sounds/music.mp3" preload="auto" loop></audio>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const wordsList = ["boek", "wetenschap", "avontuur", "geschiedenis", "bibliotheek", "fantasie", "onderwijs"];
    const gameArea = document.getElementById('gameArea');
    const hiddenInput = document.getElementById('hiddenInput');
    const healthBar = document.getElementById('health');
    const scoreCounter = document.getElementById('score');
    const shootSound = document.getElementById('shootSound');
    const bgMusic = document.getElementById('bgMusic');
    const muteButton = document.getElementById('muteButton');
    const gameOverScreen = document.getElementById('gameOver');
    const finalScore = document.getElementById('finalScore');
    const restartButton = document.getElementById('restartButton');
    const player = document.getElementById('player');

    let currentEnemy = null;
    let targetWord = null;
    let health = 100;
    let score = 0;
    let gameRunning = false;
    let fallSpeed = 1;

    function createWord() {
        const word = wordsList[Math.floor(Math.random() * wordsList.length)];
        const div = document.createElement('div');
        div.className = 'enemy-word';
        div.dataset.word = word;
        div.dataset.progress = '0';
        div.style.left = '50%';
        div.style.transform = 'translateX(-50%)';
        div.style.top = '0px';
        div.innerText = word;
        gameArea.appendChild(div);
        currentEnemy = div;
        targetWord = div;
    }

    function moveWord() {
        if (currentEnemy && gameRunning) {
            const top = parseFloat(currentEnemy.style.top);
            currentEnemy.style.top = (top + fallSpeed) + 'px';
            if (top > gameArea.clientHeight - 100) {
                loseHealth(20);
                currentEnemy.remove();
                currentEnemy = null;
                targetWord = null;
                setTimeout(createWord, 1000);
            }
        }
    }

    function loseHealth(amount) {
        health -= amount;
        if (health < 0) health = 0;
        healthBar.style.width = health + '%';
        if (health <= 0) endGame();
    }

    function shootLetter(letter) {
        if (targetWord) {
            let progress = parseInt(targetWord.dataset.progress);
            const word = targetWord.dataset.word;
            if (word[progress] && word[progress].toLowerCase() === letter.toLowerCase()) {
                progress++;
                targetWord.dataset.progress = progress;
                targetWord.innerHTML = `<span style="color:#ffcc00;text-shadow:0 0 5px #ffcc00;">${word.substring(0,progress)}</span>${word.substring(progress)}`;
                if (progress === word.length) {
                    shootSound.play();
                    targetWord.remove();
                    currentEnemy = null;
                    targetWord = null;
                    score += 10;
                    scoreCounter.textContent = score;
                    setTimeout(createWord, 1000);
                }
            }
        }
    }

    function gameLoop() {
        if (gameRunning) {
            moveWord();
            requestAnimationFrame(gameLoop);
        }
    }

    function startGame() {
        gameRunning = true;
        health = 100;
        score = 0;
        healthBar.style.width = '100%';
        scoreCounter.textContent = 0;
        hiddenInput.value = '';
        hiddenInput.focus();
        bgMusic.currentTime = 0;
        bgMusic.play();
        if (currentEnemy) currentEnemy.remove();
        currentEnemy = null;
        targetWord = null;
        createWord();
        gameLoop();
    }

    function endGame() {
        gameRunning = false;
        bgMusic.pause();
        finalScore.textContent = score;
        gameOverScreen.style.display = 'flex';
    }

    hiddenInput.addEventListener('input', e => {
        const val = e.target.value.trim().toLowerCase();
        if (val) {
            shootLetter(val[val.length - 1]);
            e.target.value = '';
        }
    });

    restartButton.addEventListener('click', () => {
        gameOverScreen.style.display = 'none';
        startGame();
    });

    muteButton.addEventListener('click', () => {
        if (bgMusic.paused) {
            bgMusic.play();
            muteButton.textContent = '🔊';
        } else {
            bgMusic.pause();
            muteButton.textContent = '🔇';
        }
    });

    gameArea.addEventListener('click', () => hiddenInput.focus());

    startGame();
});
</script>
@endpush
</x-app-layout>
