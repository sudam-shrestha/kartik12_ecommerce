<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $casts = [
        "images" => "array"
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
