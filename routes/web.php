<?php

use App\Models\Etudiant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrancheController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\RemarqueController;
use App\Http\Controllers\RegisseurController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ResponsableController;
use App\Models\Filiere;

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
    return redirect('/login');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/dashboard/etudiants', [EtudiantController::class, 'store'])->name('etudiants.store');

    route::delete('/dashboard/etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');
    route::put('/dashboard/etudiants/{etudiant}', [EtudiantController::class, 'update'])->name('etudiants.update');


    Route::get('/dashboard/professeurs', [ProfesseurController::class, 'index'])->name('dashboard.professeurs');
    route::put('/dashboard/professeurs/{professeur}', [ProfesseurController::class, 'update'])->name('professeurs.update');
    route::delete('/dashboard/professeurs/{professeur}', [ProfesseurController::class, 'destroy'])->name('professeurs.destroy');
    Route::post('/dashboard/professeurs', [ProfesseurController::class, 'store'])->name('professeurs.store');

    Route::get('/dashboard/responsables', [ResponsableController::class, 'index'])->name('dashboard.responsables');
    route::put('/dashboard/responsables/{responsable}', [ResponsableController::class, 'update'])->name('responsables.update');
    route::delete('/dashboard/responsables/{responsable}', [ResponsableController::class, 'destroy'])->name('responsables.destroy');
    Route::post('/dashboard/responsables', [ResponsableController::class, 'store'])->name('responsables.store');

    Route::get('/dashboard/regisseurs', [RegisseurController::class, 'index'])->name('dashboard.regisseurs');
    route::put('/dashboard/regisseurs/{regisseur}', [RegisseurController::class, 'update'])->name('regisseurs.update');
    route::delete('/dashboard/regisseurs/{regisseur}', [RegisseurController::class, 'destroy'])->name('regisseurs.destroy');
    Route::post('/dashboard/regisseurs', [RegisseurController::class, 'store'])->name('regisseurs.store');

    route::put('/dashboard/filieres/{filiere}', [FiliereController::class, 'update'])->name('filieres.update');
    Route::post('/dashboard/filieres', [FiliereController::class, 'store'])->name('filieres.store');
    Route::get('/dashboard/filieres', [FiliereController::class, 'index'])->name('dashboard.filieres');
});

Route::middleware(['auth', 'role:responsable'])->group(function () {
    Route::get('/responsable/filieres', [ResponsableController::class, 'filieres'])->name('responsable.filieres');
    Route::get('/filieres/export/', [FiliereController::class, 'export'])->name('filieres.export');
});

Route::get('/dashboard/etudiants', [EtudiantController::class, 'index'])->name('dashboard.etudiants')
    ->middleware('role:admin,regisseur');


Route::get('/filieres/{filiere}/etudiants/', [FiliereController::class, 'show'])->middleware(['auth', 'verified'])->name('filiere.etudiants');

Route::get('/get-years/{filiere_nom}', [FiliereController::class, 'getYears'])->name('get-years');
Route::get('/etudiants/filter', [FiliereController::class, 'filter'])->name('etudiants.filter');


Route::get('etudiants/{etudiant}/tranches', [TrancheController::class, 'index'])->middleware(['auth', 'role:professeur,regisseur,responsable', 'prof'])->name('etudiant.tranches');
Route::post('etudiants/{etudiant}/tranches', [TrancheController::class, 'store'])->middleware(['auth', 'role:professeur,regisseur', 'prof'])->name('tranches.store');

Route::post('/tranches/{tranche}/changestatus', [TrancheController::class, 'changeStatus'])->middleware(['auth', 'role:regisseur'])->name('tranches.changestatus');
Route::post('/tranches/{tranche}/numero', [TrancheController::class, 'addNumero'])->middleware(['auth', 'role:regisseur'])->name('tranches.numero.store');

Route::put('/tranches/{tranche}/', [TrancheController::class, 'update'])->middleware(['auth', 'role:professeur'])->name('tranches.update');
Route::delete('/tranches/{tranche}/', [TrancheController::class, 'destroy'])->middleware(['auth', 'role:professeur'])->name('tranches.destroy');


Route::get('/mark-notifications-as-read', [NotificationController::class, 'markAsRead'])->name('mark-notifications-as-read');
Route::get('/clear-notifications', [NotificationController::class, 'clearNotifications'])->name('clear-notifications');


Route::prefix('tranches/{tranche}/remarques')->group(function () {
    // Show the form to add or update a remarque
    Route::get('create', [RemarqueController::class, 'create'])->name('remarques.create');

    // Add or update a remarque
    Route::post('store', [RemarqueController::class, 'store'])->name('remarques.store');

    // Delete a remarque
    Route::delete('{remarque}', [RemarqueController::class, 'destroy'])->name('remarques.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
