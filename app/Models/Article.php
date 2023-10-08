<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // protected $primaryKey = null;
    // public $incrementing = false;
    // public $timestamps = false;



    protected $fillable = [
        "name",
        "description",
        "price",
        "categorie_id",
        "img_path"
    ];

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }

    public function articleCarts(){
        return $this->hasMany(Cart_Item::class);
    }
}
