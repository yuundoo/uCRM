<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Item extends Model
{
    protected $fillable = [
        'name',
        'memo',
        'price',
        'is_selling'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
