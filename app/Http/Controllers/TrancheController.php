<?php

namespace App\Http\Controllers;

use App\Models\Tranche;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrancheController extends Controller
{
    public function index(Etudiant $etudiant)
    {
        $tranches = $etudiant->tranches;

        $total_payee = $tranches->reject(function (Tranche $tranche) {
            return $tranche->valide === 0;
        })->reduce(function (?int $carry, Tranche $tranche) {
            return $carry + $tranche->montant;
        });

        return view('tranches', [
            'tranches' => $tranches,
            'etudiant_cne' => $etudiant->id,
            'total_payee' => $total_payee ?? 0,
            'reste' => $etudiant->filiere->cout - $total_payee
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

    public function destroy(Tranche $tranche)
    {
        $tranche->delete();

        return redirect()->back();
    }

    public function update(Tranche $tranche, Request $request)
    {
        $validated = $request->validate(
            [
                'date' => ['required', 'date'],
                'montant' => ['required', 'numeric', 'between:0.00,99999999.99'],
                'piece_recu' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048']
            ]
        );

        if ($request->hasFile('piece_recu')) {
            // Delete the old file if it exists
            if ($tranche->piece_recu) {
                Storage::delete($tranche->piece_recu);
            }

            $file = $request->file('piece_recu');
            $file_path = $file->store('public'); // Update the storage path as needed
            $validated['piece_recu'] = $file_path;
        }


        // Update Tranche model
        $tranche->update($validated);

        return redirect()->back();
    }

    public function changeStatus(Tranche $tranche)
    {
        $tranche->valide = !$tranche->valide;

        $tranche->save();

        return redirect()->back();
    }

    public function addNumero(Tranche $tranche, Request $request)
    {
        $request->validate([
            'numero_de_recu' => ['required', 'string', 'max:255']
        ]);

        $tranche->numero_de_recu = $request->numero_de_recu;
        $tranche->valide = true;
        $tranche->date_de_validation = now();

        $tranche->save();

        return redirect()->back();
    }
}
