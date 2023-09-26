<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\pageUser;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function addProduct(Request $request)
{
    $request->validate([
        'image' => 'required|mimes:jpg',


    ]);
    $image = upload($request->image, 'product/images');
    $userId = Auth::user()->id;
    $pageId = $request->page_id;

    $isAdminForPage = pageUser::where('user_id', $userId)
        ->where('page_id', $pageId)
        ->exists();

        if ($isAdminForPage) {
           $result=product::query()->create([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>$image,
            'price'=>$request->price,
            'page_id'=>$request->page_id,
            'amount'=>$request->amount,



           ]);
        }

    if (!$isAdminForPage) {
        return ResponseHelper::error(null, ['Failed'], 401);    }

    return ResponseHelper::success(['product added successfully']);
}
}
