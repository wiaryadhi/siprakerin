<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendaftaranModel extends Model
{
    protected $table = 'pendaftaran';
    protected $fillable = [
        'nis','dudipilihan','status' 
        ];

    public function getDataSiswa(){
        return $this->select('pendaftaran.id', 'pendaftaran.nis', 'industri.nama as dudipilihan', 'pendaftaran.status','siswa.nama')
        ->join('industri', 'industri.id', '=', 'pendaftaran.dudipilihan')
        ->join('siswa', 'siswa.nis', '=', 'pendaftaran.nis')
        ->where('pendaftaran.status', 0)->get();
    }

    public function getDataSiswaDiterima(){
        return $this->select('pendaftaran.id', 'pendaftaran.nis', 'industri.nama as dudipilihan', 'pendaftaran.status',"siswa.nama")
        ->join('industri', 'industri.id', '=', 'pendaftaran.dudipilihan')
        ->join('siswa', 'siswa.nis', '=', 'pendaftaran.nis')
        ->where('pendaftaran.status', '!=', 0)->get();
    }
    
    public function pendaftaranDiterima($request, $id){
        $update = $this->find($id);
        $update->status = $request->status;
        $update->save();
        return $update;
      }
    public function pendaftaranDitolak($request, $id){
        $update = $this->find($id);
        $update->status = $request->status;
        $update->save();
        return $update;
      }

      public function updateDataPendaftaran($request, $id){
        $update = $this->find($id);

        $update->dudipilihan = $request->dudipilihan;

        $update->save();
        return $update;
      }    
}
