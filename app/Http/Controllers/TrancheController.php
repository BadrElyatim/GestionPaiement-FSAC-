<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Tranche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrancheController extends Controller
{
    public function index(Etudiant $etudiant)
    {
        $tranches = $etudiant->tranches;

        return view('tranches', [
            'tranches' => $tranches
        ]);
    }

    public function store(Etudiant $etudiant, Request $request)
    {
        $last_number = $etudiant->tranches()->orderBy('numero', 'desc')->first();

        $last_number = $last_number ? $last_number->numero : 1;

        $validated = $request->validate([
            'date' => ['required', 'date'],
            'montant' => ['required', 'numeric', 'between:0.00,99999999.99'],
            'numero_de_recu' => ['required', 'string', 'max:255'],
            'piece_recu' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048']
        ]);

        $imagePath = $request->file('piece_recu')->store('images'); // 'images' is the storage folder


        $validated = array_merge($validated, [
            'valide' => false,
            'numero' => $last_number + 1,
            'piece_recu' => $imagePath,
        ]);

        $etudiant->tranches()->create($validated);

        return redirect()->back();
    }
}
