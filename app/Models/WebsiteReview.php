<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebsiteReview extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'rating',
        'title',
        'message',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
