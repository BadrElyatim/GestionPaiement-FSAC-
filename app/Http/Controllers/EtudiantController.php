<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\AddEtudiantRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateEtudiantRequest;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::with('filiere')->get();
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
