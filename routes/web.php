<?php

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

Route::get('/', function () {
    return view('welcome');
});



use Illuminate\Support\Facades\Artisan;

Route::get('/migrate', function () {
    try {
        Artisan::call('migrate --force');
        return 'Migrations ran successfully!';
    } catch (\Exception $e) {
        return 'Migration failed: ' . $e->getMessage();
    }
});