@extends('layouts.master')

@section('title', 'Berita')

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
        <h1>Berita</h1>
    </div>
    <div class="row">
        <div class="col-12 ">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Berita pada <i>landing page</i></h4>
                </div>
                <div class="card-body">
                    <div class="buttons">
                        <a href="/tambahBerita">
                            <button type="button" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Tambah
                                Berita</button></a>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="tableBerita" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th >Tanggal Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $eachdata)
                                <tr>
                                    <td>{!! $eachdata->judul !!}</td>
                                    <td>{!! $eachdata->updated_at !!}</td>
                                    <td>
                                        <br>
                                        <div class="row">
                                            <a href="/editBerita/{{ $eachdata->id }}">
                                                <button type="submit" class="btn btn-success btn-md"
                                                    data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                    <i class="fas fa-edit"></i></button>
                                            </a>
                                            <a href="#">
                                                <button type="submit" class="btn btn-danger btn-md delete"
                                                    data-toggle="tooltip" data-placement="bottom" title="Hapus"
                                                    berita-id="{{ $eachdata->id }}">
                                                    <i class="fa fa-trash"></i></button>
                                            </a>
                                            <br>
                                        </div>
                                        <br>
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
        $(document).ready(function () {
            $('#tableBerita').DataTable();
        });
    </script>

<script>
    $('.delete').click(function () {
        var berita_id = $(this).attr('berita-id');
        
        
        Swal.fire({
            title: 'Apakah anda yakin menghapus Berita ?',
            text: "Anda tidak akan bisa mengembalikan data yang sudah dirubah!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            
            if (result.value) {
                window.location = "/berita/"+ berita_id;
                Swal.fire(
                    'Berita telah dihapus!',
                    'Your file has been deleted.',
                    'success'
                )
            } else {
                Swal.fire(
                    'Cancelled!',
                    'Your file is safe',
                    'error'
                )
            }
        })
    })
</script>
@endsection
