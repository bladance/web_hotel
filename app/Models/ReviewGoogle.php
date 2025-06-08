<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ReviewGoogle extends Model
{
    protected $table = 'review_google';
    public $timestamps = false;

    protected $fillable = [
        'content',
        'date_publication',
        'id_reviewer',
        'id_hotel',
        'rating',
        'order_number',
        'date_extraction_meta',
        'date_update_meta',
        'tonality'
    ];

    public function reviewer()
    {
        return $this->belongsTo(ReviewerGoogle::class, 'id_reviewer');
    }

    public function keywords(): BelongsToMany
    {
        return $this->belongsToMany(Keyword::class, 'review_keyword_google', 'id_review', 'id_keyword');
    }
}
