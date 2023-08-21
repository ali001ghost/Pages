<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
        ->select('media.book', 'media.vedio', 'media.status','media.advice','media.illnesses_id')
        ->where(function ($query) {
            $query->where(function ($query) {
                $query->where('user_illnesses.percentage', '<', 50)
                    ->where('media.status', 'normal');
            })
            ->orWhere(function ($query) {
                $query->where('user_illnesses.percentage', '>=', 50)
                    ->where('media.status', 'acute');
            });
        })
        ->inRandomOrder()
        ->first();

        $response = [
            'success' => true,
            'data' => $media ?: 'you need to do at least one test'
        ];

        return response()->json($response);
}





}
