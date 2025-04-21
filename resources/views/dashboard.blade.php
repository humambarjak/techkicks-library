<x-app-layout>
<x-slot name="header">
    <h1 class="text-3xl font-extrabold text-indigo-700 font-[Comic Neue] drop-shadow-sm tracking-wide">
        {{ __('Dashboard') }}
    </h1>
</x-slot>


<div class="min-h-screen py-12 px-4">

        <div class="max-w-2xl mx-auto bg-white p-8 rounded-3xl shadow-lg text-center">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-indigo-700 mb-2">👋 Welkom!</h1>
            <p class="text-lg text-gray-600 mb-6">
                {{ Auth::user()->name }} 
                <span class="text-sm text-gray-400">
                    ({{ ucfirst(Auth::user()->role) }})
                </span>
            </p>

            

            @if(Auth::user()->role === 'student')
                <p class="text-green-600 text-lg font-semibold mb-4">📚 Laten we op zoek gaan naar jouw volgende boek!</p>
                <a href="{{ route('library.index') }}" class="inline-block bg-yellow-300 hover:bg-yellow-400 text-indigo-900 font-bold px-6 py-2 rounded-full shadow-md transition">
                Ga naar bibliotheek 📖
                </a>
            @elseif(Auth::user()->role === 'teacher')
                <p class="text-blue-600 text-lg font-semibold mb-4">🧑‍🏫 Tijd om kennis te delen!</p>
                <a href="{{ route('books.index') }}" class="inline-block bg-blue-200 hover:bg-blue-300 text-blue-800 font-bold px-6 py-2 rounded-full shadow-md transition">
                    Beheer mijn boeken 📘
                </a>
            @endif
        </div>
    </div>
</x-app-layout>
