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
            })->get()->sortBy('Ntn', SORT_REGULAR, true);
        } else {
            $etudiants = $filiere->etudiants->sortBy('Ntn', SORT_REGULAR, true);
        }

        if ($request->filiere && $request->annee_universitaire) {
            $etudiants = $etudiants->where('filiere.nom', $request->filiere)
                                 ->where('filiere.annee_universitaire', $request->annee_universitaire);


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

    public function getYears($filiere_nom)
    {
        $filiere = Filiere::where('nom', $filiere_nom)->first();

        if ($filiere) {
            $years = Filiere::where('nom', $filiere_nom)
                ->pluck('annee_universitaire')
                ->unique()
                ->values()
                ->all();

            return response()->json($years);
        } else {
            return response()->json(['error' => 'Filiere not found'], 404);
        }
    }

    public function filter(Request $request)
    {
        $filiere = Filiere::where('nom', $request->filiere)
            ->where('annee_universitaire', $request->annee_universitaire)
            ->first();

        if ($filiere) {
            return redirect()->route('filiere.etudiants', ['filiere' => $filiere->id]);
        } else {
            return abort(404);
        }
    }
}
