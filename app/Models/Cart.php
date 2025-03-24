<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Cart extends Model
{
    use HasFactory; 

    // Name of Table carts
    protected $table = 'carts'; 
    
    // Fields that can be filled 
    protected $fillable = ['quantity','user_id','product_id','size'];

    
    public function user() 
    {return $this->belongsTo(User::class);}

    public function product() 
    {return $this->belongsTo(Product::class);}
}
