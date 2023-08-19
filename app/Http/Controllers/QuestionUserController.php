<?php

namespace App\Http\Controllers;

use App\Models\questionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionUserController extends Controller
{
    public function answer(Request $request) {
        $result = questionUser::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'question_id' => $request->question_id,
            ],
            [
                'answer' => $request->answer,
            ]
        );
        return response()->json([
            'success'
        ,

        ]);
    }
}
