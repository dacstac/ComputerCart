<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
        'id',
        'name',
        'subcategory',
    ];

    public $timestamps = false;

    public function users(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
