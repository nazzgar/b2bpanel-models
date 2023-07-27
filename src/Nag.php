<?php

namespace B2BPanel\SharedModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Nag extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nagid',
        'rd',
        'numer',
        'numerdok',
        'opis',
        'logo',
        'logop'
    ];

    /**
     * Odbiorca
     */
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(Contractor::class, 'logo', 'logo');
    }


    /**
     * Płatnik
     */
    public function payer(): BelongsTo
    {
        return $this->belongsTo(Contractor::class, 'logop', 'logo');
    }
}
