<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Sourcing;
use App\Models\LivraisonFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OdLivraison extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'code',
        'etat',
        'note',
        'transporteur_uuid',
        'date_livraison',
        'lieu_livraison',
        'created_by',
        'sourcing_id',

        'numOt',
        'numFolder',
        'numBl',
        'trajetStart_uuid',
        'trajetEnd_uuid',
        'refCotation',
        'nbrMachine',
        'productUuid',
        
    ];

    public function files()
    {
        return $this->hasMany(LivraisonFile::class, 'livraison_id');
    }

    public function transporteur(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'transporteur_uuid', 'uuid');
    }

    public function sourcing()
    {
        return $this->belongsTo(Sourcing::class, 'sourcing_id', 'uuid');
    }

    public function products()
    {
        return $this->belongsToMany(Article::class, 'ot_products', 'ot_id', 'product_id');
    }

}
