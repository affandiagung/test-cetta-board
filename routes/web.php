<?php


use App\Http\Controllers\SensorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;



Route::get('/login', 'App\Http\Controllers\AuthController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');




Route::middleware(['auth.check'])->group(function () {

    Route::get('/', function () {
        if (!Session::has('api_token')) {
            return redirect('/login');
        }
        $token = Session::get('api_token');

        return redirect()->route('sensors.index');
    })->name('index');

    Route::post('/sensors/sync', [SensorController::class, 'sync'])->name('sensors.sync');
    Route::resource('sensors', controller: SensorController::class);
});
