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

}
