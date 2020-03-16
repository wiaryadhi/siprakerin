<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class siswaModel extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
      'nis',
      'nama',
      'tgllahir',
      'jeniskelamin',
      'nohp',
      'jurusan',
      'foto'
    ];
}
