<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function productsByCategory($categoryId)
    {
        $category = Category::find($categoryId);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $products = $category->products;
        return response()->json($products);
    }
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }


    public function productsByCategoryAndSubcategory($categoryId, $subcategoryId)
    {
        // العثور على الفئة الرئيسية
        $category = Category::find($categoryId);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // العثور على الفئة الجزئية داخل الفئة الرئيسية
        $subcategory = Subcategory::where('category_id', $categoryId)
                                  ->where('id', $subcategoryId)
                                  ->first();
        if (!$subcategory) {
            return response()->json(['message' => 'Subcategory not found'], 404);
        }

        // جلب المنتجات المتعلقة بالفئة الجزئية
        $products = $subcategory->products;
        return response()->json($products);
    }
    
}
