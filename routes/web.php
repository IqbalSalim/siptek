<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CetakLaporan;
use App\Http\Livewire\Dashboard\IndexDashboard;
use App\Http\Livewire\Presensi\IndexPresensi;
use App\Http\Livewire\Rekapan\Rekap;
use App\Http\Livewire\Rekapan\RekapanKeseluruhan;
use App\Http\Livewire\Tenagakontrak\IndexTenagakontrak;
use App\Http\Livewire\Tenagakontrak\UbahPassword;
use App\Http\Livewire\Verifikasi\DinasLuar;
use App\Http\Livewire\Waktu\IndexWaktu;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [AuthenticatedSessionController::class, 'create']);



Route::get('/dashboard', IndexDashboard::class)->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => '/tenaga-kontrak', 'as' => 'tenaga-kontrak', 'middleware' => (['auth', 'can:olah tk'])], function () {
    Route::get('/', IndexTenagakontrak::class)->name('');
});
Route::group(['prefix' => '/waktu', 'as' => 'waktu', 'middleware' => (['auth', 'can:olah waktu'])], function () {
    Route::get('/', IndexWaktu::class)->name('');
});

Route::group(['prefix' => '/presensi', 'as' => 'presensi', 'middleware' => (['auth', 'can:buat presensi'])], function () {
    Route::get('/', IndexPresensi::class)->name('');
});

Route::group(['prefix' => '/rekapan', 'as' => 'rekapan', 'middleware' => (['auth', 'can:olah rekapan'])], function () {
    Route::get('/', RekapanKeseluruhan::class)->name('');
});

Route::group(['prefix' => '/verifikasi-dl', 'as' => 'verifikasi-dl', 'middleware' => (['auth', 'can:olah verifikasi'])], function () {
    Route::get('/', DinasLuar::class)->name('');
});

Route::group(['prefix' => '/ubah-password', 'as' => 'ubah-password', 'middleware' => (['auth', 'can:ubah password'])], function () {
    Route::get('/', UbahPassword::class)->name('');
});
Route::group(['prefix' => '/laporan', 'as' => 'laporan', 'middleware' => (['auth', 'can:ubah password'])], function () {
    Route::get('/', Rekap::class)->name('');
});

Route::post('generate-pdf-laporan-presensi',  [CetakLaporan::class, 'generatePDF'])->middleware(['auth', 'can:cetak laporan'])->name('cetak-laporan');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout.destroy');


require __DIR__ . '/auth.php';
