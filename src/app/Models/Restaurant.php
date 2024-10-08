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
        'area',
        'cuisine_type',
        'detail',
        'owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
