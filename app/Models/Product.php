<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','image','price','rating', 'stock'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function scopeFilter(Builder $query, $search)
    {
        $query->where('name','like',"%" . $search . "%");
    }
}
