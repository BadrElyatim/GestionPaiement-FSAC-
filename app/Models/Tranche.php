<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tranche extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_cne');
    }
}
