<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalRatingHotelGoogle extends Model
{
    protected $table = 'additional_rating_hotel_google';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_additional_rating',
        'id_hotel',
        'rating',
        'date_extraction_meta',
        'date_update_meta',
    ];
}
