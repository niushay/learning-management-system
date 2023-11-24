<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\V1\NewsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Dashboard', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/departments', [ProfileController::class, 'index'])->name('departments');
    Route::get('/courses', [ProfileController::class, 'index'])->name('courses');
    Route::get('/results', [ProfileController::class, 'index'])->name('results');

    Route::name('users.')->group(function () {
        Route::get('/lecturers', [ProfileController::class, 'index'])->name('lecturer');
        Route::get('/students', [ProfileController::class, 'index'])->name('student');
    });
});

require __DIR__.'/auth.php';
