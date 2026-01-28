<?php

use Illuminate\Support\Facades\Route;
//frontend
use App\Http\Controllers\Frontend\BerandaViewController;
use App\Http\Controllers\Frontend\ProfilViewController;
use App\Http\Controllers\Frontend\WartaViewController;
use App\Http\Controllers\Frontend\RenunganViewController;
use App\Http\Controllers\Frontend\GaleriViewController;
use App\Http\Controllers\Frontend\KontakViewController;
//backend
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\Beranda\BerandaController;
use App\Http\Controllers\Backend\Profil\ProfilController;
use App\Http\Controllers\Backend\Warta\WartaController;
use App\Http\Controllers\Backend\Renungan\RenunganController;
use App\Http\Controllers\Backend\Renungan\RenunganKategoriController;
use App\Http\Controllers\Backend\Galeri\GaleriController;
use App\Http\Controllers\Backend\Identitas\IdentitasController;
use App\Http\Controllers\Backend\Banner\BannerController;
use App\Http\Controllers\Backend\Akun\AkunController;
use App\Http\Controllers\Backend\Jemaat\JemaatController;
use App\Http\Controllers\Backend\Kas\KasController;


//publik beranda
Route::get('/', [BerandaViewController::class, 'index'])->name('beranda');

//publik profil
Route::get('/profil/sejarah', [ProfilViewController::class,'sejarahView'])->name('profil.sejarah');
Route::get('/profil/visi-misi', [ProfilViewController::class,'visiMisiView'])->name('profil.visi-misi');
Route::get('/profil/pengurus', [ProfilViewController::class,'pengurusView'])->name('profil.pengurus');

Route::get('/warta', [WartaViewController::class,'warta'])->name('warta');
Route::get('/warta/detail/{slug}', [WartaViewController::class,'detail'])->name('warta.detail');

Route::get('/renungan', [RenunganViewController::class,'renungan'])->name('renungan');
Route::get('/renungan/detail/{slug}', [RenunganViewController::class,'detail'])->name('renungan.detail');

Route::get('/galeri', [GaleriViewController::class, 'galeri'])->name('galeri');

Route::get('/kontak', [kontakViewController::class, 'kontak'])->name('kontak');

Route::middleware(['check.login.lock', 'guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('backend.auth');
});

Route::get('/logout',[LoginController::class, 'logout'])->name('logout')->middleware('auth');


//internal akses---------------------------------------------------------------------------------------------
Route::get('/backend/beranda',[BerandaController::class, 'index'])->name('backend.beranda')->middleware('auth');


Route::prefix('backend/sejarah')->middleware('auth')->controller(ProfilController::class)->group(function () {
        Route::get('/', 'sejarahIndex')->name('backend.sejarah');
        Route::get('/create','sejarahCreate')->name('backend.sejarah.create');
        Route::post('/','sejarahStore')->name('backend.sejarah.store');
        Route::match(['get', 'post'],'/backend/sejarah/{id}/edit','sejarahEdit')->name('backend.sejarah.edit');
        Route::put('/{id}','sejarahUpdate')->name('backend.sejarah.update');
});

Route::prefix('backend/visi-misi')->middleware('auth')->controller(ProfilController::class)->group(function () {
        Route::get('/', 'visiMisiIndex')->name('backend.visi-misi');
        Route::get('/create', 'visiMisiCreate')->name('backend.visi-misi.create');
        Route::post('/', 'visiMisiStore')->name('backend.visi-misi.store')->middleware('auth');
        Route::match(['get', 'post'],'/{id}/edit', 'visiMisiEdit')->name('backend.visi-misi.edit');
        Route::put('/{id}','visiMisiUpdate')->name('backend.visi-misi.update');
});


Route::prefix('backend/pengurus')->middleware('auth')->controller(ProfilController::class)->group(function () {
        Route::get('/', 'pengurusIndex')->name('backend.pengurus');
        Route::get('/create', 'pengurusCreate')->name('backend.pengurus.create');
        Route::post('/', 'pengurusStore')->name('backend.pengurus.store');
        Route::match(['get', 'post'],'/{id}/edit','pengurusEdit')->name('backend.pengurus.edit');
        Route::put('/{id}',  'pengurusUpdate')->name('backend.pengurus.update');
        Route::delete('/{id}/delete', 'pengurusDelete')->name('backend.pengurus.delete');
});

Route::prefix('backend/warta')->middleware('auth')->controller(WartaController::class)->group(function () {
        Route::get('/','index')->name('backend.warta');
        Route::get('/create', 'create')->name('backend.warta.create');
        Route::post('/', 'store')->name('backend.warta.store');
        Route::put('/status/{id}/{status}', 'updateStatus')->name('backend.warta.edit-status');
        Route::put('/{id}', 'update')->name('backend.warta.update');
        Route::delete('/{id}/delete', 'destroy')->name('backend.warta.delete');
        Route::match(['get', 'post'],'/{id}/edit','edit')->name('backend.warta.edit');
});

