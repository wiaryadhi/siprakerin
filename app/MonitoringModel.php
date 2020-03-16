<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonitoringModel extends Model
{
    protected $table = 'monitoring';
    protected $fillable = [
        'nik', 'nis','nama_pembimbing','nama_siswa','dudi','tglmonitoring'
        ];
}
