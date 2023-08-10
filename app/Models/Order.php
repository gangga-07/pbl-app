<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    // protected $timestamps = false;
    protected $fillable = ['pembeli', 'email', 'name', 'no_tlp', 'users_id', 'category_id', 'tanggal', 'status', 'status_pengiriman', 'price', 'download_url'];

    public function user()
    {
        return $this->hasMany(User::class, 'users_id');
    }

    // Definisikan relasi dengan model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

    public function scopeFilter($query, array $filters)
    {
        // $query->when($filters['category'] ?? false, function ($query, $category) {
        //     return $query->whereHas('category', function ($query) use ($category) {
        //         $query->where('name', $category);
        //     });
        // });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('status', 'like', '%' . $search . '%')
                ->orWhere(function ($query) use ($search) {
                    $query->where('pembeli', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%');
                });
        });
    }
}
