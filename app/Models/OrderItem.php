<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_item'; 

    // Attributes that can be filled
    protected $fillable=[
        'order_id',
        'product_id',
        'price',
        'quantity'
    ];

    //Relationship with orders
    public function order(){
        return $this->belongsTo(Order::class);
    }

    //Relationship with products
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
