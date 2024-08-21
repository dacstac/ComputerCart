<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'stock_quantity',
        'category_id',
    ];

    public $timestamps = false;

    public function address(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Images::class);
    }
}
