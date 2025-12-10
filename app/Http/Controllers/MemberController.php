<?php

namespace App\Http\Controllers;
use App\Models\StoreBalance;
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
    public function updateTopup(Request $request)
    {
        $transactions = Transaction::where('buyer_id', Auth::id())->first();

        $request->validate([
            'grand_total' => 'required|numeric|min:1000',
        ]);

        $grandTotal = $request->grand_total / 1000;

        // Update saldo
        $transactions->update([
            'grand_total' => $grandTotal + $transactions->grand_total,
        ]);
        return redirect()->route('member.topup')->with('success', 'Anda berhasil TopUp!');
    }

    public function postStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'about' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'address' => 'required|string',
            'postal_code' => 'required|string|max:10',
        ]);
        $logoName = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $logoName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('logo'), $logoName);
        }

        Store::create([
            'user_id' => auth()->id(),    // otomatis dari user login
            'name' => $request->name,
            'about' => $request->about,
            'phone' => $request->phone,
            'city' => $request->city,
            'address' => $request->address,
            'logo' => $logoName,
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
        $transaction = Transaction::where('buyer_id', Auth::id())->get()->first();
        $inputQuantity = $request->query('quantity');
        $product = Product::with(['store', 'productCategory'])->findOrFail($id);
        return view('member.checkout', compact('product', 'inputQuantity', 'transaction'));
    }

    public function checkoutProduct(Request $request, $id)
    {

        $buyerSaldo = Transaction::where('buyer_id', Auth::id())->first();

        $request->validate([
            'stock' => 'required|integer|min:1',
            'postal_code' => 'required|string|max:10',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
        ]);
        $product = Product::findOrFail($id);
        $quantity = $request->stock;
        $totalPrice = ($product->price * $quantity) + 2;
        $transaction = Transaction::create([
            'buyer_id' => Auth::id(),
            'store_id' => $product->store_id,
            'grand_total' => $totalPrice,
            'payment_status' => 'paid',
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'code' => 'TRX' . strtoupper(uniqid()),
            'total_amount' => 0,
            'address_id' => '-',
            'shipping' => '-',
            'shipping_type' => '-',
            'shipping_cost' => 0,
            'tracking_number' => null,
            'tax' => 2,
        ]);

        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'qty' => $quantity,
            'subtotal' => $totalPrice
        ]);

        $buyerSaldo->update([
            'grand_total' => $buyerSaldo->grand_total - $totalPrice
        ]);

        $storeBalance = StoreBalance::firstOrCreate(
            ['store_id' => $product->store_id],
            ['balance' => 0]
        );

        $storeBalance->increment('balance', $totalPrice - 2);
        $product->decrement('stock', $quantity);

        return redirect()->route('member.dashboard')
            ->with([
                'success' => 'Checkout berhasil!',
                'quantity' => $quantity
            ]);


    }
    public function showStore(Request $request, $id)
    {
        // 1. Ambil data toko
        $store = Store::findOrFail($id);

        // 2. Ambil Kategori yang HANYA dimiliki oleh produk di toko ini + Hitung jumlah produk per kategori
        $categories = ProductCategory::whereHas('products', function ($query) use ($id) {
            $query->where('store_id', $id);
        })->withCount([
                    'products' => function ($query) use ($id) {
                        $query->where('store_id', $id);
                    }
                ])->get();

        // 3. Siapkan query produk dasar (milik toko ini)
        $productsQuery = Product::where('store_id', $id);

        // 4. Cek apakah ada filter kategori dari sidebar?
        if ($request->has('category')) {
            $productsQuery->where('product_category_id', $request->query('category'));
        }

        // 5. Cek apakah ada pencarian nama produk?
        if ($request->has('search')) {
            $productsQuery->where('name', 'like', '%' . $request->query('search') . '%');
        }

        // 6. Eksekusi query produk
        $products = $productsQuery->get();

        // 7. Hitung total semua produk toko (untuk badge "Semua Produk")
        $totalProducts = Product::where('store_id', $id)->count();

        // Kirim semua variabel ke view 'member.dstore'
        return view('member.dstore', compact('store', 'categories', 'products', 'totalProducts'));
    }
}