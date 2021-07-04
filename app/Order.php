<?php

namespace App;

use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $guarded = [];

    /**
     * @throws Exception
     */
    public function getCreatedAtAttribute($value): string
    {
        $createDate = new DateTime($value);
        return $createDate->format('Y-m-d');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
