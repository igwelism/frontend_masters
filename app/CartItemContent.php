<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItemContent extends Model
{
    protected $guarded = [];

    public function cartItem(): BelongsTo
    {
        return $this->belongsTo(CartItem::class);
    }
}
