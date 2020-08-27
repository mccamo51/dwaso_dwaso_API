<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "tbl_cart";
    protected $fillable = ['pid','qty','uid'];

}
