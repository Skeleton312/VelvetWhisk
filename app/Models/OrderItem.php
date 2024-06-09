<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'orders_items';

    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price', 'subtotal'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];
    public $timestamps = false;
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
