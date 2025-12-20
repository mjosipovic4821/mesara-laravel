<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StavkaNabavke extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'nabavka_id',
        'materijal_id',
        'kolicina',
        'cena_po_jedinici',
        'iznos',
    ];

    /**
     * Attribute casting.
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'nabavka_id' => 'integer',
            'materijal_id' => 'integer',
            'kolicina' => 'decimal:3',
            'cena_po_jedinici' => 'decimal:2',
            'iznos' => 'decimal:2',
        ];
    }

    /**
     * Nabavka kojoj stavka pripada.
     */
    public function nabavka(): BelongsTo
    {
        return $this->belongsTo(Nabavka::class);
    }

    /**
     * Materijal koji se nabavlja.
     */
    public function materijal(): BelongsTo
    {
        return $this->belongsTo(Materijal::class);
    }
}
