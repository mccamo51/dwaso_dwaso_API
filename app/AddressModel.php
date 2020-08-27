<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
    protected $table = "tbl_address";
    protected $fillable = ['uid', 'street', 'house_no', 'lane'];

}
