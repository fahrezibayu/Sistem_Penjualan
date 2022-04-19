<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{

    protected $table        = 'tbl_penjualan';
    protected $primaryKey   = 'id_penjualan';
    protected $fillable     =
    [
        'id_penjualan',
        'id_user',
        'tgl_penjualan',
        'total',
        'bayar',
        'kembalian',
    ];
    public $timestamps  = false;

    public function tb_penjualan()
    {
        return $this->hasMany([PenjualanTrn::class,'id_penjualan']);
    }

    public function tb_user ()
    {
        return $this->belongsTo(User::class,'id_user');
    }

}
