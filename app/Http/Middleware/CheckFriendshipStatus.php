<?php

namespace App\Http\Middleware;

use App\Models\friend;
use Auth;
use Closure;

class CheckFriendshipStatus
{
    public function handle($request, Closure $next)
    {
        $receiverId = $request->reciver_id;
        $senderId = Auth::user()->id;

        $friendship = friend::query()->where('reciver_id', $receiverId)
            ->where('sender_id', $senderId)
            ->where('isfriends', 1)
            ->first();

            if (!$friendship) {
                return response()->json([
                    'message' => 'Unauthorized',
                ], 401);

            }
           

        return $next($request);
    }
}
