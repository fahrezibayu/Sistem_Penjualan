<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogSession extends Model
{

    protected $table        = 'log_session';
    protected $primaryKey   = 'id_session';
    protected $fillable     =
    [
        'id',
        'tanggal_in',
        'jamin',
        'tanggal_out',
        'jamout',
        'status'
    ];
    public $timestamps  = false;
    public function tb_user ()
    {
        return $this->belongsTo(User::class,'id');
    }

}
