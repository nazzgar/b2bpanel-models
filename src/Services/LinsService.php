<?php

namespace B2BPanel\SharedModels\Services;

use B2BPanel\SharedModels\CustomerUser;
use B2BPanel\SharedModels\ReturnCampaign;
use Illuminate\Support\Facades\DB;

class LinsService
{
    public function getLins(CustomerUser $user, ReturnCampaign $returncampaign)
    {
        $contractor = $user->contractors()->first();

        return collect(DB::select(
            "select n.numer, l.lp, n.logo, n.data, l.kodkres, l.symkar, l.opis, l.ilosc, l.cena_brutto_po_rabacie as brutto, l.cena_netto_po_rabacie as netto, l.PD_typoferty as typ_oferty, p.opis as wydawnictwo from lins l inner join nags n on n.nagid = l.nagid inner join publishers p on p.grupa=l.PD_Wydawnictwo left join bez_prawa_zwrotu_products bp on bp.symkar = l.symkar where n.logo = :logo and (bp.isZwrotne is null or bp.isZwrotne = 1) and n.data >= :invoices_from and n.data <= :invoices_to order by n.numer, l.lp",
            [
                "logo" => $contractor->logo,
                "invoices_from" => $returncampaign->invoices_from,
                "invoices_to" => $returncampaign->invoices_to,
            ]
        ));
    }


    /**
     * Get lins with nag.is_returnable = 1
     */
    public function getLinsForReturnValueLimit(CustomerUser $user, ReturnCampaign $returncampaign)
    {
        $contractor = $user->contractors()->first();

        return collect(DB::select(
            "select n.numer, l.lp, n.logo, n.data, l.kodkres, l.symkar, l.opis, l.ilosc, l.cena_brutto_po_rabacie as brutto, l.cena_netto_po_rabacie as netto, l.PD_typoferty as typ_oferty, p.opis as wydawnictwo from lins l inner join nags n on n.nagid = l.nagid inner join publishers p on p.grupa=l.PD_Wydawnictwo left join bez_prawa_zwrotu_products bp on bp.symkar = l.symkar where n.logo = :logo and n.is_returnable = 1 and n.data >= :invoices_from and n.data <= :invoices_to order by n.numer, l.lp",
            [
                "logo" => $contractor->logo,
                "invoices_from" => $returncampaign->invoices_from,
                "invoices_to" => $returncampaign->invoices_to,
            ]
        ));
    }
}
