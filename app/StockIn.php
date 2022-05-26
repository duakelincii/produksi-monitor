<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    protected $table = 'stock_in';
    protected $fillable = ['id_purchasing','id_product','quantity','harga_beli'];

    public function purchasing()
    {
        return $this->belongsTo(Purchasing::class,'id_purchasing','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'id_product','id');
    }
}
