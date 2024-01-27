<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Filiere;

class FilieresExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Get all records from the Filiere model
        $filieres = Filiere::all();

        // Manually add custom attributes to each row in the collection
        $data = $filieres->map(function ($filiere) {
            return [
                'ID' => $filiere->id,
                'Nom' => $filiere->nom,
                'Date Accreditation' => $filiere->date_accreditation,
                'Type' => $filiere->type,
                'Cout' => $filiere->cout,
                'Duree' => $filiere->duree,
                'Annee Universitaire' => $filiere->annee_universitaire,
                'Professeur ID' => $filiere->professeur_id,
                'Mpc' => $filiere->Mpc == 0 ? "0" : $filiere->Mpc,
                'Mpnc' => $filiere->Mpnc == 0 ? "0" : $filiere->Mpnc,
                'Mr' => $filiere->Mr == 0 ? "0" : $filiere->Mr,
                'Nt' => $filiere->Nt == 0 ? "0" : $filiere->Nt,
                'MpcPercentage' => $filiere->MpcPercentage == 0 ? "0" : $filiere->MpcPercentage,
                "Nombre d'etudiants" => $filiere->etudiants()->count() == 0 ? "0" : $filiere->etudiants()->count()
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        // Define the headers for your Excel file
        return ['ID', 'Nom', 'Date Accreditation', 'Type', 'Cout', 'Duree', 'Annee Universitaire', 'Professeur ID', 'Mpc', 'Mpnc', 'Mr', 'Nt', 'MpcPercentage', 'Nombre d\'etudiants'];
    }
}
