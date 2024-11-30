<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuisineType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
