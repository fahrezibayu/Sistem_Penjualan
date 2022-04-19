<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{

    protected $table      = "tbl_merk";
    protected $primaryKey = "id_merk";
    protected $fillable   =
    [
        'nama_merk',
        'created_at',
        'updated_at'
    ];

    public function tb_merk()
    {
        return $this->hasMany([Barang::class,'id_merk']);
    }

}
