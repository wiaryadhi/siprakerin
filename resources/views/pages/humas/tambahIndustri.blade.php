@extends('layouts.master')

@section('title', 'Tambah Industri')

@section('sidebar')
<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="/dashboard">SIPRAKERIN</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="/dashboard">SP</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Menu</li>
        <li><a class="nav-link" href="/dashboard"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
        <li><a class="nav-link" href="/dataSiswa"><i class="fas fa-user-friends"></i> <span>Siswa</span></a></li>
        <li><a class="nav-link" href="/dataIndustri"><i class="	fas fa-industry"></i> <span>Industri</span></a></li>
        <li><a class="nav-link" href="/berita"><i class="far fa-newspaper"></i> <span>Berita</span></a></li>
        <li><a class="nav-link" href="/akun"><i class="far fa-user"></i> <span>Akun</span></a></li>
    </ul>
    </div>
</aside>
@endsection


@section('navbar')
<form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>

</form>

<!-- navbar atas -->
<ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <b>{{ Auth::user()->username }}</b></div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
</ul>

@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Form Tambah Industri</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Form Tambah Industri</h4>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data"
            class="form-horizontal form-label-left" action="{{ route('tambahIndustri') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Industri</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="nama" id="nama"
                            placeholder="Masukan Nama Industri"  class="required">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat Industri</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="alamat" id="alamat"
                            placeholder="Masukan Alamat Industri" class="required">
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jurusan yang Sesuai dengan
                        Industri</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        @foreach($data as $eachdata)
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="jurusan[]" value="{{ $eachdata->id }}" class="flat" checked>
                              {!! $eachdata->nama !!}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi Industri
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea name="deskripsi" id="deskripsi" class="form-control " rows="10"
                            placeholder="Deskripsi Industri" class="required"></textarea>
                    </div>
                </div>
                <div class="form-group row mb-4 ">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">Unggah Logo Industri</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="file" class="form-control" name="logo">
                      </div>
                    </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
@endsection