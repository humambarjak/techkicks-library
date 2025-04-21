<x-app-layout>
    <!-- 🌈 Gradient Background -->
    <div class="bg-gradient-to-br from-blue-100 via-green-100 to-yellow-100 min-h-screen py-16 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- 👋 Welcome Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-indigo-800 drop-shadow">Hoi {{ Auth::user()->name }}</h1>
                <p class="text-gray-700 text-lg mt-2">Update je profiel en beheer je instellingen</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- ✏️ Edit Profile Form -->
                <div class="md:col-span-2 bg-white rounded-3xl shadow-2xl p-8 space-y-6">
                    <h2 class="text-xl font-semibold text-indigo-700 border-b pb-2">Profiel Bewerken</h2>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Naam</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                                   class="w-full p-3 mt-1 border border-indigo-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-400" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                   class="w-full p-3 mt-1 border border-indigo-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-400" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Avatar</label>
                            <input type="file" name="avatar" class="mt-1 text-sm" />
                        </div>

                        <div class="text-right">
                            <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-full font-semibold shadow transition">
                                💾 Opslaan
                            </button>
                        </div>
                    </form>

                    <!-- 🔒 Password -->
                    <form method="POST" action="{{ route('password.update') }}" class="pt-8 border-t space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Huidig wachtwoord</label>
                            <input type="password" name="current_password"
                                   class="w-full p-3 mt-1 border border-red-200 rounded-xl shadow-sm focus:ring-2 focus:ring-red-400" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nieuw wachtwoord</label>
                            <input type="password" name="password"
                                   class="w-full p-3 mt-1 border border-red-200 rounded-xl shadow-sm focus:ring-2 focus:ring-red-400" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bevestig wachtwoord</label>
                            <input type="password" name="password_confirmation"
                                   class="w-full p-3 mt-1 border border-red-200 rounded-xl shadow-sm focus:ring-2 focus:ring-red-400" />
                        </div>

                        <div class="text-right">
                            <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full font-semibold shadow transition">
                                🔐 Wachtwoord wijzigen
                            </button>
                        </div>
                    </form>
                </div>

                <!-- 👤 Profile Card -->
                <div class="bg-white rounded-3xl shadow-xl p-6 text-center">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-24 h-24 rounded-full mx-auto mb-3 shadow-md" />
                    @else
                        <img src="https://api.dicebear.com/6.x/fun-emoji/svg?seed={{ Auth::user()->id }}" class="w-24 h-24 rounded-full mx-auto mb-3 border" />
                    @endif

                    <h3 class="text-lg font-bold text-indigo-700">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-500 mb-4">🎓 Lid van TechKicks</p>

                    <p class="text-sm text-gray-600 italic">"Lezen is dromen met je ogen open."</p>
                    <p class="mt-3 text-xs text-gray-400">Laatst bijgewerkt: {{ Auth::user()->updated_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
