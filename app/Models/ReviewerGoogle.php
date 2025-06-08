<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewerGoogle extends Model
{
    protected $table = 'reviewer_google';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'link',
        'reviews_count',
        'likes_count',
        'level',
        'level_text',
        'score',
        'photos_count',
        'videos_count',
        'replies_count',
        'place_changes_count',
        'added_places_count',
        'added_roads_count',
        'verified_facts_count',
        'questions_answers_count',
        'lists_count',
        'date_extraction_meta',
        'date_update_meta'
    ];
}
