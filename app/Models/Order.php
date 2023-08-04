<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    // protected $timestamps = false;
    protected $fillable = ['pembeli', 'email', 'name', 'no_tlp', 'users_id', 'category_id', 'tanggal', 'status', 'status_pengiriman', 'price'];

    public function user()
    {
        return $this->hasMany(User::class, 'users_id');
    }

    // Definisikan relasi dengan model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
