<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalRating extends Model
{
    protected $table = 'additional_rating';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'date_extraction_meta', 'date_update_meta'];
}
