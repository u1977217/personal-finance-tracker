<x-layout title="List the Books">
    <div class="flex flex-col">
        <h1 class="text-3xl font-bold mb-6 text-center text-[#4CAF50]">Book List</h1>

        <!-- Search and Filter Form -->
        <form action="{{ route('books.index') }}" method="GET" class="flex flex-col md:flex-row items-center justify-between mb-6 space-y-4 md:space-y-0">
            <input 
                type="text" 
                name="search" 
                class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm"
                placeholder="Search by title..." 
                value="{{ $search ?? '' }}"
            />

            <select name="status_id" class="w-full md:w-1/4 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm">
                <option value="">-- All Statuses --</option>
                @foreach($statuses as $status)
                    <option 
                        value="{{ $status->id }}"
                        {{ (isset($statusId) && $statusId == $status->id) ? 'selected' : '' }}
                    >
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>

            <select name="author_search" class="w-full md:w-1/4 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm">
                <option value="">-- All Authors --</option>
                @foreach($authors as $author)
                    <option 
                        value="{{ $author->id }}"
                        {{ (isset($authorSearch) && $authorSearch == $author->id) ? 'selected' : '' }}
                    >
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="w-full md:w-auto bg-[#4CAF50] text-white px-6 py-2 rounded-md hover:bg-[#45a049] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4CAF50]">
                Search
            </button>
        </form>

        <!-- Scrollable Table Container -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Genre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pages</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Added</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($books as $book)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('books.show', $book->id) }}" class="text-[#4CAF50] hover:underline">
                                    {{ $book->title }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $book->author ? $book->author->name : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $book->genre ? $book->genre->name : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $book->pages }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $book->status ? $book->status->name : 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $book->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                <a href="{{ route('books.edit', $book->id) }}" class="bg-[#4CAF50] text-white px-3 py-1 rounded-md hover:bg-[#45a049] text-sm">Edit</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 text-sm" onclick="return confirm('Are you sure you want to delete this book?');">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                No books found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $books->appends(request()->input())->links('vendor.pagination.default') }}
        </div>
    </div>
</x-layout>
