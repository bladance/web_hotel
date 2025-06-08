<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelGoogle extends Model
{
    protected $table = 'hotel_google';
    protected $fillable = [
        'link',
        'name',
        'location',
        'photo',
        'rating',
        'date_extraction_meta',
        'date_update_meta',
        'check_in_time',
        'check_out_time',
        'additional',
        'stars',
        'phone_number',
        'rating_text',
        'official_site',
        'description',
        'latitude',
        'longitude',
        'unified_name',
    ];
}
