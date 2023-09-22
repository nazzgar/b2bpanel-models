<?php

namespace B2BPanel\SharedModels;

use B2BPanel\SharedModels\Casts\ReturnLimit as ReturnLimitCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReturnLimit extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_user_id',
        'return_campaign_Id',
        'limits'
    ];

    protected $casts = [
        'limits' => ReturnLimitCast::class
    ];

    public function returnmCampaign(): BelongsTo
    {
        return $this->belongsTo(ReturnCampaign::class);
    }

    public function customerUser(): BelongsTo
    {
        return $this->belongsTo(CustomerUser::class);
    }
}