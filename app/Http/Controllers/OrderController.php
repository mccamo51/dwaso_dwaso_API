<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function order(Request $request)
    {
        $order_no = $request->input('order_no');
        $uid = $request->input('uid');
        $address_id = $request->input('address_id');
        $amount = $request->input('amount');
        $payment = $request->input('payment');

        if ($order_no != '' && $uid != '') {

            $cartCount = Cart::Where("uid", "=", $request->uid)->count();
            if ($cartCount > 0) {
                Cart::where("uid", $request->uid)->update([
                    'order_no' => $order_no
                ]);

                $select = Cart::where("uid", $request->uid)
                    ->select(array('pid', 'order_no', 'qty'));
               
                DB::table('tbl_order_item')->insertUsing(['pid', 'order_no', 'qty'], $select);

                DB::table('tbl_cart')->where('uid', $request->uid)->delete();

                 return response()->json(['success' => true, 'msg' => "Everything works successfully"]);
            } else {
                return response()->json(['success' => false, 'msg' => "No item displayed in cart"]);
            }
        } else {
        }
        // DB::raw("INSERT INTO tbl_order_item (order_no, pid, qty)
        // SELECT order_no, pid, qty 
        // FROM tbl_cart
        // WHERE tbl_cart.uid = '1'");

        //     return response()->json([
        //         "success" => true,
        //         "data" => 'Worked',
        //     ]);
    }
}
