<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aksesoris extends Model
{
    protected $table = 'aksesoris';
    protected $fillable = ['nama_aksesoris','stock','harga'];
}
