<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\ReasonController;


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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

Route::middleware('auth')->group(function() {
    Route::resource('user', UserController::class);
    Route::delete('/usuarios/{user}/desvincular/{department}', 'UserController@detachDepartment')->name('usuarios.desvincular');
    Route::get('/search-users', [UserController::class, 'searchUsers'])->name('search.users');
    Route::resource('department', DepartmentController::class);
    Route::resource('license', LicenseController::class);
    Route::get('/license/user/{id}/department', [LicenseController::class, 'getUserDepartment'])->name('license.user');
    Route::get('/get-proof/{id}', 'LicenseController@getProof');
    Route::resource('professions', ProfessionController::class);
    Route::resource('reasons', ReasonController::class);
    Route::resource('specialties', SpecialtyController::class);
    Route::get('/get-specialties', [SpecialtyController::class, 'getSpecialties'])->name('getSpecialties');

});
