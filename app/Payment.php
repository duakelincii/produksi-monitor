<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $fillable = [
        'id_pesanan','tgl_bayar','jumlah_bayar','nama_rekening','no_rekening','bukti_bayar'
    ];
}
