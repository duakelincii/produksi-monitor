<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchasing extends Model
{
    protected $table = 'purchasing';
    protected $fillable = ['id_supplier','no_po','id_product','quantity','harga_barang','tgl_order','tgl_tempo','status'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'id_supplier','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'id_product','id');
    }
}
