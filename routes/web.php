<?php

use Illuminate\Support\Facades\Route;
use App\Models\barang;
use App\Http\controllers\BarangController;


Route::controller(BarangController::class)->name('barang.')->group(function(){
    Route::get('/barang','index')->name('index');
    Route::get('barang/create','create')->name('create');
    Route::get('/barang/{id}','show')->name('show');
    Route::post('/barang','store')->name('store');
    Route::get('/barang/{id}/destroy','destroy')->name('destroy');
    Route::get('/barang/{id}/edit','edit')->name('edit');
    Route::post('/barang/{id}','update')->name('update');
    
});

Route::get('/', function () {
    return "Hello World";
});

Route::get('/{nama}', function (string $nama) {
    //return "Hello {$nama}";
    return view('hello', ['nama' => $nama]);
});

/*Route::get('/', function () {
    return view('welcome');
});*/