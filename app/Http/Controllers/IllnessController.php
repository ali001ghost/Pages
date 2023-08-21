<?php

namespace App\Http\Controllers;

use App\Models\illness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class IllnessController extends Controller
{
    public function getIllnesses()
    {
        if (Auth::check()) {
            $illness = illness::all();
            return response()->json(['illness' => $illness]);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

    }
    public function insert_illness(Request $request)
    {
        $user = auth()->user();

        if ( $user->role_id == 1) {
            $illnessesData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'questionCount' => 'required'
        ]);
        
        $illness = new Illness([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'question_count' => $request->input('questionCount')
        ]);
    
        $illness->save();    
        return response()->json(['message' => 'illness added successfully'], 200);
    }
    return response()->json(['message' => 'Unauthorized'], 401);
    }
}
