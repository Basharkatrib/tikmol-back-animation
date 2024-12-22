<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }
    public function getSubcategories(Category $category)
    {
        // تحميل الفئات الجزئية المرتبطة بالفئة المحددة
        $subcategories = $category->subcategories;

        // إرجاع البيانات كـ JSON
        return response()->json($subcategories);
    }
}
