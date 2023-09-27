<?php

namespace B2BPanel\SharedModels\Services;

use B2BPanel\SharedModels\CustomerUser;
use Illuminate\Support\Facades\DB;

class LinsService
{
    public function getLins(CustomerUser $user)
    {
        $contractor = $user->contractors()->first();

        return DB::select("select n.numer, l.lp, n.logo, n.data, l.kodkres, l.symkar, l.opis, l.ilosc, l.cena_brutto_po_rabacie as brutto, l.cena_netto_po_rabacie as netto, l.PD_typoferty as typ_oferty, p.opis as wydawnictwo from lins l inner join nags n on n.nagid = l.nagid inner join publishers p on p.grupa=l.PD_Wydawnictwo where n.logo = :logo order by n.numer, l.lp", ["logo" => $contractor->logo]);
    }


    /**
     * Get lins with nag.is_returnable = 1
     */
    public function getLinsForReturnValueLimit(CustomerUser $user)
    {
        $contractor = $user->contractors()->first();

        return DB::select("select n.numer, l.lp, n.logo, n.data, l.kodkres, l.symkar, l.opis, l.ilosc, l.cena_brutto_po_rabacie as brutto, l.cena_netto_po_rabacie as netto, l.PD_typoferty as typ_oferty, p.opis as wydawnictwo from lins l inner join nags n on n.nagid = l.nagid inner join publishers p on p.grupa=l.PD_Wydawnictwo where n.logo = :logo and n.is_returnable = 1 order by n.numer, l.lp", ["logo" => $contractor->logo]);
    }
}
