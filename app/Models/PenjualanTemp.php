<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanTemp extends Model
{

    protected $table      = "tbl_penjualan_temp";
    protected $primaryKey = "id";
    protected $fillable   =
    [
        'id_barang',
        'qty',
    ];
    public $timestamps  = false;

}
