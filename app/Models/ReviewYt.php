<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ReviewYt extends Model
{
    protected $table = 'review_yt';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'content',
        'date_publication',
        'likes_count',
        'stars_count',
        'id_reviewer',
        'id_hotel',
        'dislikes_count',
        'date_extraction_meta',
        'date_update_meta',
        'tonality',
        'content_hash'
    ];

    public function reviewer()
    {
        return $this->belongsTo(ReviewerYt::class, 'id_reviewer');
    }

    public function keywords(): BelongsToMany
    {
        return $this->belongsToMany(Keyword::class, 'review_keyword_yt', 'id_review', 'id_keyword');
    }
}
