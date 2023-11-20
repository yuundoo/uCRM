<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
class Item extends Model
{
    protected $fillable = [
        'name',
        'memo',
        'price',
        'is_selling'
    ];


    public function products():HasMany{
        return $this->hasMany(User::class);
    }
}
