<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\Subtotal;

class Order extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new Subtotal);
        // 그걸 모델에다가 가져와서 이렇게 사용함 
    }


    public function scopeSearch($query, $input = null)
    {
        if (!empty($input)) {
            if (Order::where('customer_name', 'like', $input . '%')) {
                return $query->where('customer_name', 'like', $input . '%');
            }
        }
    }
}
