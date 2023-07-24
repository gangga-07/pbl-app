<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')->orWhereHas('products', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')->orWhere('product_code', '=', $search);
            });
        });
    }
}
