<?php

namespace B2BPanel\SharedModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BezPrawaZwrotuProduct extends Model
{

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'symkar';

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
        'symkar',
        'kodkres',
        'opis',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'isZwrotne' => 'boolean',
    ];

    public function makeReturnable(): void
    {
        $this->update(['isZwrotne' => true]);
    }

    public function makeUnreturnable(): void
    {
        $this->update(['isZwrotne' => false]);
    }

}
