<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {


    //laporan
    Route::get('/laporan/pesanan','LaporanController@pesanan')->name('laporan.pesanan');
    Route::get('/laporan-pesanan/pdf','LaporanController@pesananpdf')->name('pesanan.pdf');
    Route::get('/laporan/quality','LaporanController@quality')->name('laporan.quality');
    Route::get('/laporan-quality/pdf','LaporanController@qualitypdf')->name('quality.pdf');
    Route::get('/laporan/pendapatan','LaporanController@pendapatan')->name('laporan.pendapatan');
    Route::get('/laporan-pendapatan/pdf','LaporanController@pendapatanpdf')->name('pendapatan.pdf');


    //pesanan
    Route::get('/pesanan','PesananController@index')->name('pesanan');
    Route::get('/pesanan/tambah','PesananController@create')->name('pesanan.create');
    Route::get('/pesanan/proses/{id}','PesananController@proses')->name('pesanan.proses');
    Route::get('/pesanan/edit/{id}','PesananController@edit')->name('pesanan.edit');
    Route::get('/pesanan/detail/{id}','PesananController@detail')->name('pesanan.detail');
    Route::get('/pesanan/payment/{id}','PesananController@payment')->name('pesanan.payment');
    Route::post('/pesanan/simpan','PesananController@store')->name('pesanan.simpan');
    Route::get('/pesanan/status/{id}','PesananController@status')->name('status.pesanan');
    Route::post('/pesanan/simpan/status','PesananController@simpan_status_pesanan')->name('simpan.status_pesanan');
    Route::post('/pesanan/payment/simpan','PesananController@payment_store')->name('payment.store');
    Route::post('/pesanan/update','PesananController@update')->name('pesanan.update');
    Route::delete('/pesanan/delete/{id}','PesananController@destroy')->name('pesanan.delete');
    Route::get('/pesanan/invoice/{id}','PesananController@invoice')->name('pesanan.invoice');

    //pengiriman
    Route::get('/pengiriman','PengirimanController@index')->name('pengiriman');
    Route::get('/pengiriman/tambah','PengirimanController@create')->name('pengiriman.create');
    Route::get('/pengiriman/tambah/{id}','PengirimanController@create_id')->name('pengiriman.create_id');
    Route::post('/pengiriman/simpan','PengirimanController@store')->name('pengiriman.simpan');
    Route::post('/pengiriman/update','PengirimanController@update')->name('pengiriman.update');
    Route::delete('/pengiriman/delete/{id}','PengirimanController@destroy')->name('pengiriman.delete');
    Route::get('/pengiriman/suratjalan/{id}','PengirimanController@surat_jalan')->name('pengiriman.cetak');

    //Quality Control
    Route::get('/quality','QualityController@index')->name('quality');
    Route::get('/quality/status/{id}','QualityController@status')->name('quality.status');
    Route::get('/quality/input/{id}','QualityController@input_barang')->name('quality.input');
    Route::get('/quality/tambah','QualityController@create')->name('quality.create');
    Route::get('/quality/proses/{id}','QualityController@proses')->name('quality.proses');
    Route::get('/quality/edit/{id}','QualityController@edit')->name('quality.edit');
    Route::post('/quality/simpan','QualityController@store')->name('quality.simpan');
    Route::post('/quality/simpan/status','QualityController@status_update')->name('status.simpan');
    Route::post('/quality/update','QualityController@update')->name('quality.update');
    Route::delete('/quality/delete/{id}','QualityController@destroy')->name('quality.delete');

    //purchasing
    Route::get('/purchasing','PurchasingController@index')->name('purchasing');
    Route::get('/purchasing/tambah','PurchasingController@create')->name('purchasing.create');
    Route::get('/purchasing/edit/{id}','PurchasingController@edit')->name('purchasing.edit');
    Route::post('/purchasing/simpan','PurchasingController@store')->name('purchasing.simpan');
    Route::post('/purchasing/simpan/status','PurchasingController@store_status')->name('purchasing.status');
    Route::get('/purchasing/payment/{id}','PurchasingController@payment')->name('purchasing.payment');
    Route::post('/purchasing/payment/simpan','PurchasingController@payment_store')->name('po.payment');
    Route::get('/purchasing/stockin/{id}','PurchasingController@stockin')->name('purchasing.stockin');
    Route::post('/purchasing/stockin/simpan','PurchasingController@stockin_store')->name('stockin.simpan');
    Route::post('/purchasing/update','PurchasingController@update')->name('purchasing.update');
    Route::delete('/purchasing/delete/{id}','PurchasingController@destroy')->name('purchasing.delete');

    //Product
    Route::get('/product','ProductController@index')->name('product');
    Route::get('/product/tambah','ProductController@create')->name('product.create');
    Route::get('/product/edit/{id}','ProductController@edit')->name('product.edit');
    Route::post('/product/simpan','ProductController@store')->name('product.simpan');
    Route::post('/product/update','ProductController@update')->name('product.update');
    Route::delete('/product/delete/{id}','ProductController@destroy')->name('product.delete');

    //Supplier
    Route::get('/supplier','SupplierController@index')->name('supplier');
    Route::get('/supplier/tambah','SupplierController@create')->name('supplier.create');
    Route::get('/supplier/edit/{id}','SupplierController@edit')->name('supplier.edit');
    Route::post('/supplier/simpan','SupplierController@store')->name('supplier.simpan');
    Route::post('/supplier/update','SupplierController@update')->name('supplier.update');
    Route::delete('/supplier/delete/{id}','SupplierController@destroy')->name('supplier.delete');

    //Customer
    Route::get('/customer','CustomerController@index')->name('customer');
    Route::get('/customer/tambah','CustomerController@create')->name('customer.create');
    Route::get('/customer/edit/{id}','CustomerController@edit')->name('customer.edit');
    Route::post('/customer/simpan','CustomerController@store')->name('customer.simpan');
    Route::post('/customer/update','CustomerController@update')->name('customer.update');
    Route::get('/customer/delete/{id}','CustomerController@destroy')->name('customer.delete');

    //Paket
    Route::get('/aksesoris','AksesorisController@index')->name('aksesoris');
    Route::get('/aksesoris/tambah','AksesorisController@create')->name('aksesoris.create');
    Route::get('/aksesoris/edit/{id}','AksesorisController@edit')->name('aksesoris.edit');
    Route::post('/aksesoris/simpan','AksesorisController@store')->name('aksesoris.simpan');
    Route::post('/aksesoris/update','AksesorisController@update')->name('aksesoris.update');
    Route::get('/aksesoris/delete/{id}','AksesorisController@destroy')->name('aksesoris.delete');

});

