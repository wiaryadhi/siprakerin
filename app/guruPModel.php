<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class guruPModel extends Model
{
    protected $table = 'pembimbing';

    protected $fillable = [
      'nik',
      'nama',
      'tgllahir',
      'jeniskelamin',
      'nohp',
      'jurusan',
      'foto'
    ];
}
