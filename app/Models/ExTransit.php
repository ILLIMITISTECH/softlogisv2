<?php

namespace App\Models;

use App\Models\User;
use App\Models\Company;
use App\Models\Expedition;
use App\Models\ExTransiteFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExTransit extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'code',
        'etat',
        'expedition_uuid',
        'note',
        'transitaire_uuid',
        'user_uuid',
    ];

    public function files()
    {
        return $this->hasMany(ExTransiteFile::class, 'transite_uuid', 'uuid');
    }


    public function expedition()
    {
        return $this->belongsTo(Expedition::class, 'expedition_uuid', 'uuid');
    }

    public function transitaire()
    {
        return $this->belongsTo(Company::class, 'transitaire_uuid', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
