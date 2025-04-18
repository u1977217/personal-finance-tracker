<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Saver;
use App\Models\Genre;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search       = $request->input('search');
        $statusId     = $request->input('status_id');
        $saverSearch  = $request->input('saver_search');

        $savers  = Saver::where('user_id', Auth::id())->get();
        $statuses = Status::where('user_id', Auth::id())->get();

        $books = Book::where('user_id', Auth::id())
            ->with(['saver', 'genre', 'status'])
            ->search($search)
            ->statusFilter($statusId)
            ->saversFilter($saverSearch)
            ->paginate(10);

        return view('books.index', compact('books', 'search', 'statusId', 'saverSearch', 'savers', 'statuses'));
    }

    public function create()
    {
        $savers  = Saver::where('user_id', Auth::id())->get();
        $genres   = Genre::where('user_id', Auth::id())->get();
        $statuses = Status::where('user_id', Auth::id())->get();
        return view('books.create', compact('savers', 'genres', 'statuses'));
    }

    public function about()
    {
        return view('books.about');
    }

    public function contact()
    {
        return view('books.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:60',
            'year'        => 'required|integer|min:1000|max:' . date('Y'),
            'description' => 'nullable|string|max:1000',
            'status_id'   => 'required|exists:statuses,id',
            'pages'       => 'required|integer|min:1',
            'saver_id'    => 'required|exists:savers,id',
            'genre_id'    => 'nullable|exists:genres,id',
        ], [
            'title.required'       => 'The title field is required.',
            'title.max'            => 'The title may not be greater than 60 characters.',
            'saver_id.required'    => 'The saver field is required.',
            'year.required'        => 'The year is required.',
            'year.integer'         => 'The year must be a valid number.',
            'year.min'             => 'The year must be a valid four-digit number.',
            'year.max'             => 'The year cannot be in the future.',
            'description.max'      => 'The description may not be longer than 1000 characters.',
        ]);

        if (!Saver::where('id', $request->saver_id)->where('user_id', Auth::id())->exists()) {
            return back()->withErrors(['saver_id' => 'Invalid saver selection.']);
        }

        if ($request->genre_id && !Genre::where('id', $request->genre_id)->where('user_id', Auth::id())->exists()) {
            return back()->withErrors(['genre_id' => 'Invalid genre selection.']);
        }

        if (!Status::where('id', $request->status_id)->where('user_id', Auth::id())->exists()) {
            return back()->withErrors(['status_id' => 'Invalid status selection.']);
        }

        $book = new Book();
        $book->title       = $request->title;
        $book->year        = $request->year;
        $book->description = $request->description;
        $book->status_id   = $request->status_id;
        $book->pages       = $request->pages;
        $book->saver_id    = $request->saver_id;
        $book->genre_id    = $request->genre_id;
        $book->user_id     = Auth::id();
        $book->save();

        return redirect('/books');
    }

    public function show($id)
    {
        $book = Book::with(['saver', 'genre', 'status'])->findOrFail($id);

        if ($book->user_id !== Auth::id()) {
            abort(403, 'You do not own this entry.');
        }

        return view('books.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);

        if ($book->user_id !== Auth::id()) {
            abort(403, 'Cannot edit an entry that is not yours.');
        }

        $savers  = Saver::where('user_id', Auth::id())->get();
        $genres   = Genre::where('user_id', Auth::id())->get();
        $statuses = Status::where('user_id', Auth::id())->get();

        return view('books.edit', compact('book', 'savers', 'genres', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:60',
            'year'        => 'required|integer|min:1000|max:' . date('Y'),
            'description' => 'nullable|string|max:1000',
            'status_id'   => 'required|exists:statuses,id',
            'pages'       => 'required|integer|min:1',
            'saver_id'    => 'required|exists:savers,id',
            'genre_id'    => 'nullable|exists:genres,id',
        ], [
            'title.required'       => 'The title field is required.',
            'title.max'            => 'The title may not be greater than 60 characters.',
            'saver_id.required'    => 'The saver field is required.',
            'year.required'        => 'The year is required.',
            'year.integer'         => 'The year must be a valid number.',
            'year.min'             => 'The year must be a valid four-digit number.',
            'year.max'             => 'The year cannot be in the future.',
            'description.max'      => 'The description may not be longer than 1000 characters.',
        ]);

        $book = Book::findOrFail($id);

        if ($book->user_id !== Auth::id()) {
            abort(403, 'Cannot update an entry that is not yours.');
        }

        if (!Saver::where('id', $request->saver_id)->where('user_id', Auth::id())->exists()) {
            return back()->withErrors(['saver_id' => 'Invalid saver selection.']);
        }

        if ($request->genre_id && !Genre::where('id', $request->genre_id)->where('user_id', Auth::id())->exists()) {
            return back()->withErrors(['genre_id' => 'Invalid genre selection.']);
        }

        if (!Status::where('id', $request->status_id)->where('user_id', Auth::id())->exists()) {
            return back()->withErrors(['status_id' => 'Invalid status selection.']);
        }

        $book->title       = $request->title;
        $book->year        = $request->year;
        $book->description = $request->description;
        $book->status_id   = $request->status_id;
        $book->pages       = $request->pages;
        $book->saver_id    = $request->saver_id;
        $book->genre_id    = $request->genre_id;
        $book->save();

        return redirect('/books');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->user_id !== Auth::id()) {
            abort(403, 'Cannot delete an entry that is not yours.');
        }

        $book->delete();
        return redirect('/books');
    }
}
