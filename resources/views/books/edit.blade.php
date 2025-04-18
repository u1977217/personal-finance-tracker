<x-layout title="Edit a Book">
    <div class="max-w-2xl mx-auto bg-white p-8 border border-gray-200 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-[#4CAF50]">Edit the Details for <span class="italic">{{ $book->title }}</span></h1>

        <!-- Edit Book Form -->
        <form action="{{ route('books.update', $book->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Title Field -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $book->title) }}" 
                    
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm"
                    placeholder="Book Title">
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Year Field -->
            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">Year:</label>
                <input 
                    type="number" 
                    id="year" 
                    name="year" 
                    value="{{ old('year', $book->year) }}" 
                    
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm"
                    placeholder="e.g., 2021">
                @error('year')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description Field -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea 
                    id="description" 
                    name="description"
                    rows="4"
                    
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm"
                    placeholder="A brief description of the book...">{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Field -->
            <div>
                <div class="flex items-center justify-between">
                    <label for="status_id" class="block text-sm font-medium text-gray-700">Status:</label>
                    <button type="button" id="add-status-button" class="text-[#4CAF50] hover:text-[#388e3c] focus:outline-none">
                        Add
                    </button>
                </div>
                <select name="status_id" id="status_id" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm">
                    <option value="">-- Select Status --</option>
                    @foreach($statuses as $status)
                        <option 
                            value="{{ $status->id }}" 
                            {{ old('status_id', $book->status_id) == $status->id ? 'selected' : '' }}
                        >
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
                @error('status_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <!-- Hidden Mini-Form to Add New Status -->
                <div id="status-form" class="mt-4 hidden bg-gray-50 p-4 border border-gray-200 rounded-md">
                    <label for="new_status" class="block text-sm font-medium text-gray-700">New Status Name:</label>
                    <input type="text" id="new_status" name="new_status"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm"
                        placeholder="e.g., Want to Read">
                    <div class="mt-2 flex justify-end space-x-2">
                        <button type="button" id="save-status" class="bg-[#4CAF50] text-white px-4 py-2 rounded-md hover:bg-[#45a049] focus:outline-none">
                            Save
                        </button>
                        <button type="button" id="cancel-status" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 focus:outline-none">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Pages Field -->
            <div>
                <label for="pages" class="block text-sm font-medium text-gray-700">Pages:</label>
                <input 
                    type="number" 
                    id="pages" 
                    name="pages" 
                    value="{{ old('pages', $book->pages) }}" 
                    
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm"
                    placeholder="e.g., 350">
                @error('pages')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Author Field -->
            <div>
                <div class="flex items-center justify-between">
                    <label for="author_id" class="block text-sm font-medium text-gray-700">Author:</label>
                    <button type="button" id="add-author-button" class="text-[#4CAF50] hover:text-[#388e3c] focus:outline-none">
                        Add
                    </button>
                </div>
                <select id="author_id" name="author_id" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm">
                    <option value="">-- Select Author --</option>
                    @foreach($authors as $author)
                        <option 
                            value="{{ $author->id }}"
                            {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}
                        >
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
                @error('author_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <!-- Hidden Mini-Form to Add New Author -->
                <div id="author-form" class="mt-4 hidden bg-gray-50 p-4 border border-gray-200 rounded-md">
                    <label for="new_author" class="block text-sm font-medium text-gray-700">New Author Name:</label>
                    <input type="text" id="new_author" name="new_author"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm"
                        placeholder="e.g., Jane Austen">
                    <div class="mt-2 flex justify-end space-x-2">
                        <button type="button" id="save-author" class="bg-[#4CAF50] text-white px-4 py-2 rounded-md hover:bg-[#45a049] focus:outline-none">
                            Save
                        </button>
                        <button type="button" id="cancel-author" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 focus:outline-none">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Genre Field -->
            <div>
                <div class="flex items-center justify-between">
                    <label for="genre_id" class="block text-sm font-medium text-gray-700">Genre:</label>
                    <button type="button" id="add-genre-button" class="text-[#4CAF50] hover:text-[#388e3c] focus:outline-none">
                        Add
                    </button>
                </div>
                <select id="genre_id" name="genre_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm">
                    <option value="">-- None --</option>
                    @foreach($genres as $genre)
                        <option 
                            value="{{ $genre->id }}"
                            {{ old('genre_id', $book->genre_id) == $genre->id ? 'selected' : '' }}
                        >
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
                @error('genre_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <!-- Hidden Mini-Form to Add New Genre -->
                <div id="genre-form" class="mt-4 hidden bg-gray-50 p-4 border border-gray-200 rounded-md">
                    <label for="new_genre" class="block text-sm font-medium text-gray-700">New Genre Name:</label>
                    <input type="text" id="new_genre" name="new_genre"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm"
                        placeholder="e.g., Fiction">
                    <div class="mt-2 flex justify-end space-x-2">
                        <button type="button" id="save-genre" class="bg-[#4CAF50] text-white px-4 py-2 rounded-md hover:bg-[#45a049] focus:outline-none">
                            Save
                        </button>
                        <button type="button" id="cancel-genre" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 focus:outline-none">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-[#4CAF50] text-white px-6 py-3 rounded-md hover:bg-[#45a049] focus:outline-none">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript to handle show/hide and AJAX calls -->
    <script>
        // --- STATUS LOGIC ---
        const addStatusButton = document.getElementById('add-status-button');
        const statusForm      = document.getElementById('status-form');
        const saveStatusBtn   = document.getElementById('save-status');
        const cancelStatusBtn = document.getElementById('cancel-status');

        addStatusButton.addEventListener('click', () => {
            statusForm.classList.remove('hidden');
        });

        cancelStatusBtn.addEventListener('click', () => {
            statusForm.classList.add('hidden');
            document.getElementById('new_status').value = '';
        });

        saveStatusBtn.addEventListener('click', () => {
            const newStatus = document.getElementById('new_status').value.trim();
            if (!newStatus) {
                alert("Please enter a status name.");
                return;
            }

            // AJAX call to create a new status
            fetch("{{ route('statuses.storeAjax') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name: newStatus
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error creating status');
                }
                return response.json();
            })
            .then(data => {
                const statusSelect = document.getElementById('status_id');
                const newOption = document.createElement('option');
                newOption.value = data.id;
                newOption.text  = data.name;
                newOption.selected = true;
                statusSelect.appendChild(newOption);

                document.getElementById('new_status').value = '';
                statusForm.classList.add('hidden');
            })
            .catch(err => {
                console.error(err);
                alert('Failed to create status.');
            });
        });

        // --- AUTHOR LOGIC ---
        const addAuthorButton = document.getElementById('add-author-button');
        const authorForm      = document.getElementById('author-form');
        const saveAuthorBtn   = document.getElementById('save-author');
        const cancelAuthorBtn = document.getElementById('cancel-author');

        addAuthorButton.addEventListener('click', () => {
            authorForm.classList.remove('hidden');
        });

        cancelAuthorBtn.addEventListener('click', () => {
            authorForm.classList.add('hidden');
            document.getElementById('new_author').value = '';
        });

        saveAuthorBtn.addEventListener('click', () => {
            const newAuthor = document.getElementById('new_author').value.trim();
            if (!newAuthor) {
                alert("Please enter an author name.");
                return;
            }

            // AJAX call to create a new author
            fetch("{{ route('authors.storeAjax') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ 
                    name: newAuthor
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error creating author');
                }
                return response.json();
            })
            .then(data => {
                const authorSelect = document.getElementById('author_id');
                const newOption = document.createElement('option');
                newOption.value = data.id;
                newOption.text = data.name;
                newOption.selected = true;
                authorSelect.appendChild(newOption);

                document.getElementById('new_author').value = '';
                authorForm.classList.add('hidden');
            })
            .catch(err => {
                console.error(err);
                alert('Failed to create author.');
            });
        });

        // --- GENRE LOGIC ---
        const addGenreButton = document.getElementById('add-genre-button');
        const genreForm      = document.getElementById('genre-form');
        const saveGenreBtn   = document.getElementById('save-genre');
        const cancelGenreBtn = document.getElementById('cancel-genre');

        addGenreButton.addEventListener('click', () => {
            genreForm.classList.remove('hidden');
        });

        cancelGenreBtn.addEventListener('click', () => {
            genreForm.classList.add('hidden');
            document.getElementById('new_genre').value = '';
        });

        saveGenreBtn.addEventListener('click', () => {
            const newGenre = document.getElementById('new_genre').value.trim();
            if (!newGenre) {
                alert("Please enter a genre name.");
                return;
            }

            // AJAX call to create a new genre
            fetch("{{ route('genres.storeAjax') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ 
                    name: newGenre
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error creating genre');
                }
                return response.json();
            })
            .then(data => {
                const genreSelect = document.getElementById('genre_id');
                const newOption = document.createElement('option');
                newOption.value = data.id;
                newOption.text = data.name;
                newOption.selected = true;
                genreSelect.appendChild(newOption);

                document.getElementById('new_genre').value = '';
                genreForm.classList.add('hidden');
            })
            .catch(err => {
                console.error(err);
                alert('Failed to create genre.');
            });
        });
    </script>
</x-layout>
