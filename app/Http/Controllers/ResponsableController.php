<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;

class ResponsableController extends Controller
{
    public function filieres(Request $request)
    {

        if ($request->filiere && $request->annee_universitaire) {
            $filieresRes = Filiere::where('nom', $request->filiere)
                            ->where('annee_universitaire', $request->annee_universitaire)
                            ->get();
        }

        return view('responsable.filieres', [
            'filieresRes' => $filieresRes ?? null,
            'filieres' => Filiere::all()
        ]);
    }
}
