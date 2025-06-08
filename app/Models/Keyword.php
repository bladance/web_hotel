<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Keyword extends Model
{
    protected $table = 'keyword';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'id_parent',
        'level'
    ];

    public function googleReviews(): BelongsToMany
    {
        return $this->belongsToMany(ReviewGoogle::class, 'review_keyword_google', 'id_keyword', 'id_review');
    }

    public function ytReviews(): BelongsToMany
    {
        return $this->belongsToMany(ReviewYt::class, 'review_keyword_yt', 'id_keyword', 'id_review');
    }

    public function ostrovokReviews(): BelongsToMany
    {
        return $this->belongsToMany(ReviewOstrovok::class, 'review_keyword_ostrovok', 'id_keyword', 'id_review');
    }
}
