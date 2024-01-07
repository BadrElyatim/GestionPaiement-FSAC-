<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\FiliereRequest;

class FiliereController extends Controller
{
    public function index()
    {
        $filieres = Filiere::all();
        $professeurs = User::where('role', 'professeur')->get();

        return view('filieres', [
            'filieres' => $filieres,
            'professeurs' => $professeurs
        ]);
    }

    public function update(Filiere $filiere, FiliereRequest $request)
    {
        $filiere->update(
            $request->validated()
        );

        return redirect()->back();
    }

    public function store(FiliereRequest $request)
    {
        $filiere = $request ->validated();

        Filiere::create(
            $filiere
        );

        return redirect()->back();
    }

    public function show(Filiere $filiere)
    {
        if (!Gate::allows('viewany-etudiant') && auth()->user()->filiere->id !== $filiere->id) {
            abort(403);
        }

        $filieres = Filiere::all();

        $etudiants = $filiere->etudiants;

        $totalMPC = $etudiants->sum('mpc');
        $totalMPNC = $etudiants->sum('mpnc');

        // Calculate total remaining amount (MR)
        $totalMR = $etudiants->sum(function ($etudiant) {
            return $etudiant->filiere->cout - $etudiant->mpc;
        });
        return view('filiere-show', [
            'etudiants' => $etudiants,
            'filieres' => $filieres,
            'totalMPC' => $totalMPC,
            'totalMPNC' => $totalMPNC,
            'totalMR' => $totalMR,
        ]);
    }
}
