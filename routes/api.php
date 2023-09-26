<?php
use App\Http\Middleware\LanguageMiddleware;
use App\Http\Controllers\API\AuthAdminController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\IllnessController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PageUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionUserController;
use App\Http\Controllers\UserIllnessesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserProfileController;

Route::controller(AuthController::class)->group(function ()
{

            Route::group(
                ['middleware' => 'LanguageMiddleware'],
                function () {
                    Route::get('getProducts',[PageUserController::class,'getProducts']);
                    Route::post('addProduct',[ProductController::class,'addProduct']);
                    Route::post('store',[PageController::class,'store']);

                    Route::group(['middleware' => 'auth:api'], function () {
                        Route::group(
                            ['middleware' => 'CheckIsAdminForPageMiddleware'],
                            function () {
                                Route::post('store/user',[PageUserController::class,'store']);
                                Route::get('count',[PageUserController::class,'count']);
                                Route::post('block',[PageController::class,'block']);


                         });});


                         Route::post('updatedate',[PageUserController::class,'updatedate']);

                         Route::group(['middleware' => 'auth:api'], function () {
                            Route::group(
                                ['middleware' => 'CheckFriendshipStatus'],
                                function () {
                                    Route::post('invite',[InviteController::class,'invite']);

                             });});




    Route::post('addfriend',[FriendController::class,'addfriend']);
    Route::post('acceptfriend',[FriendController::class,'acceptfriend']);
    Route::delete('deletefriendrequest',[FriendController::class,'deletefriendrequest']);
    Route::get('showfriendrecive',[FriendController::class,'showfriendrecive']);

    Route::post('acceptinvite',[InviteController::class,'acceptinvite']);
    Route::post('buy',[InviteController::class,'buy']);
    Route::post('deleteinvite',[InviteController::class,'deleteinvite']);
    Route::get('getinvite',[InviteController::class,'getinvite']);
    Route::get('getboughtinfo',[InviteController::class,'getboughtinfo']);
    Route::get('getinvitepercentageinfo',[InviteController::class,'getinvitepercentageinfo']);




             });


    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');



});
