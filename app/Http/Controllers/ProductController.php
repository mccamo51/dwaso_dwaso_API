<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function product(){
      $data =   DB::table('tbl_product')
      ->join('tbl_product_details', 'tbl_product_details.pid','=', 'tbl_product.pid')
      ->join('tbl_catgories', 'tbl_catgories.cat_id', '=', 'tbl_product.cat_id')
      ->select(
            'tbl_catgories.category',
            'tbl_product.product',
            'tbl_product.price',
            'tbl_product.pid',
            'tbl_product.description',
            'tbl_product.img_url',
            'tbl_product_details.size',
            'tbl_product_details.color',

               
            )
      ->where('tbl_product.deleted','=','0')
      ->get();
       return response()->json([
            "success" => true,
            "msg" => "Data successfully loaded",
            "data" => $data
        ]);
    }
}
