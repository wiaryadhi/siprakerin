@extends('layouts.master')

@section('title', 'Dashboard')


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
        <li><a class="nav-link" href="/dataSiswaProdi"><i class="fas fa-user-friends"></i> <span>Siswa</span></a></li>
        <li><a class="nav-link" href="/dataIndustriProdi"><i class="fas fa-industry"></i> <span>Industri</span></a></li>
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

@section('navbar')
<form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                  class="fas fa-search"></i></a></li>
          </ul>

        </form>

        <!-- navbar atas -->
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="{{ asset('/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi, <b>{{ Auth::user()->username }}</b></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="/profil" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <a href="/dataSiswaProdi">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-user-friends"></i>
                </div>
                <div class="card-wrap">
               
                    <div class="card-header">
                        <h4>Total Siswa Prakerin</h4>
                    </div>
                    <div class="card-body">
                    {{ count($dataPendaftarProdiDiterima) }}
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <a href="/dataIndustriProdi">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-industry"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Industri Prodi</h4>
                    </div>
                    <div class="card-body">
                    {{ count($dataIndustri) }}
                    </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Industri Prodi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Logo</th>
                                    <th>Alamat</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>

                            <!-- Isi dari tabel -->

                            <tbody>
                                @foreach($dataIndustri as $eachdata)
                                <tr>
                                    <td>{!! $eachdata->nama !!}</td>
                                    <td><img width="100px" src="{{ asset($eachdata->logo) }}"></td>
                                    <td>{!! $eachdata->alamat !!}</td>
                                    <td>{!! $eachdata->deskripsi !!}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Siswa Prodi Yang Diterima</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableSiswa" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Industri Pilihan</th>
                                </tr>
                            </thead>

                            <!-- Isi dari tabel -->

                            <tbody>
                                @foreach($dataPendaftarProdiDiterima as $eachdata)
                                <tr>
                                    <td>{!! $eachdata->nis !!}</td>
                                    <td>{!! $eachdata->nama !!}</td>
                                    <td>{!! $eachdata->dudipilihan !!}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer')
<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
    });

</script>
<script>
    $(document).ready(function () {
        $('#tableSiswa').DataTable();
    });

</script>
@endsection
