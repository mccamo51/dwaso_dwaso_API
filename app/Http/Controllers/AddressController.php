<?php

namespace App\Http\Controllers;

use App\AddressModel;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function AddAddress(Request $request)
    {
        $street = $request->street;
        $house_no = $request->house;
        $lane = $request->lane;
        $uid = $request->uid;

        $house_noCount = AddressModel::Where("house_no", "=", $request->house)->count();

        if($house_noCount>1){
            return response()->json([
                "success" => false,
                "msg" => "Address already exist",
            ]);
        }else{
            if($street != '' && $house_no != '' && $lane != ''){
                if (AddressModel::insert([
                    'house_no' => $house_no,
                    'lane' => $lane,
                    'street' => $street,
                    'uid' => $uid,
                ])) {
                    return response()->json([
                        "success" => true,
                        "msg" => "Address added successfully",
                    ]);
                }
            }
        }
    }

    public function getAddress(Request $request){
        $address = AddressModel::all()->where('uid', '=', $request->uid);
        return response()->json([
            "success" => true,
            "data" => $address,
        ]);
    }
}
