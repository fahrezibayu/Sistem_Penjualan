<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileApp extends Model
{

   protected $table      = 'tbl_profile_app';
   protected $fillable     =
   [
       'nama',
       'nama_aplikasi',
       'photo',
       'created_at',
       'updated_at'
   ];

}
