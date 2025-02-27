<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'delivery'; 

    //Atttributes that can be filled
    protected $fillable=[
        'address',
        'city',
        'postcode',
        'user_id'
    ];

    //Relationship with the user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relationship with orders
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
