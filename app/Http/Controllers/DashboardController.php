<?php

namespace App\Http\Controllers;

use App\IndustriModel;
use App\siswaModel;
use App\kaprodiModel;
use App\MonitoringModel;
use App\PendaftaranModel;
use App\userModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;



class DashboardController extends Controller
{
    public function index(){
        $dataIndustri = IndustriModel::all();
        $dataSiswa = siswaModel::all();
        $dataMonitoring = MonitoringModel::all();
        $dataPendaftaran = PendaftaranModel::all();
        $dataPendaftarDiterima = PendaftaranModel::select('pendaftaran.id', 'pendaftaran.nis','industri.nama as dudipilihan', 'pendaftaran.status','siswa.nama')
        ->join('industri', 'industri.id', '=', 'pendaftaran.dudipilihan')
        ->join('siswa', 'siswa.nis', '=', 'pendaftaran.nis')
        ->where('pendaftaran.status', '=', 1)->get();
     
        $dataUser = userModel::all();
        $belumValidasi = $dataUser->where('isValidate', 0);
      

        if (Auth::user()->privilege == 1 && Auth::user()->isValidate == 1 ) {
           
            return view('pages.humas.dashboard')->with('dataIndustri',$dataIndustri)->with('dataSiswa',$dataSiswa)->with('dataPendaftarDiterima',$dataPendaftarDiterima)->with('dataUser',$dataUser)->with('belumValidasi',$belumValidasi)
            ->with('dataPendaftaran',$dataPendaftaran);
        } else if (Auth::user()->privilege == 2){
            return view('pages.guruP.monitoring');
        } else if (Auth::user()->privilege == 3){
            $kaprodi = kaprodiModel::where('nik', Auth::user()->username)->first();
            $dataSiswa = siswaModel::where('jurusan', $kaprodi->jurusan)->get();
            $dataPendaftaranProdi = PendaftaranModel::select('pendaftaran.nis')->join('siswa','siswa.nis','=','pendaftaran.nis')
                                    ->where('pendaftaran.status', 1)
                                    ->where('siswa.jurusan', $kaprodi->jurusan)->get();
                                    $dataPendaftarProdiDiterima = PendaftaranModel::select('pendaftaran.id', 'pendaftaran.nis', 'industri.nama as dudipilihan', 'pendaftaran.status','siswa.jurusan', 'siswa.nama')
                                    ->join('industri', 'industri.id', '=', 'pendaftaran.dudipilihan')
                                    ->join('siswa', 'siswa.nis', '=', 'pendaftaran.nis')
                                    ->where('pendaftaran.status', '=',  $kaprodi->jurusan)
                                    ->where('siswa.jurusan', '=', 1)->get();

            // gimana caranya supaya bisa nampilin industri dari jurusan yang sama dengan kaprodi                        
            $dataIndustri = [];
            $industries = industriModel::all();
            
            foreach($industries as $industry){
                foreach(explode(',', $industry->jurusan) as $jurusan){
                    if($kaprodi->jurusan == $jurusan){
                        array_push($dataIndustri, $industry);
                    }
                }
            }

            return view('pages.kepalaProdi.dashboard')->with('dataIndustri',$dataIndustri)->with('dataSiswa',$dataSiswa)
            ->with('dataPendaftaranProdi',$dataPendaftaranProdi)->with('dataPendaftarProdiDiterima',$dataPendaftarProdiDiterima);
            // ->with('dataIndustriProdi',$dataIndustriProdi);
        } else if (Auth::user()->privilege == 4){
            $siswa = siswaModel::where('nis', Auth::user()->username)->first();
            $pendaftar = PendaftaranModel::where('nis', Auth::user()->username)->first();

            if($pendaftar!=null){
                $industriPilihan = IndustriModel::find($pendaftar->dudipilihan);
                $status = $pendaftar->status;
                if($status == 0){
                    $message = 'Menunggu pengumuman di <b>'.$industriPilihan->nama.'</b>';
                }else if($status == 1){
                    $message = 'Diterima pada Industri pilihan';
                }else if($status == 2){
                    $message = 'Ditolak pada industri pilihan <br> Silahkan mendaftar kembali';
                }
             } else{
                     $message = 'Anda belum mendaftar prakerin!';
            } 
            $dataIndustri = [];
            $industries = industriModel::all();
            
            foreach($industries as $industry){
                foreach(explode(',', $industry->jurusan) as $jurusan){
                    if($siswa->jurusan == $jurusan){
                        array_push($dataIndustri, $industry);
                    }
                }
            }
            return view('pages.siswa.dashboard')->with('dataIndustri',$dataIndustri)->with('message', $message);
        } 
         
    }
}
