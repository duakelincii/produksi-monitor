<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchasingtambahan extends Model
{
    protected $table = 'purchasing_tambahan';
    protected $fillable = ['id_purchasing','id_product','id_aksesoris','qty_aksesoris'];
}
