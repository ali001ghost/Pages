<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\friend;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    public function addfriend(Request $request)
    {
        $senderId = Auth::user()->id;
        $reciverId = $request->reciver_id;

        try {
            $receiver = User::findOrFail($reciverId);
        } catch (ModelNotFoundException $exception) {


            return ResponseHelper::error(null,[
                'receiver not found',
           ],401);
        }

        if ($senderId == $reciverId) {
            return ResponseHelper::error(null,[
                'you cannot send a friend request to yourself ^_^ ',
           ],401);

        }

        $result = friend::query()->updateOrCreate(
            ['sender_id' => $senderId, 'reciver_id' => $reciverId],
            ['sender_id' => $senderId]
        );

        return ResponseHelper::success([
            'data' => 'friend request was sent successfully',
        ]);
    }

    public function acceptfriend(Request $request)  {
        $result=friend::query()
        ->where('reciver_id',Auth::user()->id)
        ->where('id',$request->id)
        ->update(['isfriends'=>1]);

        if(!$result){
            return ResponseHelper::error(null,[
             ' Faild ',
        ],401);

        }
        return ResponseHelper::success([
            $data = 'friend request accepted',
        ]);
    }
    public function deletefriendrequest(Request $request)
    {
         $result=friend::query()
         ->where('id',$request->id)
         ->delete();
         return ResponseHelper::success([
            $data = 'friend request deleted',
        ]);
        }
        public function showfriendrecive(Request $request)
    {
         $result=friend::query()
         ->where('reciver_id', Auth::user()->id)
         ->where('isfriends','0')
         ->with('sender:id,name')
         ->get();


         if ($result->isEmpty()) {
            return response()->json([
                'message' => 'No friend requests '

            ]);}

            return ResponseHelper::success([
            'message'=> 'success',
           $data = $result
        ]);
        }

}
