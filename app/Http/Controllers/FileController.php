<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function viewImage(){
        $getImage =  Image::all();
        foreach ($getImage as $image ) { { {
                    return response()->json([  asset('uploads/products/' . $image->img_url)]);
                }
            }
        }

    }

    public function saveImage(Request $request){
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $extention = $file->getClientOriginalExtension();
            $filename = time(). '.' .$extention;
            $file->move('uploads/products', $filename);

            $imagename = url('/uploads/products/'. $filename);

            Image::insert(['img_url' => $imagename]);

            return response()->json([
                "url" => $imagename, 200,
            ]);
            
        }
    }
}