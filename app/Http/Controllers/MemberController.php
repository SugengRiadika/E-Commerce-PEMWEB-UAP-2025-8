<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Store;

class MemberController extends Controller
{
    public function index()
    {
        // Semua kategori
        $categories = ProductCategory::all();
        // 4 produk terbaru
        $search = request('search'); // ambil query dari input search
        $latestProducts = Product::with('store','productCategory')->latest()->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('description', 'LIKE', "%{$search}%");
                    });
                })->take(6)->get();
                
                // 4 toko terbaru
        $latestStores = Store::latest()->where('is_verified', operator: true)   ->take(4)->get();
        
        return view('member.dashboard', compact(
            'categories',
            'latestProducts',
            'latestStores',
            'search'
        ));
    }
    public function sortbycategory($slug)
    {
        $categories = ProductCategory::all();
        $latestStores = Store::latest()->where('is_verified', operator: true)->take(4)->get();
        $categorySort = ProductCategory::where('slug', $slug)->firstOrFail();
        $products = Product::where('product_category_id', $categorySort->id)
            ->with('store')
            ->latest()
            ->paginate(10);
        return view('member.category', compact('categories', 'products', 'categorySort', 'latestStores'));
    }
    public function dashboard()
    {
        $latestProducts = Product::with('store','productCategory')->latest()->limit(4)->get();
        return view('welcome', compact('latestProducts'));
    }
    public function getProduct($id)
{
    $product = Product::with(['store', 'productImages', 'productCategory'])
        ->findOrFail($id);

    return view('member.product', compact('product'));
}
    
}
