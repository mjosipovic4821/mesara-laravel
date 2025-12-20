<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StavkaNabavke extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nabavka_id',
        'materijal_id',
        'kolicina',
        'cena_po_jedinici',
        'iznos',
        'nabavka_materijal_id',
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
            'nabavka_id' => 'integer',
            'materijal_id' => 'integer',
            'kolicina' => 'decimal:3',
            'cena_po_jedinici' => 'decimal:2',
            'iznos' => 'decimal:2',
            'nabavka_materijal_id' => 'integer',
        ];
    }

    public function nabavkaMaterijal(): BelongsTo
    {
        return $this->belongsTo(NabavkaMaterijal::class);
    }

    public function nabavka(): BelongsTo
    {
        return $this->belongsTo(Nabavka::class);
    }

    public function materijal(): BelongsTo
    {
        return $this->belongsTo(Materijal::class);
    }
}
