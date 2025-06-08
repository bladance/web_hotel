<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewReplyGoogle extends Model
{
    protected $table = 'review_reply_google';
    public $timestamps = false;

    protected $fillable = [
        'content',
        'date_publication',
        'id_review',
        'replier',
        'date_extraction_meta',
        'date_update_meta'
    ];
}
