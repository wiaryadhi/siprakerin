<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class industriModel extends Model
{
    protected $table = 'industri';

    protected $fillable = [
        'nama', 'alamat', 'deskripsi', 'jurusan', 'logo'
        ];

    public function getAll(){
        return $this->all();
    }

    public function getDataById($id){
        return $this->where('id', $id)->first();
    }

    public function tambahIndustri($tambah){
        $nama = $tambah['nama'];
        $alamat = $tambah['alamat'];
        $deskripsi = $tambah['deskripsi'];
        $jurusan = $tambah['jurusan'];
        $logo = $tambah['logo'];

        $this->nama = $nama;
        $this->alamat = $alamat;
        $this->deskripsi = $deskripsi;
        $this->logo = $logo;
        $this->jurusan = $jurusan;

        $this->save();

    }

    public function deleteData($id){
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

    public function updateData($request){
      DB::beginTransaction();
      try{
        $data = $this->find($request->get('id'));

        $data->nama = $request->get('nama');
        $data->alamat = $request->get('alamat');
        $data->deskripsi = $request->get('deskripsi');
        $data->jurusan = $request->get('jurusan');
        $data->logo = $request->get('logo');

        $data->save();

        DB::commit();

        return json_encode([
          'success' => true,
          'target_id' => $request->get('id'),
          'message' => 'Sukses mengubah data',
        ]);
      } catch(\Exception $e){
        DB::rollback();

        return json_encode([
          'success' => false,
          'target_id' => $request->get('id'),
          'message' => $e->getMessage(),
        ]);
      }
    }
}
