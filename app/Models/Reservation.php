<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stylelist;
use App\Models\Customer;
use App\Models\Item;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'stylelist_id',
        'item_id',
        'date',
        'time',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function stylelist()
    {
        return $this->belongsTo(Stylelist::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function scopeSearch($query, $term)
    {
        if ($term === '') {
            return $query;
        }

        return $query->whereHas('customer', function ($query) use ($term) {
            $query->where('username', 'like', '%' . $term . '%');
        });
    }
}
