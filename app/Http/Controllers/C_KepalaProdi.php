<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IndustriModel;
use App\JurusanModel;
use App\siswaModel;
use App\kaprodiModel;
use App\PendaftaranModel;


use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class C_KepalaProdi extends Controller
{
    public function index(){
        return view('pages.kepalaProdi.dashboard');
    }
    public function dataIndustriProdi(){
      if(session('success_message')){
        Alert::success('Berhasil!', session('success_message'));
      }
      
        $kaprodi = kaprodiModel::where('nik', Auth::user()->username)->first();
        $dataIndustri = [];
        $industries = industriModel::all();
        
        foreach($industries as $industry){
            foreach(explode(',', $industry->jurusan) as $jurusan){
                if($kaprodi->jurusan == $jurusan){
                    array_push($dataIndustri, $industry);
                }
            }
        }
        if(session('success_message')){
            Alert::success('Berhasil!', session('success_message'));
          }

        //$data adalah isi data dari model, 'data' adalah nama variabel yang akan dimasukkan kedalam view yang di return
        return view ('pages.kepalaProdi.dataIndustriProdi')->with('dataIndustri',$dataIndustri);
   
    }
    public function showDetailIndustri($id) {
        $data = IndustriModel::all();
        $industri = industriModel::find($id);
        $jurusan = JurusanModel::all();
        return view ('pages.kepalaProdi.detailIndustriProdi')
            ->with('industri', $industri)
            ->with('jurusan', $jurusan);
    }
    public function showTambahIndustriProdi()
    {
        
        $dataJurusan = JurusanModel::all();
        return view ('pages.kepalaProdi.tambahIndustriProdi')->with('dataJurusan',$dataJurusan);
    }

    public function tambahIndustriProdi(Request $request){
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
        return redirect(route('dataIndustriProdi'))->withSuccessMessage('Data Industri Berhasil Ditambahkan');
    }

    public function showEditIndustriProdi($id)
    {
        $industri = industriModel::find($id);
        $jurusan = JurusanModel::all();
        return view ('pages.kepalaProdi.editIndustriProdi')
            ->with('industri', $industri)
            ->with('jurusan', $jurusan);//ini tadi aku 1 aja ya?

    }

    public function updateIndustriProdi($id, Request $request){
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
        return redirect(route('dataIndustriProdi'))->withSuccessMessage('Data Industri Berhasil Dirubah');
    }


    public function hapusIndustriProdi($id)
    {
        $hapus = IndustriModel::find($id);
        $hapus->delete();
        return redirect(route('dataIndustriProdi'))->withSuccessMessage('Industri Berhasil Dihapus');

    }

    //data Pendaftar
    public function dataSiswaProdi() {
      if(session('success_message')){
        Alert::success('Berhasil!', session('success_message'));
      }
        $kaprodi = kaprodiModel::where('nik', Auth::user()->username)->first();
        $dataPendaftar = PendaftaranModel::select('pendaftaran.*', 'industri.nama as dudipilihan','siswa.nama')
            ->join('siswa', 'siswa.nis', '=', 'pendaftaran.nis')
            ->join('industri', 'pendaftaran.dudipilihan', '=', 'industri.id')
            ->where('siswa.jurusan', $kaprodi->jurusan)
            ->where('pendaftaran.status', 0)->get();
        $dataPendaftarDiterima = PendaftaranModel::select('pendaftaran.id', 'pendaftaran.nis', 'industri.nama as dudipilihan', 'pendaftaran.status','siswa.nama')
            ->join('siswa', 'siswa.nis', '=', 'pendaftaran.nis')  
            ->join('industri', 'industri.id', '=', 'pendaftaran.dudipilihan')
          ->where('siswa.jurusan', $kaprodi->jurusan)
          ->where('pendaftaran.status', '!=', 0)->get();
        return view ('pages.kepalaProdi.dataSiswaProdi')->with('dataPendaftar', $dataPendaftar)
        ->with('dataPendaftarDiterima', $dataPendaftarDiterima);
    }
    public function diterima(Request $request){
        // $this->validate($request,[
        //     'status' => 'required',
        // ]);

        $update = PendaftaranModel::find($request->id);
        $update->status = $request->status;
        $update->save();
        // dd('berhasil');
        return redirect(route('dataSiswaProdi'));
    }
    public function ditolak(Request $request){
   
        $update = PendaftaranModel::find($request->id);
        $update->status = $request->status;
        $update->save();
        // dd('berhasil');
        return redirect(route('dataSiswaProdi'));
    }
    
    public function showEditDataPendaftaran($id)
    {
        $pendaftaran = pendaftaranModel::find($id);
        $industri = industriModel::all();
        return view ('pages.kepalaProdi.editDataPendaftaranProdi')
            ->with('pendaftaran', $pendaftaran)
            ->with('industri', $industri);

    }
    public function updateDataPendaftaran($id, Request $request){
        $this->validate($request,[
            'dudipilihan' => 'required'
        ]);

        $update = PendaftaranModel::find($id); 
        $update->dudipilihan = $request->dudipilihan;

        $update->save();
        // dd('berhasil');
        return redirect(route('dataSiswaProdi'));
    }
}
