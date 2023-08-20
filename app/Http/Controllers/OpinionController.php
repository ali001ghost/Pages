<?php

namespace App\Http\Controllers;

use App\Models\opinion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpinionController extends Controller
{


    public function addOpinion(Request $request)
    {
        $result = opinion::query()->create([
            'opinion' => $request->opinion,
            'user_id' => Auth::user()->id,

        ]);
        return response()->json([
            'success',
            'data' => 'opinion added successfully'
        ]);
    }
    public function acceptOpinion(Request $request)
    {
        $result = opinion::query()
            ->where('id', $request->id)
            ->update([
                'status' => 'yes',
            ]);
        return response()->json([
            'success',
            'data' => 'opinion accepted successfully'
        ]);
    }
    public function getOpinion(Request $request)
    {
        $result = Opinion::query()
            ->orderBy('created_at', 'desc')
            ->where('status', 'yes')->with('users:id,name')
            ->get();

        return response()->json([
            'success',
            'data' => $result
        ]);
    }

    public function getNOOpinion(Request $request)
    {
        $result = Opinion::query()
            ->orderBy('created_at', 'desc')
            ->where('status', 'no')
            ->get();

        return response()->json([
            'success',
            'data' => $result
        ]);
    }
}
