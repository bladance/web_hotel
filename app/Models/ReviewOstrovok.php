<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ReviewOstrovok extends Model
{
    protected $table = 'review_ostrovok';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'positive_content',
        'negative_content',
        'date_publication',
        'rating',
        'rating_text',
        'reviewer_name',
        'id_hotel',
        'trip_type',
        'room_type',
        'date_extraction_meta',
        'date_update_meta',
        'tonality',
        'content_hash'
    ];

    public function keywords(): BelongsToMany
    {
        return $this->belongsToMany(Keyword::class, 'review_keyword_ostrovok', 'id_review', 'id_keyword');
    }
}
