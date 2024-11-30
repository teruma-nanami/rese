<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'post_code',
        'address',
        'phone_number',
        'image_url',
        'email',
        'area_id',
        'cuisine_type_id',
        'detail',
        'owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function cuisineType()
    {
        return $this->belongsTo(CuisineType::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
