<x-guest-layout>
   <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-yellow-100 via-blue-100 to-green-100 px-4">

        <!-- ✅ Custom Logo ABOVE the card -->
        <div class="mb-6">
            <img src="{{ asset('images/Tech.png') }}" alt="TechKicks Logo" class="h-20 w-auto drop-shadow-lg">
        </div>

        <!-- 💳 Login Card -->
        <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl">
            <h2 class="text-2xl font-bold text-center text-blue-700 mb-2">Inloggen</h2>
            <p class="text-sm text-center text-gray-500 mb-6">Voer je gegevens in om in te loggen.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Emailadres</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                </div>

                <!-- Remember Me & Forgot -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-600">Onthoud mij</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                            Wachtwoord vergeten?
                        </a>
                    @endif
                </div>

                <!-- 🌟 New Animated Submit Button -->
<button type="submit" class="animated-button-goldblue w-full relative overflow-hidden mt-2">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    Inloggen
</button>
            </form>

            <!-- Register Prompt -->
            <p class="mt-6 text-sm text-center text-gray-500">
                Nog geen account?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Registreer hier</a>
            </p>
        </div>
    </div>

    <!-- 🌟 Custom Button CSS -->
    <style>
    .animated-button-goldblue {
    background: linear-gradient(45deg, #3b82f6, #2563eb);
    padding: 14px 20px;
    display: inline-block;
    overflow: hidden;
    color: white;
    font-size: 18px;
    letter-spacing: 1.5px;
    text-align: center;
    text-transform: uppercase;
    text-decoration: none;
    font-weight: 600;
    border-radius: 8px;
    position: relative;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.animated-button-goldblue::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-color: #60a5fa; /* soft blue overlay */
    opacity: 0;
    transition: 0.3s ease;
    border-radius: 8px;
}

.animated-button-goldblue:hover::before {
    opacity: 0.2;
}

.animated-button-goldblue span {
    position: absolute;
}

.animated-button-goldblue span:nth-child(1) {
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(to left, rgba(255, 215, 0, 0),rgb(255, 251, 0)); /* gold light */
    animation: animateTop 2s linear infinite;
}

.animated-button-goldblue span:nth-child(2) {
    top: 0;
    right: 0;
    height: 100%;
    width: 2px;
    background: linear-gradient(to top, rgba(255, 215, 0, 0),rgb(255, 220, 125));
    animation: animateRight 2s linear -1s infinite;
}

.animated-button-goldblue span:nth-child(3) {
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(to right, rgba(255, 215, 0, 0),rgb(241, 225, 0));
    animation: animateBottom 2s linear infinite;
}

.animated-button-goldblue span:nth-child(4) {
    top: 0;
    left: 0;
    height: 100%;
    width: 2px;
    background: linear-gradient(to bottom, rgba(255, 215, 0, 0),rgb(255, 220, 125));
    animation: animateLeft 2s linear -1s infinite;
}

@keyframes animateTop {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}
@keyframes animateRight {
    0% { transform: translateY(100%); }
    100% { transform: translateY(-100%); }
}
@keyframes animateBottom {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}
@keyframes animateLeft {
    0% { transform: translateY(-100%); }
    100% { transform: translateY(100%); }
}
    </style>
</x-guest-layout>
