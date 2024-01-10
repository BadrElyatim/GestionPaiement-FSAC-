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

    public function show(Filiere $filiere, Request $request)
    {
        if (!Gate::allows('viewany-etudiant') && !auth()->user()->filieres->contains($filiere)) {
            abort(403);
        }

        if (auth()->user()->role == 'professeur') {
            $filieres = auth()->user()->filieres;
        } else {
            $filieres = Filiere::all();
        }

        $searchTerm = $request->input('search');

        if ($searchTerm) {
            $etudiants = $filiere->etudiants()->where(function ($query) use ($searchTerm) {
                $query->where('nom', 'LIKE', "%$searchTerm%")
                    ->orWhere('prenom', 'LIKE', "%$searchTerm%")
                    ->orWhere('cne', 'LIKE', "%$searchTerm%")
                    ->orWhere('cin', 'LIKE', "%$searchTerm%");
            })->get();
        } else {
            $etudiants = $filiere->etudiants;
        }


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
            'filiere' => $filiere
        ]);
    }
}
