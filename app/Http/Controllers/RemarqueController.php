<?php

namespace App\Http\Controllers;

use App\Models\Tranche;
use App\Notifications\RemarqueNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class RemarqueController extends Controller
{
    public function store(Request $request, Tranche $tranche)
    {
        // Validation des données du formulaire (ajustez cela en fonction de vos besoins)
        $request->validate([
            'remarque' => 'required|string|max:255',
        ]);

        // Mise à jour de la remarque associée à la tranche
        $tranche->update([
            'remarque' => $request->input('remarque'),
        ]);

        $etudiant = $tranche->etudiant;

        Notification::send($etudiant->filiere->professeur, new RemarqueNotification(
            $request->input('remarque'),
            $tranche->numero,
            ['prenom' => $etudiant->prenom, 'nom' => $etudiant->nom],
            ['prenom' => auth()->user()->prenom, 'nom' => auth()->user()->nom],
            'Your have a new remark from'
        ));

        return redirect()->back()->with('success', 'Remarque ajoutée avec succès.');
    }

    // Pas besoin de la méthode show si la remarque est affichée directement avec la tranche

    public function update(Request $request, Tranche $tranche)
    {
        // Validation des données du formulaire (ajustez cela en fonction de vos besoins)
        $request->validate([
            'remarque' => 'required|string|max:255',
        ]);

        // Mise à jour de la remarque associée à la tranche
        $tranche->update([
            'remarque' => $request->input('remarque'),
        ]);

        return redirect()->back()->with('success', 'Remarque mise à jour avec succès.');
    }

    public function destroy(Tranche $tranche)
    {
        // Delete the remarque associated with the tranche
        $tranche->update([
            'remarque' => null, // or any logic you need to delete the remark
        ]);

        return redirect()->back()->with('success', 'Remarque supprimée avec succès.');
    }
}
