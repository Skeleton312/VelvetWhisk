<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // Specify the table name
    protected $table = 'product';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'product_id';

    // Specify the fillable fields
    protected $fillable = ['nama', 'harga', 'deskripsi', 'kategori', 'gambar'];

    // If the primary key is not an incrementing integer, specify its type
    public $incrementing = false;
    protected $keyType = 'string';
}
