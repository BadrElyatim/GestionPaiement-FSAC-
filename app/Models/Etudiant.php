<?php

namespace App\Models;

use App\Models\Filiere;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;

    protected $primaryKey = 'cne';

    protected $guarded = [];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function tranches()
    {
        return $this->hasMany(Tranche::class, 'etudiant_cne');
    }
}
