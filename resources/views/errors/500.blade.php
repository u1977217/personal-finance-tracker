<x-layout title="500 - Server Error">
    <div class="flex flex-col items-center justify-center min-h-screen bg-white">
        <div class="bg-gray-100 p-8 border border-gray-200 rounded-lg shadow-md text-center">
            <h1 class="text-6xl font-bold text-[#4CAF50] mb-4">500</h1>
            <p class="text-xl text-gray-700 mb-6">Whoops! Something went wrong on our end.</p>
            <div class="space-x-4">
                <button onclick="window.history.back()" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                    Go Back
                </button>
                <a href="{{ route('books.index') }}" class="bg-[#4CAF50] text-white px-6 py-2 rounded-md hover:bg-[#45a049] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4CAF50]">
                    Return Home
                </a>
            </div>
        </div>
    </div>
</x-layout>
