<?php

namespace B2BPanel\SharedModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contractor extends Model
{

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'logo';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'logo',
        'nazwa',
        'nip',
        'regon',
    ];

    /**
     * Faktury na których kontrahent jest płatnikiem
     */
    public function nagsAsRecipient(): HasMany
    {
        return $this->hasMany(Nag::class, 'logo', 'logo');
    }

    /**
     * Faktury na których kontrahent jest odbiorcą
     */
    public function nagsAsPayer(): HasMany
    {
        return $this->hasMany(Nag::class, 'logop', 'logo');
    }
}
