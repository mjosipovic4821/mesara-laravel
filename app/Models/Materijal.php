<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materijal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'naziv',
        'jedinica_mere',
        'zaliha',
        'referentna_cena',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'zaliha' => 'decimal:3',
            'referentna_cena' => 'decimal:2',
        ];
    }

    public function stavkaNabavkes(): HasMany
    {
        return $this->hasMany(StavkaNabavke::class);
    }
}
