<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QualityControl extends Model
{
    protected $table = 'quality_control';
    protected $fillable = ['id_pesanan','id_product','status','barang_ready','barang_rusak','ket'];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class,'id_pesanan','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'id_product ','id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'id_pesanan','id');
    }

}
