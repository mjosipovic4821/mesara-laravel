<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StavkaFakture extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'faktura_id',
        'proizvod_id',
        'kolicina',
        'cena',
        'iznos',
        'faktura_proizvod_id',
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
            'faktura_id' => 'integer',
            'proizvod_id' => 'integer',
            'kolicina' => 'decimal:3',
            'cena' => 'decimal:2',
            'iznos' => 'decimal:2',
            'faktura_proizvod_id' => 'integer',
        ];
    }

    public function fakturaProizvod(): BelongsTo
    {
        return $this->belongsTo(FakturaProizvod::class);
    }

    public function faktura(): BelongsTo
    {
        return $this->belongsTo(Faktura::class);
    }

    public function proizvod(): BelongsTo
    {
        return $this->belongsTo(Proizvod::class);
    }
}
