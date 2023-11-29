<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stylelist;
use App\Models\Customer;

class Reservation extends Model
{
    use HasFactory;


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function stylelist()
    {
        return $this->belongsTo(Stylelist::class);
    }
}
