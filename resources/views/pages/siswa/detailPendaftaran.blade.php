@extends('layouts.master')

@section('title', 'Detail Pendaftaran')

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
        <li><a class="nav-link" href="/pendaftaran"><i class="fas fa-user-plus"></i> <span>Pendaftaran</span></a></li>
         </ul>
    </div>
</aside>
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
        <h1>Detail Pendaftaran</h1>
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
                        <input type="checkbox" name="jurusan[]" value="{{ $eachdata->id }}" class="flat"
                            disabled="disabled" @php for($i=0; $i < count($jurusans); $i++){
                            if($jurusans[$i]==$eachdata->id){
                        echo "checked";
                        break;
                        }
                        }
                        @endphp
                        > {!! $eachdata->nama !!}
                    </label>
                </div>
                @endforeach
            </p>
            <form class="form-horizontal form-label-left" id="form_pendaftaran" action="{{ route('detailPendaftaran') }}" method="POST">
                @csrf

                <input type="hidden" class="form-control" name="nis" id="nis" value="{{ Auth::user()->username }}">
                <input type="hidden" class="form-control" name="dudipilihan" id="dudipilihan"
                    value="{{ $industri->id }}">
                <input type="hidden" class="form-control" name="status" id="status" value="0">
                <div class="form-group">
                    <div class="col-sm-12 col-md-7">
                        <button type="submit" class="btn btn-icon icon-left btn-warning"><i
                                class="fas fa-user-check"></i>Daftar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('footer')
<script>
     $(function(){
        $('.terima').click(function (e) {
            e.preventDefault();
            var terima_id = $(this).attr('terima-id');
            
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
                        $('#form_terima input[name="id"]').val(terima_id);
                        $('#form_terima').submit();
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
    
</script>
@endsection

