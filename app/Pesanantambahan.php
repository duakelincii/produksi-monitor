<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanantambahan extends Model
{
    protected $table = 'pesanan_tambahan';
    protected $fillable = ['id_pesanan','id_product','id_aksesoris','qty_aksesoris','qty_product'];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class,'id_pesanan','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'id_product','id');
    }

    public function aksesoris()
    {
        return $this->belongsTo(Aksesoris::class,'id_aksesoris','id');
    }
}
