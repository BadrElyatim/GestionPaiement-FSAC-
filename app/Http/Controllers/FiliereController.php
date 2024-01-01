<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Filiere;
use Illuminate\Http\Request;
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
}
