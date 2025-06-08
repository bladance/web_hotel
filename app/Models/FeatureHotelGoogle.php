<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureHotelGoogle extends Model
{
    protected $table = 'feature_hotel_google';
    protected $fillable = [
        'id_hotel',
        'id_feature',
        'date_extraction_meta',
        'date_update_meta',
    ];
}
