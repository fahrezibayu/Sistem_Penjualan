<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanTrn extends Model
{

    protected $table        = 'tbl_penjualan_trn';
    protected $primaryKey   = 'id';
    protected $fillable     =
    [
        'id_penjualan',
        'id_barang',
        'qty',
        'harga_barang',
        'total',
    ];
    public $timestamps  = false;

    public function tb_penjualan ()
    {
        return $this->belongsTo(Penjualan::class,'id_penjualan');
    }

}
