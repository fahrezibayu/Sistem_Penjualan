<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{

    protected $table      = "tbl_barang";
    protected $fillable   =
    [
        'id_barang',
        'nama_barang',
        'harga_barang',
        'foto',
        'id_merk',
        'id_user',
        'created_at',
        'updated_at'
    ];

    public function tb_user ()
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function tb_merk ()
    {
        return $this->belongsTo(Merk::class,'id_merk');
    }

}
