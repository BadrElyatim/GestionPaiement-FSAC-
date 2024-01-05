<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Tranche;
use Illuminate\Http\Request;

class TrancheController extends Controller
{
    public function index(Etudiant $etudiant)
    {
        $tranches = $etudiant->tranches;

        return view('tranches', [
            'tranches' => $tranches,
            'etudiant_cne' => $etudiant->id
        ]);
    }

    public function store(Etudiant $etudiant, Request $request)
    {
        $last_number = $etudiant->tranches()->orderBy('numero', 'desc')->first();

        $last_number = $last_number ? $last_number->numero : 0;

        $validated = $request->validate([
            'date' => ['required', 'date'],
            'montant' => ['required', 'numeric', 'between:0.00,99999999.99'],
            'piece_recu' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048']
        ]);

        $imagePath = $request->file('piece_recu')->store('public'); // 'images' is the storage folder


        $validated = array_merge($validated, [
            'valide' => false,
            'numero' => $last_number + 1,
            'piece_recu' => $imagePath,
        ]);

        $etudiant->tranches()->create($validated);

        return redirect()->back();
    }

    public function changeStatus(Tranche $tranche)
    {
        $tranche->valide = !$tranche->valide;

        $tranche->save();

        return redirect()->back();
    }
}
