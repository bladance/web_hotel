<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelOstrovok extends Model
{
    protected $table = 'hotel_ostrovok';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'link',
        'name',
        'location',
        'rating',
        'additional',
        'stars',
        'date_extraction_meta',
        'date_update_meta',
        'latitude',
        'longitude',
        'rating_text',
        'reviews_count',
        'tripadvisor_reviews_count',
        'unified_name'
    ];
}
