<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddRegisseurRequest;
use App\Http\Requests\UpdateRegisseurRequest;

class RegisseurController extends Controller
{
    public function index()
    {
        $regisseurs = User::where('role', 'regisseur')->get();

        return view('regisseurs', [
            'regisseurs' => $regisseurs,
        ]);
    }

    public function destroy(User $regisseur)
    {
        $regisseur->delete();

        return redirect()->route('dashboard.regisseurs');
    }

    public function update(user $regisseur, UpdateRegisseurRequest $request)
    {
        $regisseur->update(
            $request->validated()
        );

        return redirect()->back();
    }

    public function store(AddRegisseurRequest $request)
    {
        $regisseur = $request ->validated();

        $regisseur['password'] = Hash::make($regisseur['password']);
        $regisseur['role'] = 'regisseur';

        user::create(
            $regisseur
        );

        return redirect()->back();
    }
}
