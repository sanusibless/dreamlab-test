<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','product_id','product_name','price', 'quantity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product() 
    {
        return $this->hasMany(Product::class);
    }

    public function scopeInCart(Builder $query, $product_id) {
        $query->where('user_id', auth()->user()->id)->where('product_id',$product_id);
    }
}
