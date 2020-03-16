<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\Response;

use App\MonitoringModel;
use App\IndustriModel;
use App\guruPModel;


class C_GuruP extends Controller
{

    public function monitoring()
    {
        return view ('pages.guruP.monitoring');
    }

    public function showUnduhLaporan()
    {
        $industri = IndustriModel::all();
        return view ('pages.guruP.unduhLaporan')->with('industri',$industri);
    }
    public function unduhLaporan(Request $request){
        set_time_limit(300);

        $industri = IndustriModel::find($request->industri_id)->nama;

        // memanggil dan membaca template dokumen yang telah kita buat
        $document = file_get_contents(storage_path().'/template/template_monitoring.rtf');
        // isi dokumen dinyatakan dalam bentuk string
        $document = str_replace("#DUDI", $industri, $document);
        // header untuk membuka file output RTF dengan MS. Word
        header("Content-type: application/msword");
        header("Content-disposition: inline; filename=laporan.doc");
        header("Content-length: ".strlen($document));

        // flush();

        echo $document;
        // return response()->download($document, 'laporan.doc');
        // echo $document;
    }

}
