<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nabavka extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dobavljac_id',
        'datum_nabavke',
        'napomena',
        'ukupno',
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
            'dobavljac_id' => 'integer',
            'datum_nabavke' => 'date',
            'ukupno' => 'decimal:2',
        ];
    }

    public function dobavljac(): BelongsTo
    {
        return $this->belongsTo(Dobavljac::class);
    }

    public function stavkaNabavkes(): HasMany
    {
        return $this->hasMany(StavkaNabavke::class);
    }
}
