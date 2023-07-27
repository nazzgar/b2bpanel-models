<?php

namespace B2BPanel\SharedModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publisher extends Model
{

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'grupa';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'grupa',
        'opis',
    ];

    public function lins(): HasMany
    {
        return $this->hasMany(Lin::class, 'PD_Wydawnictwo', 'grupa');
    }
}
