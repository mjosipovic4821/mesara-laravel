<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faktura extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'kupac_id',
        'radnik_id',
        'datum',
        'napomena',
        'ukupno',
    ];

    /**
     * Attribute casting.
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'kupac_id' => 'integer',
            'radnik_id' => 'integer',
            'datum' => 'date',
            'ukupno' => 'decimal:2',
        ];
    }

    /**
     * Kupac kome je izdata faktura.
     */
    public function kupac(): BelongsTo
    {
        return $this->belongsTo(Kupac::class);
    }

    /**
     * Radnik koji je izdao fakturu.
     */
    public function radnik(): BelongsTo
    {
        return $this->belongsTo(Radnik::class);
    }

    /**
     * Stavke fakture.
     */
    public function stavkaFaktures(): HasMany
    {
        return $this->hasMany(StavkaFakture::class);
    }
}
