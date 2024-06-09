<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart'; // Specify the table name

    protected $primaryKey = 'id_cart'; // Specify the primary key

    protected $fillable = [
        'id_user', 
        'product_id', 
        'jumlah'
    ];

    public $timestamps = false;// Enable timestamps
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }    

}