Route::prefix('backend/renungan')->middleware('auth')->controller(RenunganController::class)->group(function () {
        Route::get('/', 'index')->name('backend.renungan');
        Route::get('/create', 'create')->name('backend.renungan.create');
        Route::post('/', 'store')->name('backend.renungan.store');
        Route::match(['get', 'post'],'/{id}/edit', 'edit')->name('backend.renungan.edit');
        Route::put('/status/{id}/{status}', 'updateStatus')->name('backend.renungan.edit-status');
        Route::put('/{id}', 'update')->name('backend.renungan.update');
        Route::delete('/{id}/delete', 'destroy')->name('backend.renungan.delete');
});

Route::prefix('backend/renungan/kategori')->middleware('auth')->controller(RenunganKategoriController::class)->group(function () {
        Route::get('/', 'index')->name('backend.kategori.renungan');
        Route::get('/create', 'create')->name('backend.kategori.renungan.create');
        Route::post('/', 'store')->name('backend.kategori.renungan.store');
        Route::match(['get', 'post'],'/{id}/edit', 'edit')->name('backend.kategori.renungan.edit');
        Route::put('/{id}', 'update')->name('backend.kategori.renungan.update');
        Route::delete('/{id}/delete', 'destroy')->name('backend.kategori.renungan.delete');
});


Route::prefix('backend/galeri')->middleware('auth')->controller(GaleriController::class)->group(function () {
        Route::get('/', 'index')->name('backend.galeri');
        Route::get('/create', 'create')->name('backend.galeri.create');
        Route::post('/',  'store')->name('backend.galeri.store');
        Route::match(['get', 'post'],'/{id}/edit', 'edit')->name('backend.galeri.edit');
        Route::put('/{id}', 'update')->name('backend.galeri.update');
        Route::delete('/{id}/delete',  'destroy')->name('backend.galeri.delete');
});

Route::prefix('backend/identitas')->middleware('auth')->controller(IdentitasController::class)->group(function () {
        Route::get('/',  'edit')->name('backend.identitas.edit');
        Route::post('/', 'update')->name('backend.identitas.update');
});

Route::prefix('backend/banner')->middleware('auth')->controller(BannerController::class)->group(function () {
        Route::get('/',  'edit')->name('backend.banner.edit');
        Route::post('/', 'update')->name('backend.banner.update');
});


Route::prefix('backend/akun')->middleware('auth')->controller(AkunController::class)->group(function () {
        Route::get('/','show')->name('backend.akun');
        Route::get('/create', 'create')->name('backend.akun.create');
        Route::post('/', 'store')->name('backend.akun.store');
        Route::put('/{id}', 'update')->name('backend.akun.update');
        Route::delete('/{id}/delete', 'destroy')->name('backend.akun.delete');
        Route::match(['get', 'post'],'/{id}/edit','edit')->name('backend.akun.edit');

});

Route::prefix('backend/jemaat')->middleware('auth')->controller(JemaatController::class)->group(function () {
        Route::get('/','showJemaat')->name('backend.jemaat');
        Route::get('/create','createJemaat')->name('backend.jemaat.create');
        Route::get('/detail/{id}','detailJemaat')->name('backend.jemaat.detail');
        Route::post('/', 'storeJemaat')->name('backend.jemaat.store');
        Route::put('/{id}', 'updateJemaat')->name('backend.jemaat.update');
        Route::delete('/{id}/delete', 'destroy')->name('backend.jemaat.delete');
        Route::match(['get', 'post'],'/{id}/edit','editJemaat')->name('backend.jemaat.edit');
});

Route::prefix('backend/keluarga')->middleware('auth')->controller(JemaatController::class)->group(function () {
        Route::get('/','showKeluarga')->name('backend.keluarga');
        Route::get('/create','createKeluarga')->name('backend.keluarga.create');
        Route::get('/detail/{id}','detailKeluarga')->name('backend.keluarga.detail');
        Route::post('/export', 'exportKeluarga')->name('backend.keluarga.export-pdf');
        Route::post('/', 'storeKeluarga')->name('backend.keluarga.store');
        Route::put('/{id}', 'updateKeluarga')->name('backend.keluarga.update');
        Route::delete('/{id}/delete', 'destroyKeluarga')->name('backend.keluarga.delete');
        Route::match(['get', 'post'],'/{id}/edit','editKeluarga')->name('backend.keluarga.edit');
});

Route::prefix('backend/kas')->middleware('auth')->controller(KasController::class)->group(function () {
        Route::get('/', 'index')->name('kas.index');
        Route::post('/tambah-tahun',  'tambahTahun')->name('kas.tambahTahun');
        Route::post('/export/{bulan}', 'exportKas')->name('backend.kas.export-pdf');
        Route::put('/status/{bulan}/{status}',  'updateStatusKas')->name('kas.status.update');
        Route::get('/{tahun}', 'showBulan')->name('kas.showBulan');
        Route::post('/{tahun}/tambah-bulan',  'tambahBulan')->name('kas.tambahBulan');
        Route::delete('/{bulan_id}/delete', 'destroyBulan')->name('backend.kasBulan.delete');
        Route::get('/{tahun}/{bulan}', 'showTransaksi')->name('kas.showTransaksi');
        Route::post('/{tahun}/{bulan}/transaksi',  'storeTransaksi')->name('kas.storeTransaksi');
        Route::delete('/{id}/delete', 'destroyTransaksi')->name('backend.kas.delete');

});
