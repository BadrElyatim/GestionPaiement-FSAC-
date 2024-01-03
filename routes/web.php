<?php

use App\Models\Etudiant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\TrancheController;

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

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/professeurs', [ProfesseurController::class, 'index'])->name('dashboard.professeurs');
    Route::post('/dashboard/etudiants', [EtudiantController::class, 'store'])->name('etudiants.store');

    route::delete('/dashboard/etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->middleware(['auth'])->name('etudiants.destroy');
    route::put('/dashboard/etudiants/{etudiant}', [EtudiantController::class, 'update'])->middleware(['auth'])->name('etudiants.update');

    route::put('/dashboard/professeurs/{professeur}', [ProfesseurController::class, 'update'])->middleware(['auth'])->name('professeurs.update');
    route::delete('/dashboard/professeurs/{professeur}', [ProfesseurController::class, 'destroy'])->middleware(['auth'])->name('professeurs.destroy');
    Route::post('/dashboard/professeurs', [ProfesseurController::class, 'store'])->name('professeurs.store');

    route::put('/dashboard/filieres/{filiere}', [FiliereController::class, 'update'])->name('filieres.update');
    Route::post('/dashboard/filieres', [FiliereController::class, 'store'])->name('filieres.store');
    Route::get('/dashboard/filieres', [FiliereController::class, 'index'])->name('dashboard.filieres');
});

Route::get('/dashboard/etudiants', [EtudiantController::class, 'index'])->name('dashboard.etudiants')
    ->middleware('role:admin,regisseur');


Route::get('/filieres/{filiere}/etudiants/', [FiliereController::class, 'show'])->middleware(['auth', 'verified'])->name('filiere.etudiants');

Route::get('etudiants/{etudiant}/tranches', [TrancheController::class, 'index'])->middleware(['auth', 'role:professeur,regisseur', 'prof'])->name('etudiant.tranches');
Route::post('etudiants/{etudiant}/tranches', [TrancheController::class, 'store'])->middleware(['auth', 'role:professeur,regisseur', 'prof'])->name('tranches.store');

Route::post('/tranches/{tranche}/changestatus', [TrancheController::class, 'changeStatus'])->middleware(['auth', 'role:regisseur'])->name('tranches.changestatus');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
