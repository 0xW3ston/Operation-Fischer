<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "status"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cartArticles(){
        return $this->hasMany(Cart_Item::class);
    }

    public function articles()
    {
        return $this->hasManyThrough(Article::class, Cart_Item::class, 'article_id', 'id' );
    }
}
