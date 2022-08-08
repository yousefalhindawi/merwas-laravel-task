<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Sub_category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public function sub_categories(){
        return $this->hasMany(Sub_category::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
