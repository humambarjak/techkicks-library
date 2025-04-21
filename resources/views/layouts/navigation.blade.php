<nav x-data="{ open: false }" class="bg-indigo-300/40 shadow-md backdrop-blur-md z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left: Logo & Navigation -->
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/Tech.png') }}" alt="TechKicks Logo" class="h-10 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center gap-6 text-lg font-semibold text-gray-700">
                    <x-nav-link :href="route('library.games')" :active="request()->routeIs('library.games')" class="hover:text-indigo-600 transition">
                         <span class="ml-1">Spel</span>
                    </x-nav-link>
                    <x-nav-link :href="route('info.page')" :active="request()->is('info')" class="hover:text-indigo-600 transition">
                         <span class="ml-1">Info</span>
                    </x-nav-link>
                    <x-nav-link :href="route('library.special')" :active="request()->routeIs('library.special')" class="hover:text-indigo-600 transition">
                         <span class="ml-1">Special</span>
                    </x-nav-link>
                </div>
            </div>

            <!-- Right: User Dropdown or Login -->
            <div class="hidden sm:flex sm:items-center">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 transition">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="h-8 w-8 rounded-full">
                                @else
                                    <img src="https://api.dicebear.com/6.x/fun-emoji/svg?seed={{ Auth::user()->id }}" class="h-8 w-8 rounded-full border border-indigo-300" />
                                @endif
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">▾</div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if(Auth::user()->role === 'student')
                                <x-dropdown-link :href="route('library.index')">🏫 Bibliotheek</x-dropdown-link>
                                <x-dropdown-link :href="route('library.shelf')">📚 Mijn Shelf</x-dropdown-link>
                            @endif

                            @if(Auth::user()->role === 'teacher')
                            <x-dropdown-link :href="route('books.index')">📘 Boeken beheren</x-dropdown-link>
                            <x-dropdown-link :href="route('teacher.progress')">📊 Student voortgang</x-dropdown-link>
                            @endif


                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Uitloggen') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                       class="text-sm text-indigo-700 hover:underline font-semibold px-4 py-2 transition">
                        Inloggen
                    </a>
                @endguest
            </div>

            <!-- Hamburger for small screens -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-400 hover:text-indigo-600 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu (Mobile) -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-white bg-opacity-90 backdrop-blur-md shadow-md">
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Uitloggen') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth

        @guest
            <div class="pt-4 pb-4 px-4 text-center border-t border-gray-200">
                <a href="{{ route('login') }}"
                   class="text-indigo-600 font-semibold hover:underline text-base">
                    Inloggen
                </a>
            </div>
        @endguest
    </div>
</nav>
