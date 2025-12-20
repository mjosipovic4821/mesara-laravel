<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proizvod extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'naziv_proizvoda',
        'tip',
        'prodajna_cena',
        'zaliha',
        'aktivan',
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
            'prodajna_cena' => 'decimal:2',
            'zaliha' => 'decimal:3',
            'aktivan' => 'boolean',
        ];
    }

    public function stavkaFaktures(): HasMany
    {
        return $this->hasMany(StavkaFakture::class);
    }
}
