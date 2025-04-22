<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Reading: {{ $book->title }}</h2>
    </x-slot>

    <div class="p-4">
        <iframe src="{{ asset('storage/' . $book->pdf_file) }}" class="w-full" style="height: 90vh;" frameborder="0"></iframe>
    </div>
</x-app-layout>
