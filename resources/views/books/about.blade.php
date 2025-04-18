<x-layout title="About the Book Tracker">
    <div class="max-w-3xl mx-auto bg-white p-8 border border-gray-200 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-[#4CAF50] text-center">Your Personal Book Organizer and Tracker!</h1>
        <p class="mb-4 text-gray-700">
            Welcome to <strong>Book Tracker</strong>, a website for readers to effortlessly organize, track, and manage their reading journey. This user-friendly website offers a variety of features to enhance your reading experience:
        </p>

        <ul class="list-disc list-inside mb-6 text-gray-700 space-y-2">
            <li class="flex items-start">
                <i class="fas fa-book mt-1 text-[#4CAF50] mr-2"></i>
                <div>
                    <strong>Detailed Book Logging:</strong> Record each book with information such as title, author, publication year, and your own personalized description.
                </div>
            </li>
            <li class="flex items-start">
                <i class="fas fa-tasks mt-1 text-[#4CAF50] mr-2"></i>
                <div>
                    <strong>Reading Status Tracking:</strong> Easily categorize each book as <em>"To Read," "Reading,"</em> or <em>"Read"</em> to monitor your progress and stay motivated.
                </div>
            </li>
            <li class="flex items-start">
                <i class="fas fa-search mt-1 text-[#4CAF50] mr-2"></i>
                <div>
                    <strong>Quick Book Search:</strong> Use the convenient search bar to easily find any book in your collection, making it simple to locate and update your reading progress.
                </div>
            </li>
        </ul>

        <p class="mb-6 text-gray-700">
            Book Tracker is built using Laravel for a solid and secure foundation, with a simple, responsive design that ensures easy navigation and readability.
        </p>
        
        <div class="text-center">
            <a href="{{ route('books.create') }}" class="inline-block bg-[#4CAF50] text-white px-6 py-3 rounded-md hover:bg-[#45a049] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4CAF50]">
                Add Your Favourite Book
            </a>
        </div>
    </div>
</x-layout>
