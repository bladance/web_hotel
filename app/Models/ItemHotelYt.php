<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemHotelYt extends Model
{
    protected $table = 'item_hotel_yt';
    protected $primaryKey = ['id_hotel', 'id_item'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'mentions_count',
        'id_hotel',
        'id_item',
        'date_extraction_meta',
        'date_update_meta'
    ];
}
