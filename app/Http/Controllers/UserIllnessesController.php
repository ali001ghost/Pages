<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserIllnessesController extends Controller
{
    public function getMedia()
    {
        $userId = Auth::user()->id;

        $media = DB::table('user_illnesses')
            ->join('media', 'user_illnesses.illnesses_id', '=', 'media.illnesses_id')
            ->where('user_illnesses.user_id', $userId)
            ->where('user_illnesses.percentage', '<', 'media.rate')
            ->select('media.book', 'media.vedio')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $media
        ]);
    }
}
