<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Stylelist;
use App\Events\ReviewCreated\ReviewCreated;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'stylelist_id',
        'reservation_id',
        'content',
        'star',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function stylelist()
    {
        return $this->belongsTo(Stylelist::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
