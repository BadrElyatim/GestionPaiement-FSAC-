<?php

namespace App\Models;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Filiere extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function professeur()
    {
        return $this->belongsTo(User::class);
    }

    public function getMpcAttribute()
    {
        return $this->etudiants->sum('Mpc');
    }

    public function getMpncAttribute()
    {
        return $this->etudiants->sum('Mpnc');
    }

    public function getMrAttribute()
    {
        $mr = $this->cout * $this->etudiants->count() - $this->mpc;

        return $mr < 0 ? 0 : $mr;
    }

    public function getNtAttribute()
    {
        return $this->etudiants->sum('Nt');
    }

    public function getMpcPercentageAttribute()
    {
        $totalMontant = $this->cout * $this->etudiants->count();

        if ($totalMontant > 0) {
            return ($this->mpc / $totalMontant) * 100;
        } else {
            return 0; // To avoid division by zero
        }
    }
}
