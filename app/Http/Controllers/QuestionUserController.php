<?php

namespace App\Http\Controllers;

use App\Models\illness;
use App\Models\questionUser;
use App\Models\userIllnesses;
use Database\Seeders\illnesses;
use Database\Seeders\illnessesSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionUserController extends Controller
{
    public function answer(Request $request)
    {
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

    public function showPercentage(Request $request ,$illnessesId)
    {
        $userId = Auth::id();


        $totalAnswers = QuestionUser::where('user_id', $userId)
            ->whereIn('question_id', function ($query) use ($illnessesId) {
                $query->select('id')
                    ->from('questions')
                    ->where('illnesses_id', $illnessesId);
            })
            ->count();

        $yesAnswers = QuestionUser::where('user_id', $userId)
            ->where('answer', 'yes')
            ->whereIn('question_id', function ($query) use ($illnessesId) {
                $query->select('id')
                    ->from('questions')
                    ->where('illnesses_id', $illnessesId);
            })
            ->count();

        $maybeAnswers = QuestionUser::where('user_id', $userId)
            ->where('answer', 'maybe')
            ->whereIn('question_id', function ($query) use ($illnessesId) {
                $query->select('id')
                    ->from('questions')
                    ->where('illnesses_id', $illnessesId);
            })
            ->count();
            $percentageYes = 0;
            $percentageMaybe = 0;
            $totalPercentage = 0;

            if ($totalAnswers !== 0) {
                $percentageYes = ($yesAnswers / $totalAnswers) * 100;
                $percentageMaybe = ($maybeAnswers / $totalAnswers) * 50;
                $totalPercentage = $percentageYes + $percentageMaybe;
            }

            $illness = Illness::find($illnessesId);
            $illnessName = $illness->name;

            if ($totalPercentage > 0 && $totalPercentage < 50) {
                $result = userIllnesses::query()->updateOrCreate([
                    'user_id' => $userId,
                    'illnesses_id' => $illnessesId

                ],
['percentage'=>$totalPercentage]
            );
                return response()->json([
                    'success' => true,
                    'data' => 'Illness: ' . $illnessName . ', Percentage: ' . $totalPercentage . '%'
                ]);
            } elseif ($totalPercentage >= 50) {
                $result = userIllnesses::query()->updateOrCreate([
                    'user_id' => $userId,
                    'illnesses_id' => $illnessesId

                ],
['percentage'=>$totalPercentage]
            );

                return response()->json([
                    'success' => true,
                    'data' => 'Illness: ' . $illnessName . ', Percentage: ' . $totalPercentage . '%' .', you need to doctor'
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'data' => 'Illness: ' . $illnessName . ', Percentage: ' . $totalPercentage . '%'
                ]);
            }
}

}
