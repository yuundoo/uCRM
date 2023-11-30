<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Stylelist;
use App\Models\Reservation;
use App\Models\Order;


class Item extends Model
{
    protected $fillable = [
        'name',
        'memo',
        'price',
        'is_selling'
    ];


    public function customers(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class)
            ->withPivot('quantity');
    }

    public function stylelists()
    {
        return $this->hasMany(Stylelist::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
