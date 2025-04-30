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
        .btn {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 13rem;
  overflow: hidden;
  height: 3rem;
  background-size: 300% 300%;
  cursor: pointer;
  backdrop-filter: blur(1rem);
  border-radius: 5rem;
  transition: 0.5s;
  animation: gradient_301 5s ease infinite;
  border: double 4px transparent;
  background-image: linear-gradient(#212121, #212121),
    linear-gradient(
      137.48deg,
      #ffdb3b 10%,
      #fe53bb 45%,
      #8f51ea 67%,
      #0044ff 87%
    );
  background-origin: border-box;
  background-clip: content-box, border-box;
  position: relative;
}

#container-stars {
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  overflow: hidden;
  transition: 0.5s;
  backdrop-filter: blur(1rem);
  border-radius: 5rem;
}

strong {
  z-index: 2;
  font-family: "Avalors Personal Use", sans-serif;
  font-size: 12px;
  letter-spacing: 5px;
  color: #ffffff;
  text-shadow: 0 0 4px white;
}

#glow {
  position: absolute;
  display: flex;
  width: 12rem;
}

.circle {
  width: 100%;
  height: 30px;
  filter: blur(2rem);
  animation: pulse_3011 4s infinite;
  z-index: -1;
}

.circle:nth-of-type(1) {
  background: rgba(254, 83, 186, 0.636);
}

.circle:nth-of-type(2) {
  background: rgba(142, 81, 234, 0.704);
}

.btn:hover #container-stars {
  z-index: 1;
  background-color: #212121;
}

.btn:hover {
  transform: scale(1.1);
}

.btn:active {
  border: double 4px #fe53bb;
  background-origin: border-box;
  background-clip: content-box, border-box;
  animation: none;
}

.btn:active .circle {
  background: #fe53bb;
}

#stars {
  position: relative;
  background: transparent;
  width: 200rem;
  height: 200rem;
}

#stars::after {
  content: "";
  position: absolute;
  top: -10rem;
  left: -100rem;
  width: 100%;
  height: 100%;
  animation: animStarRotate 90s linear infinite;
  background-image: radial-gradient(#ffffff 1px, transparent 1%);
  background-size: 50px 50px;
}

#stars::before {
  content: "";
  position: absolute;
  top: 0;
  left: -50%;
  width: 170%;
  height: 500%;
  animation: animStar 60s linear infinite;
  background-image: radial-gradient(#ffffff 1px, transparent 1%);
  background-size: 50px 50px;
  opacity: 0.5;
}

@keyframes animStar {
  from {
    transform: translateY(0);
  }
  to {
    transform: translateY(-135rem);
  }
}

@keyframes animStarRotate {
  from {
    transform: rotate(360deg);
  }
  to {
    transform: rotate(0);
  }
}

@keyframes gradient_301 {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

@keyframes pulse_3011 {
  0% {
    transform: scale(0.75);
    box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.7);
  }
  70% {
    transform: scale(1);
    box-shadow: 0 0 0 10px rgba(0, 0, 0, 0);
  }
  100% {
    transform: scale(0.75);
    box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
  }
}
/* 🚗 Car Racing Button Improved */
.carbutton {
  width: 200px;
  height: 70px;
  padding: 20px;
  background: #212121;
  border: 6px double #e8e8e8;
  transition: 0.2s;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
}

.caption {
  color: #e8e8e8;
  font-family: 'Courier New', Courier, monospace;
  font-size: 20px;
  transition: 0.2s;
  position: absolute;
  z-index: 2;
}

.car {
  fill: #e8e8e8;
  width: 50px;
  height: 50px;
  position: absolute;
  opacity: 0;
  transform: translateX(-150px); /* start off screen */
  transition: 0.4s ease-in-out;
  z-index: 1;
}

.carbutton:hover .caption {
  opacity: 0;
}

.carbutton:hover .car {
  opacity: 1;
  transform: translateX(0); /* 🚗 move to center */
}

.carbutton:focus .car {
  transform: translateX(0);
}

/* 🎯 New Wolverine Face Button for Emoji Quiz */
.button {
  cursor: pointer;
  position: relative;
  width: 102px;
  height: 195px;
  border: none;
  border-radius: 0 9.5rem 10rem 0;
  background-color: transparent;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.5s ease;
}

.button.face {
  transform: rotateY(180deg);
}

.wolverine-face {
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 85px;
  height: 170px;
  left: 0;
  border: none;
  border-radius: 0 9.5rem 10rem 0;
  box-shadow: inset 0 0 4px rgba(0, 0, 0);
  background: linear-gradient(
    90deg,
    #fce620 5%,
    #ebd61d 10%,
    #f5e024 30%,
    #e6d31d 50%,
    #f5e024 70%,
    #ebd61d 80%,
    #fce620 95%
  );
  transition: all 0.5s ease;
}

