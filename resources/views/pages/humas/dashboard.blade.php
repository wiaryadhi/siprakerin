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
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="/dataSiswa">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Siswa Prakerin</h4>
                        </div>
                        <div class="card-body">
                            {{ count($dataPendaftaran) }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="/dataIndustri">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-industry"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Industri</h4>
                        </div>
                        <div class="card-body">
                            {{ count($dataIndustri) }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="/akun">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-industry"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4> Total Akun yang Belum Divalidasi</h4>
                        </div>
                        <div class="card-body">
                            {{ $belumValidasi->count() }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Industri</h4>
                    <div class="card-header-action">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableIndustri" class="table table-hover">
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
                <div class="card-footer text-right">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Siswa Yang Telah Diterima</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Industri Pilihan</th>
                                </tr>
                            </thead>

                            <!-- Isi dari tabel -->

                            <tbody>
                               @foreach($dataPendaftarDiterima as $eachdata)
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
        $('#tableIndustri').DataTable();
    });

</script>
@endsection
