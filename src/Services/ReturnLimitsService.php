<?php

namespace B2BPanel\SharedModels\Services;

use B2BPanel\SharedModels\Contractor;
use B2BPanel\SharedModels\CustomerUser;
use B2BPanel\SharedModels\Exceptions\NoCurrentReturnCampaignException;
use B2BPanel\SharedModels\Interfaces\DefaultReturnLimitResolver;
use B2BPanel\SharedModels\ReturnCampaign;
use B2BPanel\SharedModels\ReturnLimit;
use B2BPanel\SharedModels\ValueObjects\ReturnLimit as ReturnLimitValueObject;
use B2BPanel\SharedModels\ValueObjects\ReturnLimitByValue as ReturnLimitByValueValueObject;
use Illuminate\Database\Eloquent\Collection;

class ReturnLimitsService
{

    public function getPercentages(CustomerUser $user, ReturnCampaign $return_campaign): ReturnLimitValueObject
    {
        /** @var ReturnCampaign | null $curr_return_campaign */
        /*         $curr_return_campaign = ReturnCampaign::where('date_start', '<=', \Carbon\Carbon::now()->toDateString())
            ->where('date_end', '>=', \Carbon\Carbon::now()->toDateString())
            ->first();

        if ($curr_return_campaign === null) {
            throw new NoCurrentReturnCampaignException();
        } */

        /** @var ReturnLimit | null $return_limit */
        $return_limit = $user->returnLimit()->where('return_campaign_id', $return_campaign->id)->first();

        if ($return_limit === null) {
            //return default limit values
            return $return_campaign->limits;
        }

        return $return_limit->limits;
    }

    public function getValues(CustomerUser $user, ReturnCampaign $return_campaign, LinsService $lin_service): ReturnLimitByValueValueObject
    {
        $return_limit = $this->getPercentages($user, $return_campaign);

        //TODO: obsłużyć przypadek gdy płatnik rozlicza odbiorców

        $lins =  $lin_service->getLinsForReturnValueLimit($user, $return_campaign);

        $jezykowe =  intval($lins->filter(function ($value, $key) {
            return $value->typ_oferty === 'Językowe' and $value->wydawnictwo !== 'Oxford University Press';
        })->reduce(function ($carry, $item) {
            return $carry + $item->ilosc * $item->netto;
        }, 0) * $return_limit->jezykowe);

        $zabawki =  intval($lins->filter(function ($value, $key) {
            return $value->typ_oferty === 'Zabawki';
        })->reduce(function ($carry, $item) {
            return $carry + $item->ilosc * $item->netto;
        }, 0) * $return_limit->zabawki);

        $jezykowe_oxford =  intval($lins->filter(function ($value, $key) {
            return $value->typ_oferty === 'Językowe' and $value->wydawnictwo === 'Oxford University Press';
        })->reduce(function ($carry, $item) {
            return $carry + $item->ilosc * $item->netto;
        }, 0) * $return_limit->jezykowe_oxford);

        $edukacyjne =  intval($lins->filter(function ($value, $key) {
            return $value->typ_oferty === 'Edukacja';
        })->reduce(function ($carry, $item) {
            return $carry + $item->ilosc * $item->netto;
        }, 0) * $return_limit->edukacyjne);

        $pozostale =  intval($lins->filter(function ($value, $key) {
            return $value->typ_oferty === 'Pozostałe';
        })->reduce(function ($carry, $item) {
            return $carry + $item->ilosc * $item->netto;
        }, 0) * $return_limit->pozostale);

        return new ReturnLimitByValueValueObject($zabawki, $jezykowe, $jezykowe_oxford, $edukacyjne, $pozostale);
    }


    /**
     * Set return limit for each related customeruser
     */
    public function setReturnLimit(Contractor $contractor, ReturnCampaign $return_campaign, ReturnLimitValueObject $return_Limit_vo)
    {
        /** @var Collection<CustomerUser> */
        $customer_users = $contractor->customerUsers;

        $customer_users->each(function (CustomerUser $customer_user) use ($return_campaign, $return_Limit_vo) {
            $return_limit = ReturnLimit::firstOrNew([
                'customer_user_id' => $customer_user->id,
                'return_campaign_id' => $return_campaign->id,
            ]);
            $return_limit->limits = $return_Limit_vo;
            $return_limit->save();
        });
    }
}
