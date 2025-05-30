<x-guest-layout>
   <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-yellow-100 via-blue-100 to-green-100 px-4">

        <!-- ✅ Custom Logo ABOVE the card -->
        <div class="mb-6">
            <img src="{{ asset('images/Tech.png') }}" alt="TechKicks Logo" class="h-20 w-auto drop-shadow-lg">
        </div>

        <!-- 💳 Login Card -->
        <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl">
            <h2 class="text-2xl font-sans text-center text-blue-700 mb-2">Inloggen</h2>
            <p class="text-sm text-center font-sans text-gray-500 mb-6">Voer je gegevens in om in te loggen.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
<!-- Email -->
<div class="mb-4">
    <label for="email" class="block text-sm font-sans text-gray-700">Emailadres</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">

    @error('email')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Password -->
<div class="mb-4">
    <label for="password" class="block text-sm font-sans text-gray-700">Wachtwoord</label>
    <input id="password" type="password" name="password" required
        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">

    @error('password')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Global Auth Errors (like incorrect credentials) -->
@if ($errors->has('email'))
    <p class="text-red-600 text-sm mb-4 text-center font-semibold">
        📛 {{ $errors->first('email') }}
    </p>
@endif

<!-- Remember Me & Forgot -->
<div class="flex items-center justify-between mb-6">
    <label class="flex items-center">
        <input type="checkbox" name="remember" class="text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
        <span class="ml-2 text-sm font-sans text-gray-600">Onthoud mij</span>
    </label>

    @if (Route::has('password.request'))
        <a class="text-sm text-blue-600 font-sans hover:underline" href="{{ route('password.request') }}">
            Wachtwoord vergeten?
        </a>
    @endif
</div>

<!-- 🌟 New Fancy Blue Button with Green Hover -->
<button type="submit" class="buttonpro w-full mt-2 font-sans">
    <span>Inloggen</span>
</button>
</form>

<!-- Register Prompt -->
<p class="mt-6 text-sm text-center font-sans text-gray-500">
    Nog geen account?
    <a href="{{ route('register') }}" class="text-blue-600 font-sans hover:underline">Registreer hier</a>
</p>

   <!-- 🌟 Custom Button CSS -->
<style>
.buttonpro {
  --btn-default-bg: #1e3a8a; /* dark blue */
  --btn-padding: 15px 20px;
  --btn-hover-bg: #22c55e; /* green hover background */
  --btn-transition: 0.3s;
  --btn-letter-spacing: 0.1rem;
  --btn-animation-duration: 1.2s;
  --btn-shadow-color: #3b82f6; /* blue shadow initially */
  --hover-btn-color: #ffffff; /* white text on hover */
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
  border: 2px solid #1e40af; /* deeper blue border */
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
  scale: 1.09;
}

.buttonpro:hover,
.buttonpro:focus {
  background: var(--btn-hover-bg);
  box-shadow: 0px 0px 10px 0px rgba(34, 197, 94, 0.7); /* green glow */
  border: 2px solid #22c55e; /* green border on hover */
}

.buttonpro:hover span,
.buttonpro:focus span {
  color: var(--hover-btn-color);
}

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
.text-red-500 {
    color: #e3342f;
    font-weight: 500;
    font: 1em sans-serif;
}

.text-red-600 {
    color: #cc1f1a;
    font-weight: 600;
    font: 1em sans-serif;
}

</style>

</x-guest-layout>
