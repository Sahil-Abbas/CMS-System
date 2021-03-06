<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title','body','slug','feature_img','post_img'];


    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsToMany(Category::class)/*->withPivot(['category_id','blog_id'])*/;
    }

    public function commnent(){
        return $this->hasMany(Commnent::class);
    }
}
