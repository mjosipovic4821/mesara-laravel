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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kupac_id',
        'radnik_id',
        'datum',
        'napomena',
        'ukupno',
        'kupac_radnik_id',
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
            'kupac_id' => 'integer',
            'radnik_id' => 'integer',
            'datum' => 'date',
            'ukupno' => 'decimal:2',
            'kupac_radnik_id' => 'integer',
        ];
    }

    public function kupacRadnik(): BelongsTo
    {
        return $this->belongsTo(KupacRadnik::class);
    }

    public function kupac(): BelongsTo
    {
        return $this->belongsTo(Kupac::class);
    }

    public function radnik(): BelongsTo
    {
        return $this->belongsTo(Radnik::class);
    }

    public function stavkaFaktures(): HasMany
    {
        return $this->hasMany(StavkaFakture::class);
    }
}
