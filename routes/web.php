<?php

use App\Http\Controllers\AdminPanelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitContactForm'])->name('contact.submit');
Route::get('/contact/confirmation', [ContactController::class, 'showContactConfirmation'])->name('contact.confirmation');

Route::get('/admin-panel', [AdminPanelController::class, 'showAdminPanel'])->name('admin.panel');

Route::get('/switch-locale/{lang}', function ($lang) {
    if (in_array($lang, ['nl', 'en'])) session(['locale' => $lang]);

    return redirect()->back();
})->name('locale.switch');

Auth::routes();
/*------------------------------------------
--------------------------------------------
All guest Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:guest'])->group(function () {

    //Route::get('/home', [HomeController::class, 'index'])->name('home');
});
/*------------------------------------------
--------------------------------------------
All traveller Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:traveller'])->group(function () {

    Route::get('/traveller/home', [HomeController::class, 'travellerHome'])->name('traveller.home');
});

/*------------------------------------------
--------------------------------------------
All Guide Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:guide'])->group(function () {

    Route::get('/guide/home', [HomeController::class, 'guideHome'])->name('guide.home');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});
