<?php

namespace App\Http\Controllers;

use File;
use App;

use App\IndustriModel;
use App\JurusanModel;
use App\BeritaModel;
use App\PendaftaranModel;
use App\userModel;
use App\siswaModel;
use App\guruPModel;
use App\kaprodiModel;



use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class C_Humas extends Controller {

    public function dataIndustri() {
      $this->IndustriModel = new IndustriModel();
      $data = $this->IndustriModel->getAll();

        if(session('success_message')){
          Alert::success('Berhasil!', session('success_message'));
        } 
        
        //$data adalah isi data dari model, 'data' adalah nama variabel yang akan dimasukkan kedalam view yang di return
        return view ('pages.humas.dataIndustri')->with('data',$data);
    }

    public function showDetailIndustri($id) {
      $this->IndustriModel = new IndustriModel();
      $this->JurusanModel = new JurusanModel();

    
        $industri = $this->IndustriModel->getDataByID($id);
        $jurusan = $this->JurusanModel->getAll();
        return view ('pages.humas.detailIndustri')
            ->with('industri', $industri)
            ->with('jurusan', $jurusan);
    }

    public function showTambahIndustri()
    {
        $this->JurusanModel = new JurusanModel();
        $data = $this->JurusanModel->getAll();
        return view ('pages.humas.tambahIndustri')->with('data',$data);
    }

    public function tambahIndustri(Request $request){
      $tambah = new IndustriModel();
      $tambah->nama = $request->nama;
      $tambah->alamat = $request->alamat;
      $tambah->deskripsi = $request->deskripsi;

      $tambahjurusan = "";
      $i = 0;
      foreach ($request->jurusan as $jurusan) {
        if ($i != 0) {
          $tambahjurusan = $tambahjurusan.",".$jurusan;
        } else if ($i == 0){
          $tambahjurusan = $tambahjurusan."".$jurusan;
        }
        $i++;
      }
      $tambah->jurusan = $tambahjurusan;

      if (isset(industriModel::all()->last()->id)) {
        $newId = IndustriModel::all()->last()->id + 1;
      } else {
        $newId = 1;
      }

      if($request->hasFile('logo')){
        $img = $request->file('logo');
        $logo = 'DUDI_logos/'.$newId.'/DUDI_'.$newId.'.'.$img->getClientOriginalExtension();

        //move($destinationPath, $fileName)
        $img->move('DUDI_logos/'.$newId,'DUDI_'.$newId.'.'.$img->getClientOriginalExtension());
        $tambah->logo = $logo;
      }

      $tambah->save();
      return redirect(route('dataIndustri'))->withSuccessMessage('Data Industri Berhasil Ditambahkan');
  }

    public function deleteIndustri($id){
      $ModelIndustri = new IndustriModel();

      $delete = $ModelIndustri->deleteData($id);

      if(json_decode($delete)->success){
        return redirect(route('dataIndustri'))->withSuccessMessage('Data Industri Berhasil Dihapus');
      } else {
        return '<script>alert("'.json_decode($delete)->message.'")</script>';
      }
    }

    public function showEditIndustri($id)
    {
        $industri = industriModel::find($id);
        $jurusan = JurusanModel::all();
        return view ('pages.humas.editIndustri')
            ->with('industri', $industri)
            ->with('jurusan', $jurusan);

    }

    public function updateIndustri($id, Request $request){
      $this->validate($request,[
        'nama' => 'required',
        'deskripsi'=> 'required'
    ]);

    $update = industriModel::find($id); //ini tadi jurusanmodel kampank
    $update->nama = $request->nama;
    $update->alamat = $request->alamat;
    $update->deskripsi = $request->deskripsi;

    $updatejurusan = "";
    $i = 0;
    foreach ($request->jurusan as $jurusan) {
      if ($i != 0) {
        $updatejurusan = $updatejurusan.",".$jurusan;
      } else if ($i == 0){
        $updatejurusan = $updatejurusan."".$jurusan;
      }
      $i++;
    }
    $update->jurusan = $updatejurusan;

    if($request->hasFile('logo')){
      $img = $request->file('logo');
      $logo = 'DUDI_logos/'.$id.'/DUDI_'.$id.'.'.$img->getClientOriginalExtension();

      //move($destinationPath, $fileName)
      $img->move('DUDI_logos/'.$id,'DUDI_'.$id.'.'.$img->getClientOriginalExtension());
      $update->logo = $logo;
    }

    $update->save();
    // dd('berhasil');
    return redirect(route('dataIndustri'))->withSuccessMessage('Data Industri Berhasil Dirubah');

      
    }

    // public function hapusIndustri($id)
    // {
    //     $hapus = IndustriModel::find($id);

    //     $hapus->delete();
    //     return redirect(route('dataIndustri'))->withSuccessMessage('Industri Berhasil Dihapus');

    // }


    //data Pendaftar
    public function dataSiswa() {
      if(session('success_message')){
        Alert::success('Berhasil!', session('success_message'));
      }
      $dataPendaftar = PendaftaranModel::select('pendaftaran.*', 'industri.nama as dudipilihan','siswa.nama')
            ->join('siswa', 'siswa.nis', '=', 'pendaftaran.nis')
            ->join('industri', 'pendaftaran.dudipilihan', '=', 'industri.id')
            ->where('pendaftaran.status', 0)->get();

        $dataPendaftarDiterima = PendaftaranModel::select('pendaftaran.id', 'pendaftaran.nis', 'industri.nama as dudipilihan', 'pendaftaran.status','siswa.nama')
            ->join('siswa', 'siswa.nis', '=', 'pendaftaran.nis')  
            ->join('industri', 'industri.id', '=', 'pendaftaran.dudipilihan')
          ->where('pendaftaran.status', '!=', 0)->get();

      // $this->PendaftaranModel = new PendaftaranModel();
      //   $dataPendaftar = $this->PendaftaranModel->getDataSiswa();

      //   $dataPendaftarDiterima = $this->PendaftaranModel->getdataSiswaDiterima();

        return view ('pages.humas.dataSiswa')->with('dataPendaftar', $dataPendaftar)->with('dataPendaftarDiterima', $dataPendaftarDiterima);
    }

    public function diterima(Request $request){

        $update = PendaftaranModel::find($request->id);
        $update->status = $request->status;
        $update->save();
        // dd('berhasil');
        return redirect(route('dataSiswa'));
    }
    public function ditolak(Request $request){

      $update = PendaftaranModel::find($request->id);
      $update->status = $request->status;
      $update->save();
      // dd('berhasil');
      return redirect(route('dataSiswa'));
    }

    public function showEditDataPendaftaran($id)
    {
        $pendaftaran = pendaftaranModel::find($id);
        $dataIndustri = industriModel::all();
     
        return view ('pages.humas.editDataPendaftaran')
            ->with('pendaftaran', $pendaftaran)
            ->with('dataIndustri', $dataIndustri);

    }
    public function updateDataPendaftaran($id, Request $request){
        $this->validate($request,[
            'dudipilihan' => 'required'
        ]);
        $this->PendaftaranModel = new PendaftaranModel();
        $update = array();
        $update = PendaftaranModel::find($id);
        $update['dudipilihan'] = $request->dudipilihan;

        $update = $this->PendaftaranModel->updateDataPendaftaran($update);
        // dd('berhasil');
        return redirect(route('dataSiswa'))->withSuccessMessage('Data Pendaftaran Berhasil Dirubah');
    }




    //Berita
    public function berita() {
      $this->BeritaModel = new BeritaModel();
        $data = $this->BeritaModel->getAllBerita();
        return view ('pages.humas.berita')->with('data',$data);
    }

    public function tambahBerita(Request $request){
        $this->BeritaModel = new BeritaModel();
        $tambah = array();
        $tambah['judul'] = $request->judul;
        $tambah['isi'] = $request->isi;

        $this->BeritaModel->tambahBerita($tambah);
        // dd('berhasil');
        return redirect(route('berita'));
    }

    public function showTambahBerita()
    {
        $data = JurusanModel::all();
        return view ('pages.humas.tambahBerita')->with('data',$data);
    }

    public function showEditBerita($id)
    {
      $this->BeritaModel = new BeritaModel();
      $berita = $this->BeritaModel->getDetailBerita($id);
        return view ('pages.humas.editBerita')
            ->with('berita', $berita);

    }

    public function updateBerita($id, Request $request){
        $this->validate($request,[
            'judul' => 'required',
            'isi'=> 'required'
        ]);

        $update = BeritaModel::find($id); //ini tadi jurusanmodel kampank
        $update->judul = $request->judul;

        $update->isi = $request->isi;

        $update->save();
        // dd('berhasil');
        return redirect(route('berita'));
    }


    public function hapusBerita($id)
    {
        $hapus = BeritaModel::find($id);
        $hapus->delete();
        return redirect(route('berita'));

    }

    //akun
    public function akun() {
      if(session('success_message')){
        Alert::success('Berhasil!', session('success_message'));
      }
        $data = userModel::where('isValidate', 0)->get();
        $dataTervalidasi = userModel::where('isValidate', 1)->get();
        //$data adalah isi data dari model, 'data' adalah nama variabel yang akan dimasukkan kedalam view yang di return
        return view ('pages.humas.akun')->with('data',$data)->with('dataTervalidasi',$dataTervalidasi);
    }
    public function akunDiterima(Request $request){

      dd($request->all());
        $update = userModel::find($request->id);
        $update->isValidate = $request->isValidate;
        $update->save();

        //apabila yang divalidasi guru pembimbing, privilege = 2
        if ($request->privilege == 2) {
          guruPModel::create([
            'nik' => $request->username,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
          ]);
        }
        //apabila yang divalidasi kepala prodi, privilege = 3
        else if ($request->privilege == 3) {
          kaprodiModel::create([
            'nik' => $request->username,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan
          ]);
        } else if ($request->privilege == 4) {
          siswaModel::create([
            'nis' => $request->username,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
          ]);
        }
        // dd('berhasil');
        return redirect(route('akun'));
    }

    public function hapusAkun($id)
    {
        $hapus = userModel::find($id);
        $hapus->delete();
        return redirect(route('akun'));
    }

    public function updateAkun($id, Request $request){
        $update = userModel::find($id);
        $update->password = bcrypt($request->password);
        $update->save();
        // dd('berhasil');
        return redirect(route('akun'))->withSuccessMessage('Password Berhasil Dirubah');
    }

    public function showEditAkun($id)
    {
        $data = userModel::find($id);
        return view ('pages.humas.editAkun')
            ->with('data', $data);

    }
}
