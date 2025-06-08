<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelYt extends Model
{
    protected $table = 'hotel_yt';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'link',
        'name',
        'location',
        'photo',
        'rating',
        'dist_to_sea',
        'transport_station',
        'dist_to_transport_station',
        'year_building',
        'year_reconstruction',
        'check_in_time',
        'check_out_time',
        'additional',
        'stars',
        'dist_to_center',
        'date_extraction_meta',
        'date_update_meta',
        'latitude',
        'longitude',
        'unified_name'
    ];
}
