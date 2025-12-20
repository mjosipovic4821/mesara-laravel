<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StavkaFakture extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'faktura_id',
        'proizvod_id',
        'kolicina',
        'cena',
        'iznos',
    ];

    /**
     * Attribute casting.
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
        ];
    }

    /**
     * Faktura kojoj stavka pripada.
     */
    public function faktura(): BelongsTo
    {
        return $this->belongsTo(Faktura::class);
    }

    /**
     * Proizvod koji je na stavci.
     */
    public function proizvod(): BelongsTo
    {
        return $this->belongsTo(Proizvod::class);
    }
}
