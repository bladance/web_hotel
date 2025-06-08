<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Synonym extends Model
{
    protected $table = 'synonym';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'id_keyword'
    ];

    public function keyword()
    {
        return $this->belongsTo(Keyword::class, 'id_keyword');
    }
}
