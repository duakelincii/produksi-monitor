<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanantambahan extends Model
{
    protected $table = 'pesanan_tambahan';
    protected $fillable = ['id_pesanan','id_product','id_aksesoris','qty_aksesoris'];
}
