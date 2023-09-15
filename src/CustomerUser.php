<?php

namespace B2BPanel\SharedModels;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use B2BPanel\SharedModels\Events\CustomerUserCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as AuthMustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;


class CustomerUser extends Authenticatable implements AuthMustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, MustVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => Registered::class,
    ];

    //TODO: narazie zakladam ze jeden uzytkownik bedzie mial jednego kontrahenta
    public function contractors(): BelongsToMany
    {
        return $this->belongsToMany(Contractor::class, 'contractor_customer_user', 'customer_user_id', 'logo');
    }

    public static function createAndAddContractor(string $name, string $email, string $password, string $logo): self
    {
        $customer_user = self::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        $customer_user->contractors()->attach($logo);

        return $customer_user;
    }

    public function returnm(): HasOne
    {
        return $this->hasOne(Returnm::class);
    }
}
