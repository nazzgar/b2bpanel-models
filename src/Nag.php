<?php

namespace B2BPanel\SharedModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Nag extends Model
{

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'nagid';


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
     * Linijki dowodu
     */
    public function lins(): HasMany
    {
        return $this->hasMany(Lin::class, 'nagid', 'nagid');
    }

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
