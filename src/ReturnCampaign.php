<?php

namespace B2BPanel\SharedModels;

use B2BPanel\SharedModels\Casts\ReturnLimit;
use B2BPanel\SharedModels\ValueObjects\ReturnLimit as ReturnLimitValueObject;
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
        'date_end',
        'limits'
    ];

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
        'limits' => ReturnLimit::class,
    ];

    public function Returnm(): HasMany
    {
        return $this->hasMany(Returnm::class);
    }

    protected static function booted(): void
    {
        static::saving(function (ReturnCampaign $return_campaign) {
            if ($return_campaign->limits === null) {
                $return_campaign->limits = new ReturnLimitValueObject(0.0, 0.0, 0.0, 0.0, 0.0);
            }
        });
    }
}
