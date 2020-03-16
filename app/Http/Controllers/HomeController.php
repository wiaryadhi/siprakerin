<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BeritaModel;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $this->BeritaModel = new BeritaModel();
        // $data = BeritaModel::all();
        $data = $this->BeritaModel->paginate(5);
        return view('/index')->with('data',$data);

    }
    public function post($id){
        $this->BeritaModel = new BeritaModel();
        $data = $this->BeritaModel->getDetailBerita($id); 
        return view('/post')->with('data',$data);
    }
}
