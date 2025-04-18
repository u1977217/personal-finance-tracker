<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    // Create a new author record via AJAX.
    public function storeAjax(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        // Attach user_id to the new author
        $author = Author::create([
            'name'    => $request->name,
            'user_id' => Auth::id(),
        ]);

        return response()->json($author);
    }
}
