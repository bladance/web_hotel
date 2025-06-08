<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewKeywordGoogle extends Model
{
    protected $table = 'review_keyword_google';
    public $timestamps = false;

    protected $fillable = [
        'id_review',
        'id_keyword',
        'tonality',
        'id_synonym',
        'context',
        'is_test',
        'id_processing',
        'date_processing'
    ];
}
