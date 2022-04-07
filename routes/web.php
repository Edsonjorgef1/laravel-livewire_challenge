<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Pacientes;
use App\Http\Livewire\Consultas;

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
    return redirect()->route('login');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('pacientes', Pacientes::class)->name('pacientes');
    Route::get('consultas', Consultas::class)->name('consultas');

});


