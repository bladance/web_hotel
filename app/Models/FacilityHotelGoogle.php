<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityHotelGoogle extends Model
{
    protected $table = 'facility_hotel_google';
    protected $fillable = [
        'id_facility',
        'id_hotel',
        'position',
        'visible',
        'availability',
        'class',
        'date_extraction_meta',
        'date_update_meta',
    ];
}
