<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\invite;
use App\Models\product;
use Auth;
use Illuminate\Http\Request;

class InviteController extends Controller
{
    public function invite(Request $request)
{
    $result = Invite::updateOrCreate(
        [
            'sender_id' => Auth::user()->id,
            'reciver_id' => $request->reciver_id,
            'product_id' => $request->product_id,
            'price'=> 0
        ],
        []
    );

    return ResponseHelper::success([
        'message' => 'Invite was sent successfully',
    ]);
}

    function getinvite() {
        $result = Invite::query()
        ->where('reciver_id', Auth::user()->id)
        ->with(['sender:id,name','product:id,name,image,price'])
        ->select('id','sender_id', 'product_id')
        ->get();

        return response()
         ->json([
            $data = $result,
        ]);
    }


    public function acceptinvite(Request $request)
{
    $invite = Invite::where('reciver_id', Auth::user()->id)
        ->where('id', $request->id)
        ->first();

    if (!$invite) {
        return ResponseHelper::error(null,[ 'Invalid invite'], 404);
    }

    $product = Product::find($invite->product_id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    if ($product->amount <= 0) {
        return response()->json(['message' => 'Product amount is not sufficient'], 400);
    }

    $invite->update([
        'status' => 1,
        'inviteprice' => $product->Newprice * 0.02,
    ]);

    $product->decrement('amount');
    $product->increment('count');

    return ResponseHelper::success(['message' => 'Invite accepted successfully'], 200);
}
public function buy(Request $request)
{
    $product = Product::findOrFail($request->product_id);

    if ($product->amount <= 0) {
        return response()->json(['message' => 'Product amount is not sufficient'], 400);
    }

    $invite = Invite::query()->create([
        'sender_id' => Auth::user()->id,
        'reciver_id' => Auth::user()->id,
        'product_id' => $request->product_id,
        'price' => $product->Newprice
    ]);

    $product->decrement('amount');
    $product->increment('count');

    $invite->update(['status' => 2]);

    return ResponseHelper::success([$data='success']);
}
public function deleteinvite(Request $request)
{
   $result=invite::query()->where('id',$request->id)->delete();

   return ResponseHelper::success([$data='Invite deleted successfully']);
}


function getboughtinfo() {
    $result = Invite::query()
    ->where('reciver_id', Auth::user()->id)
    ->where('sender_id',Auth::user()->id)->where('status','2')
    ->get(['id','price','product_id','created_at']);

    return ResponseHelper::success([
        $data = $result,
    ]);
}

function getinvitepercentageinfo() {
    $result = Invite::query()
    ->where('sender_id',Auth::user()->id)
    ->where('status','1')
    ->get(['id','inviteprice','product_id','created_at']);

    if($result->isEmpty()){

        return response()
     ->json([
       'no invite was accepted',
    ]);
    }
    return ResponseHelper::success([
        $data = $result,
    ]);
}


}
