<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AddUser extends Controller
{
    public function Register(Request $request)
    {

        $name = $request->input('fullname');
        $email = $request->input('email');
        $contact = $request->input('phone');
        $password = $request->input('password');

        $emailCount = User::Where("email", "=", $request->email)->count();
        if($emailCount > 0 ){
            return response()->json([
                "Ok" => false,
                "msg" => "User already exist",
            ]);
        
        }else{
            if($name != '' && $email != '' && $contact != '' && $password !='')
            {
               if(User::insert([
                    'fullname' => $name,
                    'email' => $email,
                    'phone' => $contact,
                    'password' => $password
               ])){
                    return response()->json([
                        "Ok" => true,
                        "msg" => "User added successfully",
                    ]);
                }
            } else{
                return response()->json([
                    "Ok" => false,
                    "msg" => "All fields are required",
                ]);
            }


        }
      
    }

}
