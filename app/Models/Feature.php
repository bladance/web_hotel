<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'feature';
    protected $fillable = [
        'name',
        'date_extraction_meta',
        'date_update_meta',
    ];
}
