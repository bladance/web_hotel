<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemHotelGoogle extends Model
{
    protected $table = 'item_hotel_google';
    protected $primaryKey = ['id_hotel', 'id_item'];
    public $timestamps = false;

    protected $fillable = [
        'id_hotel',
        'percent_of_pos_mentions',
        'percent_of_neg_mentions',
        'mentions_count',
        'id_item',
        'date_extraction_meta',
        'date_update_meta'
    ];
}
