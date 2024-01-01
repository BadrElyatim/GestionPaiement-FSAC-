<?php

namespace App\Http\Controllers;

use App\Http\Requests\EtudiantRequest;
use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Http\Request;

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
        $etudiant->delete();

        return redirect()->route('dashboard.etudiants');
    }

    public function update(Etudiant $etudiant, EtudiantRequest $request)
    {
        $etudiant->update(
            $request->validated()
        );

        return redirect()->back();
    }

    public function store(EtudiantRequest $request)
    {
        Etudiant::create(
            $request ->validated()
        );

        return redirect()->back();
    }


}