.wol {
  position: absolute;
  border: none;
  background-color: transparent;
  box-shadow: none;
  width: 130px;
  height: 190px;
  bottom: 15px;
  right: -30px;
  transition: all 0.5s ease;
  clip-path: polygon(
    98% 1%,
    85% 15%,
    73% 28%,
    61% 38%,
    49% 46%,
    35% 50%,
    23% 54%,
    15% 57%,
    10% 66%,
    13% 78%,
    21% 86%,
    32% 87%,
    54% 83%,
    42% 100%,
    62% 89%,
    73% 85%,
    81% 73%,
    85% 63%,
    90% 40%,
    93% 28%
  );
}

.wol-eye {
  position: absolute;
  border: none;
  background-color: #090b0c;
  box-shadow: none;
  width: 45px;
  height: 35px;
  transition: all 0.5s ease;
  clip-path: polygon(
    1% 1%,
    99% 59%,
    91% 73%,
    85% 81%,
    77% 89%,
    71% 94%,
    65% 98%,
    58% 99%,
    52% 99%,
    44% 98%,
    38% 97%,
    33% 92%,
    28% 85%,
    23% 75%
  );
  transform: rotateY(180deg);
}

.btn {
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.5s ease;
}

.btn:hover .button {
  background: linear-gradient(
    90deg,
    #fce620 5%,
    #ebd61d 10%,
    #f5e024 30%,
    #e6d31d 50%,
    #f5e024 70%,
    #ebd61d 80%,
    #fce620 95%
  );
  box-shadow: 0px 0px 5px #feff1e;
}

.btn:hover .wolverine-face {
  background: transparent;
  left: 8px;
  box-shadow: inset 0 0 5px rgba(0, 0, 0);
}

.btn:hover .wol {
  background-color: #090b0c;
  width: 130px;
  height: 190px;
  bottom: 15px;
  right: -35px;
  transform: rotateY(0deg);
  clip-path: polygon(
    98% 1%,
    85% 15%,
    73% 28%,
    61% 38%,
    49% 46%,
    35% 50%,
    23% 54%,
    15% 57%,
    10% 66%,
    13% 78%,
    21% 86%,
    32% 87%,
    54% 83%,
    42% 100%,
    62% 89%,
    73% 85%,
    81% 73%,
    85% 63%,
    90% 40%,
    93% 28%
  );
}

.btn:hover .wol-eye {
  background-color: #ececec;
}

.btn:active .button:not(:hover) {
  filter: grayscale(1);
}

.btn:active .button:hover {
  transform: scale(1.1);
}

.btn:active .face:hover {
  transform: rotateY(180deg) scale(1.1);
}
 </style>

    <!-- ✨ Particle Background -->
    <div id="tsparticles"></div>

    <div class="min-h-screen bg-gradient-to-br from-[#fdfcfb] to-[#e2d1c3] flex flex-col items-center justify-start px-6 pt-8 pb-16 relative z-10">
        <!-- 🧠 Heading moved up -->
        <h1 class="text-4xl sm:text-5xl font-extrabold text-indigo-800 mb-2 mt-4 animate-bounce drop-shadow-md">🎮 Kies een spel</h1>
        <p class="text-gray-700 text-center max-w-xl mb-10 text-lg">Kies een leuk en leerzaam spel om je leesvaardigheid te verbeteren!</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 w-full max-w-6xl">
 <!-- 🏎️ TypRace -->
<div class="game-card bg-white/80 backdrop-blur-md border border-green-200 rounded-3xl shadow-xl p-6 flex flex-col items-center text-center transition duration-300 hover:shadow-green-300 hover:-translate-y-1 hover:scale-105 cursor-pointer">
    <img src="{{ asset('images/previews/race.gif') }}" alt="TypRace Preview" class="w-full h-44 object-cover rounded-xl mb-4 shadow-md">
    <h2 class="text-2xl font-bold text-green-700 mb-2">🏎️ TypRace</h2>
    <p class="text-green-800 mb-4">Wie typt het snelst over meerdere ronden en wint de race?</p>

    <!-- 🚀 New Animated Button (Purple → Green) -->
    <a href="{{ route('race') }}">
      <button
        class="cursor-pointer text-white font-bold relative text-[14px] w-[9em] h-[3em] text-center bg-gradient-to-r from-violet-500 from-10% via-blue-500 via-30% to-green-400 to-90% bg-[length:400%] rounded-[30px] z-10 hover:animate-gradient-xy hover:bg-[length:100%] before:content-[''] before:absolute before:-top-[5px] before:-bottom-[5px] before:-left-[5px] before:-right-[5px] before:bg-gradient-to-r before:from-violet-500 before:from-10% before:via-blue-500 before:via-30% before:to-green-400 before:bg-[length:400%] before:-z-10 before:rounded-[35px] before:hover:blur-xl before:transition-all before:ease-in-out before:duration-[1s] before:hover:bg-[length:10%] active:bg-green-600 focus:ring-green-600"
      >
        🚀 Speel Nu
      </button>
    </a>

