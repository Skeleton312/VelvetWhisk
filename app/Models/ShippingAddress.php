<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;
    protected $table = 'shipping_address';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'id_alamat';

    // Specify the fillable fields
    protected $fillable = ['id_user','patokan', 'jalan', 'kecamatan', 'kabupaten','provinsi', 'kode_pos', 'penerima', 'status'];

    // If the primary key is not an incrementing integer, specify its type
    public $incrementing = True;
    public $timestamps = false;
}
