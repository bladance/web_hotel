<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewerYt extends Model
{
    protected $table = 'reviewer_yt';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'link',
        'reviews_count',
        'likes_count',
        'subscribers_count',
        'subscriptions_count',
        'date_extraction_meta',
        'date_update_meta'
    ];
}
