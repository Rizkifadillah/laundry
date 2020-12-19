<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class T_pesanan extends Model
{
    protected $table= 't_pesanan';
    public $incrementing = false;
    
    public function customers(){
        return $this->belongsTo('App\Model\Customer','customer','id');
    }

    public function pakets(){
        return $this->belongsTo('App\Model\Paket','paket','id');
    }

    public function status_pesanans(){
        return $this->belongsTo('App\Status_pesanan','status_pesanan','id');
    }

    public function status_pembayarans(){
        return $this->belongsTo('App\Status_pembayaran','status_pembayaran','id');
    }
}
