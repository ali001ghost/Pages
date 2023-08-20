<?php

namespace App\Http\Controllers;
use App\Helpers;

use App\Models\book;
use App\Models\media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'book' => 'required|mimes:pdf',
            'vedio' => 'required|mimes:mp4',

        ]);

        $path = upload($request->book, 'media/books');
        $vedio = upload($request->vedio, 'media/vedios');

        $result = media::query()->create([
            'book'=>$path,
            'vedio'=>$vedio,
            'advice'=>$request->advice,
            'illnesses_id'=>$request->illnesses_id
            ,'status'=>$request->status
        ]);

        $book=book::query()->create([
            'name'=>$request->name,
            'book'=>$path,
            'description'=>$request->description

        ]);

        return response()->json([
            'success',
            'data'=>$result
            ,'book'=>$book
        ],200);
}

public function getBook(Request $request)
{
    $books = Book::inRandomOrder()->get();

    return response()->json([
        'success' => true,
        'data' => $books
    ], 200);
}



}
