<?php

namespace B2BPanel\SharedModels\Services;

use B2BPanel\SharedModels\CustomerUser;
use B2BPanel\SharedModels\Exceptions\NoCurrentReturnCampaignException;
use B2BPanel\SharedModels\Interfaces\DefaultReturnLimitResolver;
use B2BPanel\SharedModels\ReturnCampaign;
use B2BPanel\SharedModels\ReturnLimit;
use B2BPanel\SharedModels\ValueObjects\ReturnLimit as ReturnLimitValueObject;

class ReturnLimitsService
{

    public function getPercentages(CustomerUser $user): ReturnLimitValueObject
    {
        /** @var ReturnCampaign | null $curr_return_campaign */
        $curr_return_campaign = ReturnCampaign::where('date_start', '<=', \Carbon\Carbon::now()->toDateString())
            ->where('date_end', '>=', \Carbon\Carbon::now()->toDateString())
            ->first();

        if ($curr_return_campaign === null) {
            throw new NoCurrentReturnCampaignException();
        }

        /** @var ReturnLimit | null $return_limit */
        $return_limit = $user->returnLimit()->where('return_campaign_id', $curr_return_campaign->id)->first();

        if ($return_limit === null) {
            //return default limit values
            return $curr_return_campaign->limits;
        }

        return $return_limit->limits;
    }

    public function getValues(CustomerUser $user)
    {
        $return_limit = $this->getPercentages($user);
    }
}
