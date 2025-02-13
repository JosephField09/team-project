<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; 

    //All of the attributes that can be filled
    protected $fillable=[
        'status',
        'total_cost',
        'user_id',
        'delivery_id',
    ];

    //Relationship with the user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relationship with delivery
    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }

    //Relationship with the order items table
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
