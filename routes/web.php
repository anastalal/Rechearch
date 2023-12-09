<?php

use App\Http\Controllers\HomeController;
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
use App\Livewire\Registration;
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test', function () {
//     return view('test');
// });
// Route::get('/registration', Registration::class);
Route::post('/upload','App\Http\Controllers\HomeController@upload')->name('upload');
Route::get('/registration','App\Http\Controllers\HomeController@index')->name('registration');
Route::post('/application','App\Http\Controllers\HomeController@create')->name('application');