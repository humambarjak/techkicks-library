<x-guest-layout>
    <div class="bg-gradient-to-r from-yellow-100 via-blue-100 to-green-100 min-h-screen flex flex-col justify-center items-center px-4">

        {{-- ✅ Clean logo without shadow --}}
        <img src="{{ asset('images/Tech.png') }}" alt="TechKicks Logo" alt="TechKicks Logo" class="h-20 w-auto drop-shadow-lg">

        {{-- ✅ Registration Card --}}
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-center text-blue-700 mb-4">Maak uw account aan</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Naam')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('E-mail')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Role Select -->
                <div>
                    <x-input-label for="role" :value="__('Registreer als')" />
                    <select id="role" name="role" required
                            class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                        <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>🎓 Student</option>
                        <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>👨‍🏫 Docent</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Wachtwoord')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Bevestig wachtwoord')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-blue-700 underline">
                        Al geregistreerd?
                    </a>

                    <button type="submit"
                        class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-full shadow transition duration-300 transform hover:scale-105">
                        ✨ Registreren
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
