<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kaprodiModel extends Model
{
    protected $table = 'kajur';

    protected $fillable = [
      'nik',
      'nama',
      'jurusan'
    ];
}
