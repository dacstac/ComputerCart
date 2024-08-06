<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $table = "addresses";

    protected $fillable = [
        'id',
        'address_line1',
        'address_line2',
        'postal_code',
        'city',
        'state',
        'country',
        'user_id',
    ];

    public $timestamps = false;

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
