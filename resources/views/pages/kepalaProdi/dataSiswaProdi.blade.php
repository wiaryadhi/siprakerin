@extends('layouts.master')

@section('title', 'Data Siswa')

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
        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
        </li>
    </ul>

</form>

<!-- navbar atas -->
<ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <b>{{ Auth::user()->username }}</b></div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a href="/profil" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
            </a>
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
        <h1>Data Siswa Pendaftar Prakerin</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Siswa Pendaftar</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Industri Pilihan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <!-- Isi dari tabel -->

                            <tbody>
                                @foreach($dataPendaftar as $eachdata)
                                <tr>
                                    <td>{!! $eachdata->nis !!}</td>
                                    <td>{!! $eachdata->nama !!}</td>
                                    <td>{!! $eachdata->dudipilihan !!}</td>
                                    <td>
                                        <div class="row">
                                            <a href="/editDataPendaftaranProdi/{{ $eachdata->id }}">
                                                <button type="submit" class="btn btn-info btn-md " data-toggle="tooltip"
                                                    data-placement="bottom" title="Edit">
                                                    <i class="fas fa-edit"></i></button>
                                            </a>
                                            <form id="form_terima" action="{{ route('kepalaPDataSiswaDiterima') }}" method="POST">
                                            <a>
                                                @csrf
                                                    <input type="hidden" name="id" id="id" value="{{ $eachdata->id }}">
                                                    <input type="hidden" name="status" id="status" value="1">
                                                    
                                                    <button id="btn_terima" type="button" class=" btn btn-success btn-md">
                                                    <i class="fas fa-check" data-toggle="tooltip"
                                                    data-placement="bottom" title="Diterima"></i></button>
                                            </a>
                                            </form>

                                            <form id="form_tolak" action="{{ route('kepalaPDataSiswaDitolak') }}" method="POST">
                                            <a>
                                            @csrf
                                                    <input type="hidden" name="id" id="id" value="{{ $eachdata->id }}">
                                                    <input type="hidden" name="status" id="status" value="2">

                                                <button id="btn_tolak" type="button" class="btn btn-danger btn-md" data-toggle="tooltip"
                                                    data-placement="bottom" title="Hapus">
                                                    <i class="fas fa-trash"></i></button>
                                            </a>
                                        </div>
                                    </td>
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
                    <h4>Daftar Siswa Pendaftar</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tablePendaftaran" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Industri Pilihan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <!-- Isi dari tabel -->

                            <tbody>
                                @foreach($dataPendaftarDiterima as $eachdata)
                                <tr>
                                    <td>{!! $eachdata->nis !!}</td>
                                    <td>{!! $eachdata->nama !!}</td>
                                    <td>{!! $eachdata->dudipilihan !!}</td>
                                    <td>
                                        @if ($eachdata->status == 1)
                                        <div class="badges">
                                            <span class="badge badge-info">Diterima</span>
                                        </div>
                                        @else ($eachdata->status == 2)
                                        <div class="badges">
                                            <span class="badge badge-warning">Ditolak</span>
                                        </div>
                                        @endif

                                    </td>
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
  $(document).on(
        'click',
        '#btn_terima',
        function(){

            Swal.fire({
                title: 'Apakah anda yakin <b> Diterima</b> ?',
                text: "Anda tidak akan bisa merubah pilihan!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Terima!'
            }).then((result) => {

                if (result.value) {
                    $('#form_terima').submit();
                    Swal.fire(
                        'Diterima!',
                        'Siswa Diterima oleh Industri',
                        'success'
                    )
                } else {
                    Swal.fire(
                        'Batal!',
                        'Anda membatalkan Aksi',
                        'error'
                    )
                }
            })
        }
    );

    $(document).on(
        'click',
        '#btn_tolak',
        function(){

            Swal.fire({
                title: 'Apakah anda yakin <b> Ditolak</b> ?',
                text: "Anda tidak akan bisa merubah pilihan!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Ditolak!'
            }).then((result) => {

                if (result.value) {
                    $('#form_tolak').submit();
                    // window.location = "/dataSiswa/ditolak";
                    Swal.fire(
                        'Ditolak!',
                        'Siswa Ditolak oleh Industri',
                        'success'
                    )
                } else {
                    Swal.fire(
                        'Batal!',
                        'Anda membatalkan Aksi',
                        'error'
                    )
                }
            })
        }
    );

    $(document).ready(function () {
        $('#datatable').DataTable();
    });
    $(document).ready(function () {
        $('#tablePendaftaran').DataTable();
    });

</script>
@endsection