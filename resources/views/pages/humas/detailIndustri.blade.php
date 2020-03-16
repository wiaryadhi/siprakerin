@extends('layouts.master')

@section('title', 'Edit Industri')

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
            <div class="dropdown-divider"></div>
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
        <h1>Detail Industri</h1>
    </div>
        <div class="card card-large-icons">
            <div class="card-icon bg-primary text-white">
                <img width="100px" height="100px" src="{{ asset($industri->logo) }}">
            </div>
            <div class="card-body">
                <h4>{{ $industri->nama }}</h4>
                <div class="dropdown-divider"> </div>
                <br>
                <h6>Alamat</h6>
                <p> {{ $industri->alamat }}</p>
                <h6>Deskripsi</h6>
                <p> {!! $industri->deskripsi !!}</p>
                <h6>Jurusan</h6>
                <p> @php
                          $jurusans = explode(',', $industri->jurusan);
                        @endphp
                        @foreach($jurusan as $eachdata)
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="jurusan[]" value="{{ $eachdata->id }}" class="flat" disabled="disabled"
                              @php
                                for($i = 0; $i < count($jurusans); $i++){
                                  if($jurusans[$i] == $eachdata->id){
                                    echo "checked";
                                    break;
                                  }
                                }
                              @endphp
                              > {!! $eachdata->nama !!}
                            </label>
                        </div>
                        @endforeach</p>
            </div>
        </div>
    </div>
</section>
@endsection
