<?php

use App\Http\Controllers\IllnessController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionUserController;
use App\Http\Controllers\UserIllnessesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserProfileController;

Route::controller(AuthController::class)->group(function () 
{
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('getIllnesses', [IllnessController::class, 'getIllnesses']);
    Route::get('getQuestions', [QuestionController::class, 'getQuestions']);
    Route::post('addOpinion', [OpinionController::class, 'addOpinion']);
    Route::post('acceptOpinion', [OpinionController::class, 'acceptOpinion']);
    Route::get('getOpinion', [OpinionController::class, 'getOpinion']);
    Route::post('upload', [MediaController::class, 'upload']);
    Route::post('answer', [QuestionUserController::class, 'answer']);
    Route::get('showPercentage/{illnessesId}', [QuestionUserController::class, 'showPercentage']);
    Route::get('getmedia', [UserIllnessesController::class, 'getmedia']);
    Route::get('show_profile', [UserProfileController::class,'show']);
    Route::post('update_profile', [UserProfileController::class,'update']);
    Route::delete('delete_account', [UserProfileController::class,'deleteAccount']);


});
