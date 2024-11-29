<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'size', 'stock', 'category_id'];

    /**
     * Relationship with the Category model.
     * Each product belongs to one category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
