<?php

namespace App\Services;

use App\Models\Review;

class ReviewService
{
    public function listReviews()
    {
        return Review::with(['customer', 'stylelist', 'reservation'])->get();
    }
}
