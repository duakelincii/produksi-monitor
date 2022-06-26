<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';
    protected $fillable = ['id_pesanan','id_product','id_customer','quantity','tgl_kirim','nama_supir','no_kendaraan'];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class,'id_pesanan','id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'id_customer','id');
    }
    public function product()
    {
        return $this->belongsTo(product::class,'id_product','id');
    }
}
