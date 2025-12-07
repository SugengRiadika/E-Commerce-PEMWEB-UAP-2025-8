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
        $latestProducts = Product::with('store')->latest()->take(6)->get();

        // 4 toko terbaru
        $latestStores = Store::latest()->take(4)->get();

        return view('member.dashboard', compact(
            'categories',
            'latestProducts',
            'latestStores'
        ));
    }
}
