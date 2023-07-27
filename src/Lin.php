<?php

namespace B2BPanel\SharedModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'vat_suma',
        'PD_Wydawnictwo'
    ];

    public function nag(): BelongsTo
    {
        return $this->belongsTo(Nag::class, 'nagid', 'nagid');
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class, 'PD_Wydawnictwo', 'grupa');
    }
}
