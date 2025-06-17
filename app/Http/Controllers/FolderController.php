<?php

namespace App\Http\Controllers;

use App\Models\ReceiptFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(['folder_name' => 'required|string|max:255']);

        $folder = ReceiptFolder::create([
            'name' => $request->folder_name,
            'user_id' => Auth::id()
        ]);

        return response()->json(['success' => true, 'folder' => $folder]);
    }
}

