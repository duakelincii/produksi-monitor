<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['nama_product','nama_bahan','stock','harga_beli','harga_jual'];

}
