<?php

use App\Models\Etudiant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfesseurController;

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

Route::get('/dashboard/etudiants', [EtudiantController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.etudiants');
Route::get('/dashboard/professeurs', [ProfesseurController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.professeurs');
Route::post('/dashboard/etudiants', [EtudiantController::class, 'store'])->middleware(['auth', 'verified'])->name('etudiants.store');

route::delete('/dashboard/etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->middleware(['auth'])->name('etudiants.destroy');
route::put('/dashboard/etudiants/{etudiant}', [EtudiantController::class, 'update'])->middleware(['auth'])->name('etudiants.update');

route::put('/dashboard/professeurs/{professeur}', [ProfesseurController::class, 'update'])->middleware(['auth'])->name('professeurs.update');
route::delete('/dashboard/professeurs/{professeur}', [ProfesseurController::class, 'destroy'])->middleware(['auth'])->name('professeurs.destroy');
Route::post('/dashboard/professeurs', [ProfesseurController::class, 'store'])->middleware(['auth', 'verified'])->name('professeurs.store');

route::put('/dashboard/filieres/{filiere}', [FiliereController::class, 'update'])->middleware(['auth'])->name('filieres.update');
Route::post('/dashboard/filieres', [FiliereController::class, 'store'])->middleware(['auth', 'verified'])->name('filieres.store');
Route::get('/dashboard/filieres', [FiliereController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.filieres');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
