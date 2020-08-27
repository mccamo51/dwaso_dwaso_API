<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function Login(Request $request)
    {

        // $email = User::Where("email", "=", $request->email)->count();

        $data = User::where("email", "=", $request->email)->where("password", "=", $request->password)->get();
        if ($data->count() > 0) {

            return response()->json([
                "success" => true,
                "msg" => "User successfully logged in",
                "data" => $data[0]
            ]);
        }else{
            return  response()-> json([
                "success" => false,
                "msg" => "Failed"
            ]);
        }
    }
}
//Hellooososos