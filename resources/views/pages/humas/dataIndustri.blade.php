@extends('layouts.master')

@section('title', 'Data Industri')

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
        <h1>Daftar Industri</h1>
    </div>
    <div class="row">
        <div class="col-12 ">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Industri</h4>
                </div>
                <div class="card-body">

                    <div class="buttons">
                        <a href="/tambahIndustri">
                            <button type="button" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Tambah
                                Industri</button></a>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Logo</th>
                                    <th>Alamat</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <!-- Isi dari tabel -->

                            <tbody>
                                @foreach($data as $eachdata)
                                <tr>
                                    <td>{!! $eachdata->nama !!}</td>
                                    <td><img width="80px" height="80px" src="{{ asset($eachdata->logo) }}"></td>
                                    <td>{!! $eachdata->alamat !!}</td>
                                    <td>{!! $eachdata->deskripsi !!}</td>
                                    <td>
                                        <br>
                                        <div class="row">
                                            <a href="/detailIndustri/{{ $eachdata->id }}">
                                                <button type="submit" class="btn btn-warning btn-md"
                                                    data-toggle="tooltip" data-placement="bottom" title="Detail">
                                                    <i class="fas fa-search"></i></button>
                                            </a>
                                            <a href="/editIndustri/{{ $eachdata->id }}">
                                                <button type="submit" class="btn btn-success btn-md"
                                                    data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                    <i class="fas fa-edit"></i></button>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-md delete"
                                                data-toggle="tooltip" data-placement="bottom" title="Hapus"
                                                industri-id="{{ $eachdata->id }}">
                                                <i class="fa fa-trash"></i></button>
                                            <br>
                                        </div>
                                    </td>
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
    </div>
</section>
@endsection

@section('footer')
<script>
    $('.delete').click(function () {
        var industri_id = $(this).attr('industri-id');
        
        Swal.fire({
            title: 'Apakah anda yakin menghapus industri ?',
            text: "Anda tidak akan bisa mengembalikan data yang sudah dihapus!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {

            if (result.value) {
                window.location = "/deleteIndustri/"+ industri_id;
                Swal.fire(
                    'Terhapus!',
                    'Data industri telah dihapus.',
                    'success'
                )
            } else {
                Swal.fire(
                    'Batal!',
                    'Data industri tidak terhapus',
                    'error'
                )
            }
        })
    })
</script>

<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
    });
</script>

@endsection
