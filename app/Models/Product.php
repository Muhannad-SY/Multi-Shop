<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = 
    [
     'category_id',
     'name',
     'description',
     'in_description',
     'price',
      'discount_price',
     'status',
     'stock',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order__details()
    {
        return $this->hasMany(Order_Detail::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
