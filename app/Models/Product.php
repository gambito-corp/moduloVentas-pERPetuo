<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'permalink',
        'type',
        'status',
        'description',
        'sku',
        'price',
        'stock_quantity',
        'marca',
        'image',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class); // 1 producto 1 categoria
    }


    public function getImagenAttribute()
    {
        if ($this->image != null)
            return  $this->image;
        else
            return 'nimg.jpg';
    }
}