</div>



          <!-- 🏁 Woordenstrijd -->
            <div class="game-card bg-white/80 backdrop-blur-md border border-gray-200 rounded-3xl shadow-xl p-6 flex flex-col items-center text-center transition duration-300 hover:shadow-indigo-300 hover:-translate-y-1 hover:scale-105 cursor-pointer">
                <img src="{{ asset('images/previews/race-preview.gif') }}" alt="Race Game Preview" class="w-full h-44 object-cover rounded-xl mb-4 shadow-md">
                <h2 class="text-2xl font-bold text-indigo-700 mb-2">🏁 Woordenstrijd</h2>
                <p class="text-gray-600 mb-4">Typ het juiste woord sneller dan je tegenstander!</p>

                <!-- 🚗 New Racing Button -->
                <a href="{{ route('library.game') }}">
                <button type="button" class="carbutton">
                    <div class="caption">Let's Race</div>
                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="car">
                    <path d="M355.975 292.25a24.82 24.82 0 1 0 24.82-24.81 24.84 24.84 0 0 0-24.82 24.81zm-253-24.81a24.81 24.81 0 1 1-24.82 24.81 24.84 24.84 0 0 1 24.81-24.81zm-76.67-71.52h67.25l-13.61 49.28 92-50.28h57.36l1.26 34.68 32 14.76 11.74-14.44h15.62l3.16 16c137.56-13 192.61 29.17 192.61 29.17s-7.52 5-25.93 8.39c-3.88 3.31-3.66 14.44-3.66 14.44h24.2v16h-52v-27.48c-1.84.07-4.45.41-7.06.47a40.81 40.81 0 1 0-77.25 23h-204.24a40.81 40.81 0 1 0-77.61-17.67c0 1.24.06 2.46.17 3.67h-36z"></path>
                    </svg>
                </button>
                </a>

            </div>
           <!-- 🌟 Typing Battle  -->
        <div class="game-card bg-white/80 backdrop-blur-md border border-blue-200 rounded-3xl shadow-xl p-6 flex flex-col items-center text-center transition duration-300 hover:shadow-blue-300 hover:-translate-y-1 hover:scale-105 cursor-pointer">
            <img src="{{ asset('images/previews/ztype-preview.gif') }}" alt="Typing Battle Preview" class="w-full h-44 object-cover rounded-xl mb-4 shadow-md">
            <h2 class="text-2xl font-bold text-blue-700 mb-2">🌟 Typegevecht</h2>
            <p class="text-blue-800 mb-4">Typ woorden om vallende vijanden te verslaan en je skills te verbeteren!</p>

                <!-- 🔥 New animated button here -->
                <a href="{{ route('typing.battle') }}">
                    <button type="button" class="btn">
                        <strong>🎮 Speel Nu</strong>
                        <div id="container-stars">
                            <div id="stars"></div>
                        </div>
                        <div id="glow">
                            <div class="circle"></div>
                            <div class="circle"></div>
                        </div>
                    </button>
                </a>

            </div>


            <!-- 🎯 Emoji Quiz -->
<div class="game-card bg-white/80 backdrop-blur-md border border-gray-200 rounded-3xl shadow-xl p-6 flex flex-col items-center text-center transition duration-300 hover:shadow-yellow-300 hover:-translate-y-1 hover:scale-105 cursor-pointer">
    <img src="{{ asset('images/previews/emoji-preview.gif') }}" alt="Emoji Quiz Preview" class="w-full h-44 object-cover rounded-xl mb-4 shadow-md">
    <h2 class="text-2xl font-bold text-yellow-700 mb-2">🎯 Emoji Betekenis Quiz</h2>
    <p class="text-gray-600 mb-4">Raad de betekenis van grappige emoji-combo’s!</p>

    <!-- 🎯 New Wolverine Button -->
    <a href="{{ route('library.emoji') }}">
      <div class="btn">
        <button class="button face">
          <div class="wolverine-face">
            <div class="wol mask"></div>
            <div class="wol-eye"></div>
          </div>
        </button>

        <button class="button">
          <div class="wolverine-face">
            <div class="wol mask"></div>
            <div class="wol-eye"></div>
          </div>
        </button>
      </div>
    </a>

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
