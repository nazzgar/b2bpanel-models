<?php

namespace B2BPanel\SharedModels\ValueObjects;

class ReturnLimitByValue
{
    public function __construct(public int $zabawki, public int $jezykowe, public int $jezykowe_oxford, public int $edukacyjne, public int $pozostale)
    {
    }
}
