<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'kana', 'tel', 'email', 'postcode', 'address', 'birthday', 'gender', 'usermemo'
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


    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }
}
