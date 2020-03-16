<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IndustriModel;
use App\JurusanModel;
use App\PendaftaranModel;
use App\SiswaModel;

use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class C_Siswa extends Controller
{
    public function index(){
        return view('pages.siswa.dashboard');
    }
    public function pendaftaran(){
        if(session('success_message')){
            Alert::success('Berhasil!', session('success_message'));
          }else if (session('warning_message')){
            Alert::warning('Peringatan!', session('warning_message'));
          }
        $siswa = SiswaModel::where('nis', Auth::user()->username)->first();
        $pendaftar = PendaftaranModel::where('nis', Auth::user()->username)->first();
        $pendaftarDitolak = PendaftaranModel::where('status',2)->get();


        if($pendaftar == null){

            $dataIndustri = [];
            $data = IndustriModel::all();
            foreach($data as $datas){
                foreach(explode(',', $datas->jurusan) as $jurusan){
                    if($siswa->jurusan == $jurusan){
                        array_push($dataIndustri, $datas);
                    }
                }
            }
            return view('pages.siswa.pendaftaran')->with('dataIndustri',$dataIndustri)->withSuccessMessage('Pendaftaran Berhasil');

        } if($pendaftarDitolak == true){

            $dataIndustri = [];
            $data = IndustriModel::all();
            foreach($data as $datas){
                foreach(explode(',', $datas->jurusan) as $jurusan){
                    if($siswa->jurusan == $jurusan){
                        array_push($dataIndustri, $datas);
                    }
                }
            }
            return view('pages.siswa.pendaftaran')->with('dataIndustri',$dataIndustri)->withSuccessMessage('Pendaftaran Berhasil');
        }else {
            return redirect(route('dashboard'));
        }
    }

    public function showdetailPendaftaran($id){
        $industri = industriModel::find($id);
        $jurusan = JurusanModel::all();
        return view ('pages.siswa.detailPendaftaran')
            ->with('industri', $industri)
            ->with('jurusan', $jurusan);//ini tadi aku 1 aja ya?
    }//get siswa by apa
    
    public function tambahPendaftaran(Request $request){
        $pendaftar = PendaftaranModel::where('nis', Auth::user()->username)->first();

        if($pendaftar == null){
            $tambah = new PendaftaranModel();
            $tambah->nis = $request->nis;
            $tambah->dudipilihan = $request->dudipilihan;
            $tambah->status = $request->status;
            $tambah->save();
            return redirect(route('dashboard'));

        }else if($pendaftar != null and $pendaftar->status == 2){
            $update = new PendaftaranModel();
            $update = PendaftaranModel::where('nis', $request->nis)->first();
            $update->dudipilihan = $request->dudipilihan;
            $update->status = $request->status;
            $update->save();
            return redirect(route('dashboard'));
        } else{
            return redirect(route('dashboard'))->with('message-pendaftaran-error', 'Pendaftaran gagal! Anda telah melakukan pendaftaran');
        }
    }

}
