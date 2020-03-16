@extends('layouts.master')

@section('title', 'Akun')

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
        <h1>Data Akun</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Akun Belum Tervalidasi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                    <th>Jabatan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <!-- Isi dari tabel -->

                            <tbody>
                                @foreach($data as $eachdata)
                                <tr>
                                    <td>{!! $eachdata->username !!}</td>
                                    <td>{!! $eachdata->nama !!}</td>
                                    <td>
                                      @if($eachdata->jurusan == 1)
                                        Rekayasa Perangkat Lunak
                                      @elseif($eachdata->jurusan == 2)
                                        Teknik Kendaraan Ringan
                                      @elseif($eachdata->jurusan == 3)
                                        Teknik Sepeda Motor
                                      @endif
                                    </td>
                                    <td>
                                      @if($eachdata->privilege == 3)
                                        Kepala Prodi
                                      @elseif($eachdata->privilege == 2)
                                        Guru Pembimbing
                                      @elseif($eachdata->privilege == 4)
                                        Siswa
                                      @endif
                                    </td>
                                    <td>
                                        <div class="badges">
                                            <span class="badge badge-info">Belum Tervalidasi</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <form id="form_terima" action="{{ route('akunDiterima') }}" method="POST">
                                                <a>
                                                    @csrf
                                                    <input type="hidden" name="id" id="id" value="{{ $eachdata->id }}">
                                                    <input type="hidden" name="isValidate" id="isValidate" value="1">
                                                    <input type="hidden" name="username" id="isValidate" value="{{ $eachdata->username }}">
                                                    <input type="hidden" name="nama" id="isValidate" value="{{ $eachdata->nama }}">
                                                    <input type="hidden" name="jurusan" id="isValidate" value="{{ $eachdata->jurusan }}">
                                                    <input type="hidden" name="privilege" id="isValidate" value="{{ $eachdata->privilege }}">
                                                    
                                                    <button id="btn_terima" type="button"
                                                    class=" btn btn-success btn-md terima"
                                                    data-toggle="tooltip" data-placement="bottom" title="Diterima">
                                                        <i class="fas fa-check"></i></button>
                                                </a>
                                            </form>
                                            
                                            <a href="#">
                                                <button type="submit" class="btn btn-danger btn-md delete"
                                                    data-toggle="tooltip" data-placement="bottom" title="Hapus"
                                                    akun-id="{{ $eachdata->id }}">
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
                    <h4>Daftar Akun Tervalidasi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableValidasi" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                    <th>Jabatan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <!-- Isi dari tabel -->

                            <tbody>
                                @foreach($dataTervalidasi as $eachdata)
                                <tr>
                                    <td>{!! $eachdata->username !!}</td>
                                    <td>{!! $eachdata->nama !!}</td>
                                    <td>
                                      @if($eachdata->jurusan == 1)
                                        Rekayasa Perangkat Lunak
                                      @elseif($eachdata->jurusan == 2)
                                        Teknik Kendaraan Ringan
                                      @elseif($eachdata->jurusan == 3)
                                        Teknik Sepeda Motor
                                      @endif
                                    </td>
                                    <td>
                                      @if($eachdata->privilege == 3)
                                        Kepala Prodi
                                      @elseif($eachdata->privilege == 2)
                                        Guru Pembimbing
                                      @elseif($eachdata->privilege == 4)
                                        Siswa
                                      @endif
                                    </td>
                                    <td>
                                        <div class="badges">
                                            <span class="badge badge-info">Tervalidasi</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <a href="/editAkun/{{ $eachdata->id }}">
                                                <button type="submit" class="btn btn-info btn-md "
                                                    data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                    <i class="fas fa-edit"></i></button>
                                            </a>
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
            $('#datatable').DataTable();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#tableValidasi').DataTable();
        });
    </script>

    <script>
    $(function(){
        $('.terima').click(function (e) {
            console.log($(this));
            e.preventDefault();
            
            Swal.fire({
                title: 'Apakah anda yakin validasi Akun ini ?',
                text: "Anda tidak akan bisa mengembalikan data yang sudah dirubah!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, validasi!'
            }).then((result) => {
                
                if (result.value) {
                    
                    Swal.fire(
                        'Sukses!',
                        'Akun berhasil divalidasi.',
                        'success'
                    ).then(function() {
                        $(this).parent().parent('form').submit();
                    }) 
                } else {
                    Swal.fire(
                        'Batal!',
                        'Anda telah membatalkan aksi',
                        'error'
                    )
                }
            })
        })

        $('.delete').click(function () {
            var akun_id = $(this).attr('akun-id');
            
            Swal.fire({
                title: 'Apakah anda yakin menghapus Akun ini ?',
                text: "Anda tidak akan bisa mengembalikan data yang sudah dirubah!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                
                if (result.value) {
                    window.location = "/akun/"+ akun_id;
                    Swal.fire(
                        'Deleted!',
                        'Akun berhasil dihapus.',
                        'success'
                    )
                } else {
                    Swal.fire(
                        'Batal!',
                        'Anda telah membatalkan aksi',
                        'error'
                    )
                }
            })
        })
    });
    

   
    </script>
@endsection