<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchasingtambahan extends Model
{
    protected $table = 'purchasing_tambahan';
    protected $fillable = ['id_purchasing','id_aksesoris','qty_aksesoris'];

    public function aksesoris()
    {
        return $this->belongsTo(Aksesoris::class,'id_aksesoris','id');
    }

}
