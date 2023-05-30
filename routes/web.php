<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/payment_notification', [PaymentController::class, 'paymentCallback']);

Route::get('/', function () {
    return view('pages.home');
});

Route::group(['middleware' => 'guest'], function () {
    Route::view('login', 'pages.auth.login');
    Route::view('register', 'pages.auth.register');

    Route::view('lupa-password', 'pages.auth.forgot-password');
    Route::view('reset-password', 'pages.auth.reset-password');
});

Route::view('program', 'pages.program.index');
// Route::view('program/{id}', 'pages.program.show');
Route::get('program/{id}', [ProgramController::class, 'show']);

Route::view('fasilitas', 'pages.fasilitas.index');

Route::view('kelas-online', 'pages.kelas-online.index');
// Route::view('kelas-online/{id}', 'pages.kelas-online.show');
Route::get('kelas-online/{id}', [KelasOnlineController::class, 'show']);

// Route::view('kelas-online', 'pages.coming-soon');
// Route::view('kelas-online/{id}', 'pages.coming-soon');

Route::view('ruang-edukasi', 'pages.ruang-edukasi.index');
// Route::view('ruang-edukasi/{id}', 'pages.ruang-edukasi.show');
Route::get('ruang-edukasi/{id}', [RuangEdukasiController::class, 'show']);

Route::view('pengajar', 'pages.pengajar.index');
Route::view('pengajar/{id}', 'pages.pengajar.show');

Route::view('tentang-kami', 'pages.content.about-us');
Route::view('kebijakan-privasi', 'pages.content.privacy-policy');
Route::view('faq', 'pages.content.faq');
Route::view('alamat', 'pages.content.alamat');

Route::view('karir', 'pages.karir.index');
// Route::view('karir/{id}', 'pages.karir.show');
Route::get('karir/{id}', [KarirController::class, 'show']);

// Route::view('roadmap', 'pages.coming-soon');
// Route::view('roadmap/{id}', 'pages.coming-soon');

Route::view('roadmap', 'pages.roadmap.index');
Route::get('roadmap/{id}', [RoadmapController::class, 'show']);

Route::get('kelas-online/{id}/paket/{paketId}', [KelasOnlineController::class, 'paket']);
// Route::view('kelas-online/{id}/paket/{paketId}', 'pages.kelas-online.paket.data-diri');
Route::get('kelas-online/trx/{id}/pembayaran', [KelasOnlineController::class, 'pembayaran']);
Route::get('kelas-online/{id}/akses', [KelasOnlineController::class, 'aksesCode']);

Route::view('kode-akses/{code}', 'pages.access-code');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect("/login")->with('success', 'Berhasil Logout');
    });

    // Route::view('progres', [ProfileController::class, 'index']);
    Route::get('profil', [ProfileController::class, 'index']);
});

Route::get('akses/{id}', [KelasOnlineController::class, 'akses']);
