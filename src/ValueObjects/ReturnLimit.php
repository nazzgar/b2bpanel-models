<?php

namespace B2BPanel\SharedModels\ValueObjects;

class ReturnLimit
{
    public function __construct(public float $zabawki, public float $jezykowe, public float $jezykowe_oxford, public float $edukacyjne, public float $pozostale)
    {
    }
}
