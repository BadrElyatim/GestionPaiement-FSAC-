<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\AddEtudiantRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateEtudiantRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class EtudiantController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $etudiants = Etudiant::with('filiere');

        if ($searchTerm) {
            $etudiants->where('nom', 'LIKE', "%$searchTerm%")
                ->orWhere('prenom', 'LIKE', "%$searchTerm%")
                ->orWhere('cne', 'LIKE', "%$searchTerm%")
                ->orWhere('cin', 'LIKE', "%$searchTerm%");
        }

        if ($request->filled('filiere') && $request->filled('annee_universitaire')) {
            $etudiants->whereHas('filiere', function ($query) use ($request) {
                $query->where('nom', $request->filiere)
                    ->where('annee_universitaire', $request->annee_universitaire);
            });
        }

        $etudiants = $etudiants->get()->sortBy('Ntn');

        // Now that we have sorted the collection, we can paginate it
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 20;
        $currentPageItems = $etudiants->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $etudiants = new LengthAwarePaginator($currentPageItems, $etudiants->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(), // Maintain the current path
            'pageName' => 'page', // Specify the page parameter name
        ]);

        $filieres = Filiere::all();

        return view('dashboard', [
            'etudiants' => $etudiants,
            'filieres' => $filieres
        ]);
    }


    public function destroy(Etudiant $etudiant)
    {
        $validator = Validator::make([
            'etudiant_cne' => $etudiant->id
        ], [
            'etudiant_cne' => 'required|unique:tranches',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors([
                            'etudiant_id' => "le suppression de l'etudiant ($etudiant->prenom $etudiant->nom) ne peut pas etre effectue, car il a des tranches."
                        ])
                        ->withInput();
        }
        $etudiant->delete();

        return redirect()->route('dashboard.etudiants');
    }

    public function update(Etudiant $etudiant, Request $request)
    {
        $validated = $request->validate(
            [
                'prenom' => ['required', 'string', 'max:255'],
                'nom' => ['required', 'string', 'max:255'],
                'cne' => ['required', 'string', Rule::when($etudiant->cne != $request->cne, Rule::unique('etudiants'))],
                'cin' => ['required', 'string', 'max:255'],
                'lieu_de_naissance' => ['required', 'string', 'max:255'],
                'date_de_naissance' => ['required', 'date', 'max:255'],
                'filiere_id' => ['required', 'integer']
            ]
        );

        $etudiant->update(
            $validated
        );

        return redirect()->back();
    }

    public function store(AddEtudiantRequest $request)
    {
        Etudiant::create(
            $request ->validated()
        );

        return redirect()->back();
    }


}
