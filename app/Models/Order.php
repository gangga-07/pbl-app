<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    // protected $timestamps = false;
    protected $fillable = ['pembeli', 'email', 'name', 'no_tlp', 'users_id', 'category_id', 'tanggal', 'status', 'price'];

    public function user()
    {
        return $this->hasMany(User::class, 'users_id');
    }
}
