<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\PageController as AdminPageController;

use App\Http\Controllers\Guest\PageController as GuestPageController;


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

Route::get('/', [GuestPageController::class, 'index'])->name('guest.home');


Route::middleware(['auth', 'verified'])
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {

    Route::get('/', [AdminPageController::class, 'index'])->name('home');

    Route::get('/projects/trash/index', [ProjectController::class, 'trash'])->name('projects.trash.index');
    Route::patch('/projects/trash/{project}', [ProjectController::class, 'restore'])->name('projects.trash.restore');
    Route::delete('/projects/trash/{project}', [ProjectController::class, 'forceDestroy'])->name('projects.trash.forceDestroy');
    Route::resource('projects', ProjectController::class);

    Route::resource('technologies', TechnologyController::class);

    Route::resource('types', TypeController::class);

  });

require __DIR__ . '/auth.php';