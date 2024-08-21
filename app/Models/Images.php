<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Images extends Model
{
    protected $table = "images";

    protected $fillable = [
        'id',
        'image_path',
        'products_id',
    ];

    public $timestamps = false;

    public function users(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
