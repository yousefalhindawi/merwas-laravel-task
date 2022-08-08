<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function Sub_category(){
        return $this->belongsTo(Sub_category::class);
    }
    public function users(){
        return $this->belongsToMany(User::class, 'orders','product_id','user_id');
    }
}

