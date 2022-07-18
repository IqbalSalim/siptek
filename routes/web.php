<?php


use App\Http\Livewire\Tenagakontrak\IndexTenagakontrak;
use App\Http\Livewire\Waktu\IndexWaktu;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => '/tenaga-kontrak', 'as' => 'tenaga-kontrak', 'middleware' => 'auth'], function () {
    Route::get('/', IndexTenagakontrak::class)->name('');
});
Route::group(['prefix' => '/waktu', 'as' => 'waktu', 'middleware' => 'auth'], function () {
    Route::get('/', IndexWaktu::class)->name('');
});


require __DIR__ . '/auth.php';
