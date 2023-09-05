<?php

namespace B2BPanel\SharedModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Returnm extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
    ];

    /**
     * Faktury na których kontrahent jest płatnikiem
     */
    public function returnLines(): HasMany
    {
        return $this->hasMany(ReturnLine::class);
    }

    //TODO: czy zwrot ma dotyczyć kontrhenta czy uzytkownika?
    public function customerUser(): BelongsTo
    {
        return $this->belongsTo(CustomerUser::class);
    }
}
