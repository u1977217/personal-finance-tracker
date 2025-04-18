<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    // Create a new genre record via AJAX.
    public function storeAjax(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $genre = Genre::create([
            'name'    => $request->name,
            'user_id' => Auth::id(), // set owner
        ]);

        return response()->json($genre);
    }
}
