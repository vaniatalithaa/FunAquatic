<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\RegistrantController as AdminRegistrantController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/hasil-lomba', [PageController::class, 'results'])->name('results');

Route::get('/pendaftaran', [RegistrationController::class, 'rules'])->name('registrations.rules');
Route::get('/formulir', [RegistrationController::class, 'create'])->name('registrations.create');
Route::post('/formulir', [RegistrationController::class, 'store'])->name('registrations.store');
Route::get('/peserta', [RegistrationController::class, 'index'])->name('registrations.index');
Route::get('/peserta/data', [RegistrationController::class, 'data'])->name('registrations.data');

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::redirect('/login', '/admin/login')->name('login');
Route::get('/admin/peserta/live-data', [AdminRegistrantController::class, 'liveData'])->middleware('signed')->name('admin.registrants.live-data');

Route::middleware('auth')->group(function () {
    Route::get('/admin/peserta/export', [AdminRegistrantController::class, 'export'])->name('admin.registrants.export');
    Route::get('/admin/peserta/live-query', [AdminRegistrantController::class, 'liveQuery'])->name('admin.registrants.live-query');
});
