<x-guest-layout>
    <div class="bg-gradient-to-r from-yellow-100 via-blue-100 to-green-100 min-h-screen flex flex-col justify-center items-center px-4">

        {{-- ✅ Clean logo without shadow --}}
        <img src="{{ asset('images/Tech.png') }}" alt="TechKicks Logo" alt="TechKicks Logo" class="h-20 w-auto drop-shadow-lg">

        {{-- ✅ Registration Card --}}
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-sans text-center text-blue-700 mb-4">Maak uw account aan</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name"  class="font-sans" :value="__('Naam')" />
                    <x-text-input id="name" class="block mt-1 w-full font-sans" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" class="font-sans"  :value="__('E-mail')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Role Select -->
                <div>
                    <x-input-label for="role" class="font-sans" :value="__('Registreer als')" />
                    <select id="role" name="role" required
                            class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                        <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>🎓 Leerling</option>
                        <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>👨‍🏫 Docent</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" class="font-sans" :value="__('Wachtwoord')" />
                    <x-text-input id="password" class="block mt-1 w-full " type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" class="font-sans" :value="__('Bevestig wachtwoord')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Actions -->
                <div class="flex items-center  justify-between mt-6 font-sans">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-blue-700 underline font-sans">
                        Al geregistreerd?
                    </a>

                        
                  <!-- 🌟 Register Button -->
              <button type="submit" class="buttonpro ">
                <span>Registreren</span>
              </button>
                              </div>
                          </form>
                      </div>
                  </div>
                  <!-- 🌟 ButtonPro CSS (Add this once in your page or layout) -->
                  <!-- 🌟 ButtonPro CSS -->
<style>
.buttonpro {
  --btn-default-bg: #1e3a8a; /* dark blue */
  --btn-padding: 15px 20px; /* original padding */
  --btn-hover-bg: #9333ea; /* 💜 purple hover */
  --btn-transition: 0.3s;
  --btn-letter-spacing: 0.1rem;
  --btn-animation-duration: 1.2s;
  --btn-shadow-color: #3b82f6; /* blue shadow */
  --hover-btn-color: #ffffff; /* white text */
  --default-btn-color: #fff;
  --font-size: 16px;
  --font-weight: 600;
  --font-family: Menlo, Roboto Mono, monospace;
  border-radius: 6em;
}

.buttonpro {
  box-sizing: border-box;
  padding: var(--btn-padding);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--default-btn-color);
  font: var(--font-weight) var(--font-size) var(--font-family);
  background: var(--btn-default-bg);
  cursor: pointer;
  transition: var(--btn-transition);
  overflow: hidden;
  box-shadow: 0 2px 10px 0 var(--btn-shadow-color);
  border-radius: 6em;
  border: 2px solid #1e40af;
}

.buttonpro span {
  letter-spacing: var(--btn-letter-spacing);
  transition: var(--btn-transition);
  box-sizing: border-box;
  position: relative;
  background: inherit;
}

.buttonpro span::before {
  box-sizing: border-box;
  position: absolute;
  content: "";
  background: inherit;
}

.buttonpro:focus {
  scale: 1.05;
}

.buttonpro:hover,
.buttonpro:focus {
  background: var(--btn-hover-bg); /* 💜 purple hover */
  box-shadow: 0px 0px 10px 0px rgba(147, 51, 234, 0.7); /* purple glow */
  border: 2px solid #9333ea;
  transform: scale(1.05); /* Smooth grow */
}

.buttonpro:hover span,
.buttonpro:focus span {
  color: var(--hover-btn-color);
}

/* cool chitchat animation */
.buttonpro:hover span::before,
.buttonpro:focus span::before {
  animation: chitchat linear both var(--btn-animation-duration);
}

@keyframes chitchat {
  0% { content: "#"; }
  5% { content: "."; }
  10% { content: "^{"; }
  15% { content: "-!"; }
  20% { content: "#$_"; }
  25% { content: "№:0"; }
  30% { content: "#{+."; }
  35% { content: "@}-?"; }
  40% { content: "?{4@%"; }
  45% { content: "=.,^!"; }
  50% { content: "?2@%"; }
  55% { content: "\\;1}]"; }
  60% { content: "?{%:%"; }
  65% { content: "|{f[4"; }
  70% { content: "{4%0%"; }
  75% { content: "'1_0<"; }
  80% { content: "{0%"; }
  85% { content: "]>'"; }
  90% { content: "4"; }
  95% { content: "2"; }
  100% { content: ""; }
}
</style>
</x-guest-layout>
