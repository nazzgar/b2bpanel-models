<?php

namespace B2BPanel\SharedModels\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use B2BPanel\SharedModels\ValueObjects\ReturnLimit as ReturnLimitValueObject;
use InvalidArgumentException;

class ReturnLimit implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ReturnLimitValueObject
    {
        return unserialize($attributes[['limits']]);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        if (!$value instanceof ReturnLimitValueObject) {
            throw new InvalidArgumentException('The given value is not an ReturnLimitValueObject instance.');
        }

        return ['limits' => serialize($value)];

        /* return [
            'zabawki' => $value->zabawki,
            'jezykowe' => $value->jezykowe,
            'jezykowe_oxford' => $value->jezykowe_oxford,
            'edukacyjne' => $value->edukacyjne,
            'pozostale' => $value->pozostale,
        ]; */
    }
}
