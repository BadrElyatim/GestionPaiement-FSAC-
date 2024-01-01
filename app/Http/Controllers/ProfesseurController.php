<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfesseurRequest;
use Illuminate\Support\Facades\Validator;

class ProfesseurController extends Controller
{
    public function index()
    {
        $professeurs = User::where('role', 'professeur')->get();

        return view('professeurs', [
            'professeurs' => $professeurs,
        ]);
    }

    public function destroy(User $professeur, Request $request)
    {
        $validator = Validator::make([
            'professeur_id' => $professeur->id
        ], [
            'professeur_id' => 'required|unique:filieres',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('dashboard.professeurs')
                        ->withErrors([
                            'professeur_id' => "Une modification du responsable de la filière est nécessaire pour supprimer le professeur ($professeur->prenom $professeur->nom)."
                        ])
                        ->withInput();
        }

        $professeur->delete();

        return redirect()->route('dashboard.professeurs');
    }

    public function update(user $professeur, ProfesseurRequest $request)
    {
        $professeur->update(
            $request->validated()
        );

        return redirect()->back();
    }

    public function store(ProfesseurRequest $request)
    {
        $professeur = $request ->validated();

        $professeur['password'] = Hash::make($professeur['password']);
        $professeur['role'] = 'professeur';

        user::create(
            $professeur
        );

        return redirect()->back();
    }
}
