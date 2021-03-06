<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $guarded = [];

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
