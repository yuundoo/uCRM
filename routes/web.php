<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\InertiaController;
use App\Http\Controllers\ItemController;

Route::resource('items', ItemController::class)->middleware(['auth', 'verified']);

Route::get(
    '/inertia-test',
    function () {
        return Inertia::render('InertiaTest');
    }
);

Route::get('/inertia/index', [InertiaController::class, 'index'])->name('inertia.index');
Route::get('/inertia/create', [InertiaController::class, 'create'])->name('inertia.create');
Route::get('/inertia/show/{id}', [InertiaController::class, 'show'])->name('inertia.show');
Route::post('/inertia', [InertiaController::class, 'store'])->name('inertia.store');
Route::delete('/inertia/{id}', [InertiaController::class, 'delete'])->name('inertia.delete');
Route::get('/component-test', function () {
    return Inertia::render('ComponentTest');
});


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
