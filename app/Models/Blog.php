<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title','body','slug','feature_image','post_image'];

    public function commnent(){
        return $this->hasMany(Commnent::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
