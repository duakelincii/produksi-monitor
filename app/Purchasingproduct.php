<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchasingproduct extends Model
{
    protected $table = 'purchasing_product';
    protected $fillable = ['id_purchasing','id_product','qty_product'];

    public function product()
    {
        return $this->belongsTo(Product::class,'id_product','id');
    }
}
