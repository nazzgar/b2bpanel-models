<?php

namespace B2BPanel\SharedModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReturnCampaign extends Model
{



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'date_start',
        'date_end'
    ];

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime'
    ];

    public function Returnm(): HasMany
    {
        return $this->hasMany(Returnm::class);
    }
}
