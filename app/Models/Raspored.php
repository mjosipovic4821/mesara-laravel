<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Raspored extends Model
{
    use HasFactory;

    protected $fillable = [
        'radnik_id',
        'week_start',
        'dan',
        'smena',
        'zadatak',
    ];

    protected function casts(): array
    {
        return [
            'radnik_id' => 'integer',
            'week_start' => 'date',
            'dan' => 'integer',
        ];
    }

    public function radnik(): BelongsTo
    {
        return $this->belongsTo(Radnik::class);
    }
}
