<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddResponsableRequest;
use App\Http\Requests\UpdateResponsableRequest;

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

    public function index()
    {
        $responsables = User::where('role', 'responsable')->get();

        return view('responsable.index', [
            'responsables' => $responsables,
        ]);
    }

    public function destroy(User $responsable)
    {
        $responsable->delete();

        return redirect()->route('dashboard.responsables');
    }

    public function update(user $responsable, UpdateResponsableRequest $request)
    {
        $responsable->update(
            $request->validated()
        );

        return redirect()->back();
    }

    public function store(AddResponsableRequest $request)
    {
        $responsable = $request ->validated();

        $responsable['password'] = Hash::make($responsable['password']);
        $responsable['role'] = 'responsable';

        user::create(
            $responsable
        );

        return redirect()->back();
    }
}
