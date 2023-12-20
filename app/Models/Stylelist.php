<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Stylelist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'profile_image',
        'description',
        'review_count',
        'average_rating',
        'tags', // 태그는 JSON 형식으로 저장되므로, 모델에서도 이를 처리할 수 있어야 합니다.
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tags' => 'array', // tags 컬럼을 배열로 캐스팅합니다.
        'average_rating' => 'float', // 평균 평점을 float으로 캐스팅합니다.
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
