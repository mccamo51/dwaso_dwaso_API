<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemCartController extends Controller
{

    public function getcart(Request $request){
        $uid = $request->input('uid');
        if($uid != '' ){
            $result = DB::table('tbl_cart')
            ->join('tbl_user','tbl_user.uid','=','tbl_cart.uid')
            ->join('tbl_product','tbl_product.pid','=','tbl_cart.pid')
            ->join('tbl_product_details', 'tbl_product_details.pid', '=', 'tbl_product.pid')
            ->join('tbl_catgories', 'tbl_catgories.cat_id','=','tbl_product.cat_id')
            ->select('tbl_product.product', 
                'tbl_catgories.category', 
                'tbl_product.price', 
                'tbl_product.img_url',
                'tbl_product_details.size',
                'tbl_product_details.color',
                'tbl_cart.qty','tbl_cart.pid')
            ->where('tbl_user.uid', $request->uid)
            ->get();
            if($result != null){
                return response()->json([
                    'success' => true,
                    'data' => $result
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'msg' => 'No Data found!'
                ]);
            }

        }else{
            return response()->json([
                'success' => false,
                'msg' => 'No Username entered!'
            ]);
            
        }


    }
}
