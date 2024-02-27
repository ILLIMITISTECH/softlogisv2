<?php

namespace App\Models;

use App\Models\Company;
use App\Models\GrilleHad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GrilleTransit extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'transitaire_uuid',
        'had_uuid',
        'cout',
        'etat',
    ];

    public function had()
    {
        return $this->belongsTo(GrilleHad::class, 'had_uuid', 'uuid');
    }

    public function transitaire()
    {
        return $this->belongsTo(Company::class, 'transitaire_uuid', 'uuid');
    }

}
