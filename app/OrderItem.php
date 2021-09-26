<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderItem extends Model
{
    protected $guarded = [];
    protected $with = ["orderItemContent"];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function orderItemContent(): HasMany
    {
        return $this->hasMany(OrderItemContent::class);
    }
}
