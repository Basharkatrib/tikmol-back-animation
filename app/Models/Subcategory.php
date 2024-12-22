<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'category_id'];

    // العلاقة مع الفئة الرئيسية
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // العلاقة مع المنتجات
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
