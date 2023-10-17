<?php

namespace B2BPanel\SharedModels;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;


class Announcement extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'start_showing_at',
        'stop_showing_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_showing_at' => 'datetime',
        'stop_showing_at' => 'datetime',
        //TODO: sth is wrong with attribute boolean cast
        'isVisible' => 'boolean',
        'is_visible' => 'boolean'
    ];

    protected function isVisible(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => Carbon::now()->between($attributes['start_showing_at'], $attributes['stop_showing_at'])
        );
    }
}
