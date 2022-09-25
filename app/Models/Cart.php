<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'product_color_id',
        'quantity',
    ];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function ProductColor()
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id', 'id');
    }
}
