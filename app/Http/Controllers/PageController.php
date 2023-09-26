<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\page;
use App\Models\pageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{


    public function store(Request $request)  {
        $request->validate([
            'image' => 'required|mimes:jpg',

        ]);
        $image = upload($request->image, 'page/images');

        $result=page::query()
        ->create([
            'user_id'=>Auth::user()->id,
            'description'=>$request->description,
            'pagetype_id'=>$request->pagetype_id,
            'image'=>$image,
            'name'=>$request->name,
        ]);
        $result2=pageUser::query()
        ->create([
            'user_id'=>$result->user_id,
            'page_id' => $result->id,
            'isadmin'=>1,
            'isblocked'=>0
        ]);
        return ResponseHelper::success([
            $data='success',

        ]);
    }

    public function block(Request $request)  {

        $result2=pageUser::query()
        ->create([
            'user_id'=>$request->user_id,
            'page_id' => $request->page_id,
            'isadmin'=>0,
            'isblocked'=>1
        ]);
        return ResponseHelper::success([
            $data='success',

        ]);


    }
}
