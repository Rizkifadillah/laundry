<?php

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
    return redirect('beranda');
});

Route::group(['middleware'=>'auth'],function(){

    Route::get('beranda', 'Beranda_controller@index');

    Route::get('paket-laundry', 'Paket_controller@index');
    Route::get('paket-laundry/add', 'Paket_controller@add');
    Route::post('paket-laundry/add', 'Paket_controller@store');
    Route::get('paket-laundry/{id}', 'Paket_controller@edit');
    Route::put('paket-laundry/{id}', 'Paket_controller@update');
    Route::delete('paket-laundry/{id}', 'Paket_controller@delete');

    Route::get('customer', 'Customer_controller@index');
    Route::get('customer/add', 'Customer_controller@add');
    Route::post('customer/add', 'Customer_controller@store');
    Route::get('customer/{id}', 'Customer_controller@edit');
    Route::put('customer/{id}', 'Customer_controller@update');
    Route::delete('customer/{id}', 'Customer_controller@delete');

    Route::get('status-pesanan', 'Status_pesanan_controller@index');
    Route::get('status-pesanan/add', 'Status_pesanan_controller@add');
    Route::post('status-pesanan/add', 'Status_pesanan_controller@store');
    Route::get('status-pesanan/{id}', 'Status_pesanan_controller@edit');
    Route::put('status-pesanan/{id}', 'Status_pesanan_controller@update');
    Route::delete('status-pesanan/{id}', 'Status_pesanan_controller@delete');

    Route::get('status-pembayaran', 'Status_Pembayaran_controller@index');
    Route::get('status-pembayaran/add', 'Status_Pembayaran_controller@add');
    Route::post('status-pembayaran/add', 'Status_Pembayaran_controller@store');
    Route::get('status-pembayaran/{id}', 'Status_Pembayaran_controller@edit');
    Route::put('status-pembayaran/{id}', 'Status_Pembayaran_controller@update');
    Route::delete('status-pembayaran/{id}', 'Status_Pembayaran_controller@delete');

    Route::get('transaksi-pesanan', 'T_pesanan_controller@index');
    Route::get('transaksi-pesanan/periode', 'T_pesanan_controller@periode');

    Route::get('transaksi-pesanan/add', 'T_pesanan_controller@add');
    Route::post('transaksi-pesanan/add', 'T_pesanan_controller@store');
    Route::get('transaksi-pesanan/{id}', 'T_pesanan_controller@edit');
    Route::put('transaksi-pesanan/{id}', 'T_pesanan_controller@update');     
    Route::delete('transaksi-pesanan/{id}', 'T_pesanan_controller@delete');     

    Route::get('transaksi-pesanan/naikan-status/{id}', 'T_pesanan_controller@naikan_status');
    Route::get('transaksi-pesanan/naikan-status-pembayaran/{id}', 'T_pesanan_controller@naikan_status_pembayaran');

    Route::get('transaksi-pesanan/print/{id}', 'T_pesanan_controller@export');

    Route::get('profil','Profil_controller@index');
    Route::get('profil/add','Profil_controller@add');
    Route::put('profil/add','Profil_controller@update');

    Route::get('karyawan','Karyawan_controller@index');
    Route::get('karyawan/add', 'Karyawan_controller@add');
    Route::post('karyawan/add', 'Karyawan_controller@store');
    Route::get('karyawan/{id}', 'Karyawan_controller@edit');
    Route::put('karyawan/{id}', 'Karyawan_controller@update');
    Route::delete('karyawan/{id}', 'Karyawan_controller@delete');

});

Auth::routes();

Route::get('/home',function () {
    return redirect('beranda');
});

Route::get('keluar',function(){
    \Auth::logout();
    return redirect('login');
});
