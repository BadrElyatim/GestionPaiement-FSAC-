<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\FiliereRequest;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function show(Filiere $filiere, Request $request)
    {
        // Check authorization
        if (!Gate::allows('viewany-etudiant') && !auth()->user()->filieres->contains($filiere)) {
            abort(403);
        }

        // Determine the list of filieres based on user role
        $filieres = (auth()->user()->role == 'professeur') ? auth()->user()->filieres : Filiere::all();

        // Retrieve search term
        $searchTerm = $request->input('search');

        // Query etudiants relation on the filiere
        $etudiants = $filiere->etudiants();

        // Apply search filter if search term is provided
        if ($searchTerm) {
            $etudiants->where(function ($query) use ($searchTerm) {
                $query->where('nom', 'LIKE', "%$searchTerm%")
                    ->orWhere('prenom', 'LIKE', "%$searchTerm%")
                    ->orWhere('cne', 'LIKE', "%$searchTerm%")
                    ->orWhere('cin', 'LIKE', "%$searchTerm%");
            });
        }

        // Retrieve all etudiants and sort them
        $etudiants = $etudiants->get()->sortBy('Ntn');

        // Calculate totals
        $totalMPC = $etudiants->sum('mpc');
        $totalMPNC = $etudiants->sum('mpnc');
        $totalMR = $etudiants->sum(function ($etudiant) {
            return $etudiant->filiere->cout - $etudiant->mpc;
        });

        // Now that we have sorted the collection, we can paginate it
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 20;
        $currentPageItems = $etudiants->slice(($currentPage - 1) * $perPage, $perPage)->all();

        // Create the LengthAwarePaginator instance with the current page and per page values
        $etudiants = new LengthAwarePaginator($currentPageItems, $etudiants->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(), // Maintain the current path
            'pageName' => 'page', // Specify the page parameter name
        ]);



        return view('filiere-show', [
            'etudiants' => $etudiants,
            'filieres' => $filieres,
            'totalMPC' => $totalMPC,
            'totalMPNC' => $totalMPNC,
            'totalMR' => $totalMR,
            'filiere' => $filiere
        ]);
    }


    public function getYears($filiere_nom)
    {
        $filiere = Filiere::where('nom', $filiere_nom)->first();

        if ($filiere) {
            $years = Filiere::where('nom', $filiere_nom)
                ->pluck('annee_universitaire')
                ->unique()
                ->values()
                ->all();

            return response()->json($years);
        } else {
            return response()->json(['error' => 'Filiere not found'], 404);
        }
    }

    public function filter(Request $request)
    {
        $filiere = Filiere::where('nom', $request->filiere)
            ->where('annee_universitaire', $request->annee_universitaire)
            ->first();

        if ($filiere) {
            return redirect()->route('filiere.etudiants', ['filiere' => $filiere->id]);
        } else {
            return abort(404);
        }
    }

    public function export()
    {
        return Excel::download(new \App\Exports\FilieresExport(), 'filieres.xlsx');
    }
}
