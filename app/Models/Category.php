<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    // العلاقة مع الفئات الفرعية
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    // العلاقة مع المنتجات
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
