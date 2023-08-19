<?php

namespace App\Http\Controllers;

use App\Models\illness;
use Illuminate\Http\Request;

class IllnessController extends Controller
{
    public function getIllnesses(){
        $result=illness::query()->get('name');
        return response()->json([
            'success',
            'data'=>$result
        ],200);


    }
}
