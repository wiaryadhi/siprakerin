<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('index');
Route::get('post/{id}','HomeController@post')->name('post');

Auth::routes();

// middleware group
Route::group(['middleware' => ['auth']], function()
{
    // middleware seluruh dashboard
    Route::get('dashboard', 'DashboardController@index')
        ->name('dashboard');

    // group middleware humas
    Route::group(['middleware' => ['Role-Humas']], function()
    {
        Route::get('dataSiswa', 'C_Humas@dataSiswa')->name('dataSiswa');
        Route::post('dataSiswa/diterima', 'C_Humas@diterima')->name('humasDataSiswaDiterima');
        Route::post('dataSiswa/ditolak', 'C_Humas@ditolak')->name('humasDataSiswaDitolak');
        Route::get('editDataPendaftaran/{id}','C_Humas@showEditDataPendaftaran')->name('showEditDataPendaftaran');//ini viewnya
        Route::post('editDataPendaftaran/{id}','C_Humas@updateDataPendaftaran')->name('editDataPendaftaran');//ini untuk form

        Route::get('dataIndustri', 'C_Humas@dataIndustri')->name('dataIndustri');      
        Route::get('detailIndustri/{id}', 'C_Humas@showDetailIndustri')->name('showDetailIndustri');   
        Route::get('tambahIndustri','C_Humas@showTambahIndustri')->name('showTambahIndustri');
        Route::post('tambahIndustri','C_Humas@tambahIndustri')->name('tambahIndustri');
        Route::get('deleteIndustri/{id}','C_Humas@deleteIndustri')->name('deleteIndustri');
        Route::get('editIndustri/{id}','C_Humas@showEditIndustri')->name('showEditIndustri');//ini viewnya
        Route::post('editIndustri/{id}','C_Humas@updateIndustri')->name('editIndustri');//ini untuk form
        Route::get('dataIndustri/{id}','C_Humas@hapusIndustri')->name('hapusIndustri');

        Route::get('berita', 'C_Humas@berita')->name('berita');
        Route::get('tambahBerita','C_Humas@showTambahBerita')->name('showTambahBerita');
        Route::post('tambahBerita','C_Humas@tambahBerita')->name('tambahBerita');
        Route::get('editBerita/{id}','C_Humas@showEditBerita')->name('showEditBerita');//ini viewnya
        Route::post('editBerita/{id}','C_Humas@updateBerita')->name('editBerita');//ini untuk form
        Route::get('berita/{id}','C_Humas@hapusBerita')->name('hapusBerita');

        Route::get('akun', 'C_Humas@akun')->name('akun');
        Route::post('akun/akunDiterima', 'C_Humas@akunDiterima')->name('akunDiterima');
        Route::get('akun/{id}','C_Humas@hapusAkun')->name('hapusAkun');
        Route::get('editAkun/{id}','C_Humas@showEditAkun')->name('showEditAkun');//ini viewnya
        Route::post('editAkun/{id}','C_Humas@updateAkun')->name('updateAkun');//ini untuk form
    });


    // group middleware guruP
    Route::group(['middleware' => ['Role-GuruP']], function()
    {
        Route::get('monitoring', 'C_GuruP@monitoring')->name('monitoring');
        Route::get('unduhLaporan','C_guruP@showUnduhLaporan')->name('showUnduhLaporan');
        Route::post('unduhLaporan','C_guruP@unduhLaporan')->name('unduhLaporan');
    });

    //group middleware KepalaP
    Route::group(['middleware' => ['Role-KepalaP']], function()
    {
        Route::get('dataIndustriProdi', 'C_KepalaProdi@dataIndustriProdi')->name('dataIndustriProdi');
        Route::get('detailIndustriProdi/{id}', 'C_KepalaProdi@showDetailIndustri')->name('showDetailIndustri'); 
        Route::get('tambahIndustriProdi','C_KepalaProdi@showTambahIndustriProdi')->name('showTambahIndustriProdi');
        Route::post('tambahIndustriProdi','C_KepalaProdi@tambahIndustriProdi')->name('tambahIndustriProdi');
        Route::get('editIndustriProdi/{id}','C_KepalaProdi@showEditIndustriProdi')->name('showEditIndustriProdi');//ini viewnya
        Route::post('editIndustriProdi/{id}','C_KepalaProdi@updateIndustriProdi')->name('editIndustriProdi');//ini untuk form
        Route::get('dataIndustriProdi/{id}','C_KepalaProdi@hapusIndustriProdi')->name('hapusIndustriProdi');

        Route::get('dataSiswaProdi', 'C_KepalaProdi@dataSiswaProdi')->name('dataSiswaProdi');
        Route::post('dataSiswaProdi/diterima', 'C_Humas@diterima')->name('kepalaPDataSiswaDiterima');
        Route::post('dataSiswaProdi/ditolak', 'C_Humas@ditolak')->name('kepalaPDataSiswaDitolak');
        Route::get('editDataPendaftaranProdi/{id}','C_KepalaProdi@showEditDataPendaftaran')->name('showEditDataPendaftaranProdi');//ini viewnya
        Route::post('editDataPendaftaranProdi/{id}','C_KepalaProdi@updateDataPendaftaranProdi ')->name('editDataPendaftaranProdi');//ini untuk form
    });

    //group middleware Siswa
    Route::group(['middleware' => ['Role-Siswa']], function()
    {
        Route::get('penilaian', 'C_Siswa@penilaian')->name('penilaian');
        Route::get('pendaftaran', 'C_Siswa@pendaftaran')->name('pendaftaran');
        Route::get('detailPendaftaran/{id}', 'C_Siswa@showdetailPendaftaran')->name('showdetailPendaftaran');
        Route::post('detailPendaftaran', 'C_Siswa@tambahPendaftaran')->name('detailPendaftaran');
        Route::get('profil', 'C_Siswa@profilSiswa')->name('profil');
    });
});
