@extends('layouts.master')

@section('title', 'Penilaian')

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
        <li><a class="nav-link" href="/penilaian"><i class="fas fa-book-open"></i> <span>Penilaian</span></a></li>
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
        <h1>Formulir Penilaian</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Unduh Formulir Penilaian</h4>
        </div>
        <div class="card-body">
            Silahkan mengunduh formulir penilaian dengan menekan tombol Unduh.
        </div>
        <div class="card-footer text-left">
            <button class="btn btn-icon icon-left btn-primary"><i class="fas fa-file-download"></i> Unduh </button>
        </div>
    </div>
</section>
@endsection
