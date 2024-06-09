<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'status', 'total_amount', 'id_address', 'billing_address', 'payment_status'
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
