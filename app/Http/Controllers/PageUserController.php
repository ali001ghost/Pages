<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\pageUser;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PageUserController extends Controller
{
    public function store(Request $request)
    {
        $result = pageUser::query()
            ->updateOrCreate([
                'user_id' => $request->user_id,
                'page_id' => $request->page_id,
                'isadmin' => 0,
                'isblocked' => 0,
            ]);



        return ResponseHelper::success(['user added successfully']);

    }
    public function count(Request $request)
{
    $pageId = $request->page_id;

    $result = product::query()
        ->where('page_id', $pageId)
        ->select(
            DB::raw('SUM(amount) AS total_amount'),
            DB::raw('SUM(count) AS total_count')
        )
        ->first();

    $totalAmount = $result->total_amount;
    $totalCount = $result->total_count;

    return ResponseHelper::success([

    'total_amount' => $totalAmount,
    'total_sales' => $totalCount]);



}



function getProducts()
{
    $user_id = Auth::user()->id;

    if (!$user_id) {
        $products = Product::all();

        return ResponseHelper::success([

            $data = $products,
        ], );
    }


    $blockedPageIds = PageUser::where('user_id', $user_id)
                              ->where('isblocked', '1')
                              ->pluck('page_id');

    $currentDate = now();

    $products = Product::whereNotIn('page_id', $blockedPageIds)
                       ->where(function ($query) use ($currentDate) {
                           $query->whereNull('start_date')
                                 ->orWhere('start_date', '<=', $currentDate);
                       })
                       ->where(function ($query) use ($currentDate) {
                           $query->whereNull('end_date')
                                 ->orWhere('end_date', '>=', $currentDate);
                       })
                       ->get();



                       return ResponseHelper::success([
                        $data = $products,
                    ]);
}
public function updatedate(Request $request)
    {
        $result=product::query()->where('id',$request->id)->update([
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'discount_percentage'=>$request->discount_percentage
        ]);

        return ResponseHelper::updated(['updated'],);    }


}
