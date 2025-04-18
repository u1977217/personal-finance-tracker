<x-layout title="Show Book Details">
    <div class="max-w-3xl mx-auto bg-white p-8 border border-gray-200 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-[#4CAF50] text-center">{{ $book->title }}</h1>

        <div class="space-y-4">
            <p class="text-gray-700"><strong>Author:</strong> {{ $book->author ? $book->author->name : 'N/A' }}</p>
            <p class="text-gray-700"><strong>Genre:</strong> {{ $book->genre ? $book->genre->name : 'N/A' }}</p>
            <p class="text-gray-700"><strong>Year:</strong> {{ $book->year }}</p>
            <p class="text-gray-700"><strong>Status:</strong> 
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    {{ $book->status ? $book->status->name : 'N/A' }}
                </span>
            </p>
            <p class="text-gray-700"><strong>Pages:</strong> {{ $book->pages }}</p>
            <p class="text-gray-700"><strong>Description:</strong> {{ $book->description }}</p>
        </div>

        <div class="mt-6 flex space-x-4">
            <a href="{{ route('books.edit', $book->id) }}" class="bg-[#4CAF50] text-white px-6 py-2 rounded-md hover:bg-[#45a049] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4CAF50]">
                Edit
            </a>
            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type='submit' class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to delete this book?');">
                    Delete
                </button>
            </form>
        </div>
    </div>
</x-layout>
