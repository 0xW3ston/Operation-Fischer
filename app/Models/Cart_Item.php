<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_Item extends Model
{
    use HasFactory;


    protected $fillable = [
        "cart_id",
        "article_id",
        "quantity"
    ];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function article(){
        return $this->belongsTo(Article::class);
    }

}
