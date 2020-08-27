<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        $product_id = $request->input('pid');
        $quantity = $request->input('qty');
        $uid = $request->input('uid');

        if($product_id != '' && $quantity != '' &&  $uid != "")
        {
          
            $pidCount = Cart::Where("pid", "=", $request->pid, "AND"," uid", "=", $request->uid)->count();
            if($pidCount<1)
            {
                DB::statement("INSERT INTO tbl_cart (pid, qty, `uid`) VALUES (?,?,?) ", [$product_id,$quantity, $uid]);
                return response()->json(['success'=> true, 'msg'=> "Item added to cart successfully"]);
            }else 
            {
                return response()->json([
                    "success" => false,
                    "msg" => "Item already added to cart",
                ]);
                
            }

        }
    }

    public function updateCart(Request $request)
    {
        $product_id = $request->input('pid');
        $quantity = $request->input('qty');
        $uid = $request->input('uid');
        if($product_id != '' && $quantity != '' &&  $uid != ""){
            Cart::where('pid', $request->pid)->where('uid', $request->uid)->update([
                'qty' => $request->qty,
            ]);
            return response()->json(['success' => true, 'msg' => "Item updated to cart successfully"]);
        }else{
            return response()->json([
                "success" => false,
                "msg" => "Updating cart was not successful",
            ]);
        }

    }
}
