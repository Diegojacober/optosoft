<?php

namespace App\Http\Controllers;

use App\Models\Optometrist;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestionController extends Controller
{
    public function store(Request $request)
    {
        $body = $request->input('body');
        
        $suggestion = Suggestion::create([
            'optometrist_id' => Auth::user()->optometrist_id,
            'body' => $body,
        ]);

        if($suggestion) {
            return response()->json(['message' => 'success']);
        }
        return response()->json(['message' => 'error']);
    }
}
