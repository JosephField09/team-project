<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Product extends Model
{
    use HasFactory; 

    // Name of Table products
    protected $table = 'products'; 
    
    // Fields that can be filled 
    protected $fillable = ['name','image', 'description','price','size','stock','category_id',];

    
    public function category() {
        return $this->belongsTo(Category::class);
    } 

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
}
