<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'old_price',
        'discount',
        'is_active',
        'image_path',
        'category_id',
        'subcategory_id', // إضافة الفئة الفرعية
    ];

    // العلاقة مع الفئة الرئيسية
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // العلاقة مع الفئة الفرعية
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
