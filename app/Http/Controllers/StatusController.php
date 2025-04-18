<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    // Create a new status record via AJAX
    public function storeAjax(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        // Prevent duplicate statuses for the same user
        if (Status::where('name', trim($request->name))->where('user_id', Auth::id())->exists()) {
            return response()->json(['success' => false, 'message' => 'Status already exists.'], 422);
        }

        try {
            $status = Status::create([
                'name'    => trim($request->name),
                'user_id' => Auth::id(),
            ]);

            return response()->json(['success' => true, 'data' => $status]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Status creation failed.'], 500);
        }
    }
}
