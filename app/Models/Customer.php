<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Item;
use App\Models\Purchase;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'username', 'kana', 'tel', 'email', 'password', 'postcode', 'address', 'birthday', 'gender', 'usermemo'
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
    ];

    public function scopeSearchCustomers($query, $input = null)
    {
        if (!empty($input)) {
            return $query->where(function ($query) use ($input) {
                $query->where('username', 'like', $input . '%')
                    ->orWhere('kana', 'like', $input . '%')
                    ->orWhere('tel', 'like', $input . '%');
            });
        }
    }

    public function item(): HasMany
    {
        return $this->hasMany(Item::class);
    }


    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }
}
