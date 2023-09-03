<?php

namespace B2BPanel\SharedModels;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CustomerUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function contractors(): BelongsToMany
    {
        return $this->belongsToMany(Contractor::class, 'contractor_customer_user', 'customer_user_id', 'logo');
    }

    public static function createAndAddContractor(string $name, string $email, string $password, string $logo): self
    {
        $customer_user =  self::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        $customer_user->contractors()->attach($logo);

        return $customer_user;
    }
}