<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeritaModel extends Model
{
    protected $table='berita';
    protected $fillable = [
        'judul', 'isi',
        ];

    public function paginateBerita($jumlahPage){
      return $this->paginate($jumlahPage);
    }

    public function getAllBerita(){
      return $this->all();
    }

    public function getDetailBerita($id){
      return $this->where('id', $id)->find($id);
    }


    public function tambahBerita($tambah){
      $judul = $tambah['judul'];
      $isi = $tambah['isi'];

      $this->judul = $judul;
      $this->isi = $isi;

      $this->save();
    }

    public function hapusBerita($id){
      DB::beginTransaction();
      try{
        $data = $this->find($id);

        $data->delete();

        DB::commit();
        return json_encode([
          'success' => true,
          'target_id' => $id,
          'message' => 'Sukses menghapus data',
        ]);
      } catch(\Exception $e){
        DB::rollback();

        return json_encode([
          'success' => false,
          'target_id' => $id,
          'message' => $e->getMessage(),
        ]);
      }
    }
}
