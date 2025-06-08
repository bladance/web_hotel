<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facility';
    protected $fillable = [
        'name',
        'date_extraction_meta',
        'date_update_meta',
    ];
}
