<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Carbon\this;

class Category extends Model
{
    use HasFactory;

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}