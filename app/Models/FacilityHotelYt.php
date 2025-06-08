<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityHotelYt extends Model
{
    protected $table = 'facility_hotel_yt';
    protected $fillable = [
        'id_facility',
        'id_hotel',
        'position',
        'visible',
        'class',
        'date_extraction_meta',
        'date_update_meta',
    ];
}
