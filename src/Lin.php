<?php

namespace B2BPanel\SharedModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lin extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nagid',
        'lp',
        'kodkres',
        'symkar',
        'ilosc',
        'JM',
        'stawka',
        'cena_netto',
        'cena_netto_po_rabacie',
        'cena_brutto',
        'cena_brutto_po_rabacie',
        'opis',
        'netto_suma',
        'brutto_suma',
        'vat_suma'
    ];

    public function nag(): BelongsTo
    {
        return $this->belongsTo(Nag::class, 'nagid', 'nagid');
    }
}
