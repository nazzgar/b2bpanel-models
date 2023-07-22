<?php

namespace B2BPanel\SharedModels;

use Illuminate\Database\Eloquent\Model;
class Contractor extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'logo',
        'nazwa',
        'nip',
        'regon',
    ];

}
