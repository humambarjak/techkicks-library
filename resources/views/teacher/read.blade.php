<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-indigo-800 text-center mt-4">
            📖 {{ $book->title }}
        </h2>
    </x-slot>

    <div class="p-6 max-w-6xl mx-auto">
        
        <!-- 🔙 Back Button -->
        <div class="mb-6">
            <a href="{{ route('books.index') }}"
               class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded-full shadow-md transition hover:scale-105">
                ⬅️ Terug naar boekenlijst
            </a>
        </div>

        <!-- 📚 Cover + Description -->
        <div class="flex flex-col md:flex-row bg-white rounded-3xl shadow-lg overflow-hidden mb-8">

            <!-- 📸 Cover -->
            <div class="md:w-1/3">
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" 
                     class="object-cover w-full h-72 md:h-full">
            </div>

            <!-- 📝 Description -->
            <div class="md:w-2/3 p-6 flex flex-col justify-center">
                <h3 class="text-2xl font-bold text-indigo-700 mb-2">{{ $book->title }}</h3>
                <p class="text-gray-700 text-base leading-relaxed">
                    {{ $book->description }}
                </p>
            </div>

        </div>

        <!-- 📄 PDF Viewer -->
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
            <iframe src="{{ asset('storage/' . $book->pdf_file) }}" 
                    class="w-full" style="height: 85vh;" frameborder="0">
            </iframe>
        </div>

    </div>
</x-app-layout>
