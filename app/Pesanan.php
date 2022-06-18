<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table  = 'pesanan';
    protected $fillable = ['id_customer','id_product','tgl_pesan','tgl_selesai','quantity','tgl_tempo','status','barang_ready'];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'id_customer','id');
    }

    public function detail()
    {
        return $this->belongsTo(Pesenandetails::class,'id_pesanan','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'id_product','id');
    }
}
