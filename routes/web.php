<?php

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

Route::get('/', 'App\Http\Controllers\AuthController@index')->name("login");
Route::post("/sign_in", "App\Http\Controllers\AuthController@sign_in");
Route::get("/sign_out", "App\Http\Controllers\AuthController@sign_out");
Route::middleware(['auth', 'cekrole:Admin'])->group(function () {

    // todo dashboard
    Route::get("/dashboard", "App\Http\Controllers\Dashboard@index");
    Route::get('chart_penjualan','App\Http\Controllers\Dashboard@chart_penjualan');
    // todo merk
    Route::get("/master/merk", "App\Http\Controllers\MasterController@merk");
    Route::post("/master/check_merk", "App\Http\Controllers\MasterController@check_merk");
    Route::post("/master/save_merk", "App\Http\Controllers\MasterController@save_merk");
    Route::get("/master/delete_merk/{id}", "App\Http\Controllers\MasterController@delete_merk");
    Route::post("/master/update_merk", "App\Http\Controllers\MasterController@update_merk");
    // todo barang
    Route::get("/master/barang", "App\Http\Controllers\MasterController@barang");
    Route::post("/master/save_barang", "App\Http\Controllers\MasterController@save_barang");
    Route::get("/master/delete_barang/{id}", "App\Http\Controllers\MasterController@delete_barang");
    Route::get("/master/barang/edit/{id}", "App\Http\Controllers\MasterController@edit_barang");
    Route::post("/master/update_barang", "App\Http\Controllers\MasterController@update_barang");
    // todo pengguna
    Route::get("/master/pengguna", "App\Http\Controllers\MasterController@pengguna");
    Route::post("/master/save_pengguna", "App\Http\Controllers\MasterController@save_pengguna");
    Route::get("/master/delete_pengguna/{id}", "App\Http\Controllers\MasterController@delete_pengguna");
    Route::get("/master/pengguna/edit/{id}", "App\Http\Controllers\MasterController@edit_pengguna");
    Route::post("/master/update_pengguna", "App\Http\Controllers\MasterController@update_pengguna");
    Route::post("/master/data_session", "App\Http\Controllers\MasterController@data_session");
    // todo setting
    Route::get("/setting/aplikasi", "App\Http\Controllers\SettingController@aplikasi");
    Route::post("/setting/update_aplikasi", "App\Http\Controllers\SettingController@update_aplikasi");
    Route::get("/setting/profile_user/{id}", "App\Http\Controllers\SettingController@profile_user");
    Route::post("/setting/update_profile_user", "App\Http\Controllers\SettingController@update_profile_user");
    Route::post("/setting/update_password", "App\Http\Controllers\SettingController@update_password");
    Route::get("/setting/delete_foto_profile/{id}", "App\Http\Controllers\SettingController@delete_foto_profile");

});
// todo penjualan
Route::get("/penjualan/pos", "App\Http\Controllers\PenjualanController@pos");
Route::post("/penjualan/save_temp", "App\Http\Controllers\PenjualanController@save_temp");
Route::get("/penjualan/delete_temp/{id}", "App\Http\Controllers\PenjualanController@delete_temp");
Route::post("/penjualan/update_temp", "App\Http\Controllers\PenjualanController@update_temp");
Route::post("/penjualan/show_temp", "App\Http\Controllers\PenjualanController@show_temp");
Route::post("/penjualan/save_transaksi", "App\Http\Controllers\PenjualanController@save_transaksi");
Route::get("/penjualan/laporan", "App\Http\Controllers\PenjualanController@laporan");
Route::get("/penjualan/laporan/print_ulang/{id}", "App\Http\Controllers\PenjualanController@struk_ulang");
Route::get("/penjualan/laporan/print/{id}", "App\Http\Controllers\PenjualanController@struk");
Route::post("/penjualan/laporan/search", "App\Http\Controllers\PenjualanController@search_laporan");
// Route::post("/penjualan/laporan/search/detail_lap", "App\Http\Controllers\PenjualanController@detail_lap");
Route::post("/penjualan/laporan/detail_lap", "App\Http\Controllers\PenjualanController@detail_lap");
Route::post("/penjualan/detail_lap", "App\Http\Controllers\PenjualanController@detail_lap");

