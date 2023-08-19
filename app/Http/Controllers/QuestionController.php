<?php

namespace App\Http\Controllers;

use App\Models\question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getQuestions(Request $request)
    {
        $result = question::query()
            ->where('illnesses_id', $request->illnesses_id)
            ->get(['id', 'name']);
        return response()->json([
            'success',
            'data' => $result
        ], 200);


    }
}
