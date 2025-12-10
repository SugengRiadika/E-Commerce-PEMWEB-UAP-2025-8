<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Store;

class MemberController extends Controller
{
    public function index()
    {
        // Semua kategori
        $categories = ProductCategory::all();
        // 4 produk terbaru
        $search = request('search'); // ambil query dari input search
        $latestProducts = Product::with('store', 'productCategory')->latest()->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        })->take(6)->get();

        // 4 toko terbaru
        $latestStores = Store::latest()->where('is_verified', operator: true)->take(4)->get();

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
        $latestProducts = Product::with('store', 'productCategory')->latest()->limit(4)->get();
        return view('welcome', compact('latestProducts'));
    }
    public function getProduct($id)
    {
        $product = Product::with(['store', 'productCategory'])
            ->findOrFail($id);

        return view('member.product', compact('product'));
    }
    public function getStore()
    {
        $store = Store::with(['Product']);

        return view('member.store', compact('store'));
    }
    public function getTopup()
    {
        $transactions = Transaction::where('buyer_id', Auth::id())->get();
        return view('member.topup', compact('transactions'));
    }
    public function createTopup()
    {
        return view('member.topupprocess');
    }

    public function postStore(Request $request)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'about'       => 'required|string',
        'logo'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'phone'       => 'required|string|max:20',
        'city'        => 'required|string|max:100',
        'address'     => 'required|string',
        'postal_code' => 'required|string|max:10',
    ]);
    $logoName = null;
        if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $logoName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('logo'), $logoName);    }

    Store::create([
        'user_id'     => auth()->id(),    // otomatis dari user login
        'name'        => $request->name,
        'about'       => $request->about,
        'phone'       => $request->phone,
        'city'        => $request->city,
        'address'     => $request->address,
        'logo'        => $logoName,
        'postal_code' => $request->postal_code,
        'is_verified' => 0,               
    ]);

    return redirect()->route('member.store')->with('success', 'Toko berhasil didaftarkan!');
}
    public function createProduct()
    {
        return view('member.productcreate');
    }
    public function checkout(Request $request, $id)
    {
        $inputQuantity = $request->query('quantity');
        $product = Product::with(['store', 'productCategory'])->findOrFail($id);
        return view('member.checkout', compact('product', 'inputQuantity'));
    }

    public function checkoutProduct(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($id);
        $quantity = $request->quantity;
        $totalPrice = ($product->price * $request->quantity) + (2);
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'store_id' => $product->store_id,
            'grand_total' => $totalPrice,
            'payment_status' => 'paid',
        ]);
        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'qty' => $request->quantity,
            'subtotal' => $totalPrice
        ]);
        $product->decrement('stock', $request->quantity);

        return redirect()->route('member.dashboard')
            ->with([
                'success' => 'Checkout berhasil!',
                'quantity' => $quantity
            ]);


    }
    public function showStore($id)
{
    // 1. Ambil data toko berdasarkan ID
    // Pastikan relasi di model Store namanya 'Product' (sesuai kodingan Anda sebelumnya)
    $store = Store::with(['Product'])->findOrFail($id);

    // 2. Hitung jumlah produk (opsional, untuk statistik)
    $totalProducts = $store->Product->count();

    // 3. Panggil view 'dstore' yang ada di folder 'member'
    // PERUBAHAN UTAMA ADA DI SINI:
    return view('member.dstore', compact('store', 'totalProducts'));
}
}