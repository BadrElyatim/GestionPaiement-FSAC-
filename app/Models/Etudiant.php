<?php

namespace App\Models;

use App\Models\Filiere;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function tranches()
    {
        return $this->hasMany(Tranche::class, 'etudiant_cne');
    }

    public function getMpcAttribute()
    {
        return $this->tranches->where('valide', 1)->sum('montant');
    }

    public function getMpncAttribute()
    {
        return $this->tranches->where('valide', 0)->sum('montant');
    }

    public function getMrAttribute()
    {
        $mr = $this->filiere->cout - $this->mpc;
        return $mr < 0 ? 0 : $mr;
    }

    public function getNtAttribute()
    {
        return $this->tranches->count();
    }

    public function getNtnAttribute()
    {
        return $this->tranches->where('valide', 0)->count();
    }
}
