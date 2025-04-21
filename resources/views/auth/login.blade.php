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

                <!-- Submit -->
                <button type="submit"
                    class="w-full flex justify-center items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg shadow transition transform hover:scale-105">
                    ✨ Inloggen
                </button>
            </form>

            <!-- Register Prompt -->
            <p class="mt-6 text-sm text-center text-gray-500">
                Nog geen account?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Registreer hier</a>
            </p>
        </div>
    </div>
</x-guest-layout>
