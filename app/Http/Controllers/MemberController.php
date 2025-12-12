<?php

namespace App\Http\Controllers;

use App\Models\StoreBalance;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\ProductCategory;
use App\Models\WithDrawal;
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

        // 4 produk terbaru dengan fitur search
        $search = request('search');
        $latestProducts = Product::with('store', 'productCategory')
            ->latest()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
                });
            })->take(6)->get();

        // 4 toko terbaru (Fixed: syntax where)
        $latestStores = Store::latest()->where('is_verified', true)->take(4)->get();

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
        // Fixed: syntax where
        $latestStores = Store::latest()->where('is_verified', true)->take(4)->get();

        $categorySort = ProductCategory::where('slug', $slug)->firstOrFail();
        $products = Product::where('product_category_id', $categorySort->id)
            ->with('store')
            ->latest()
            ->paginate(10);

        return view('member.category', compact('categories', 'products', 'categorySort', 'latestStores'));
    }

    public function dashboard()
    {
        // Method ini sepertinya redundan jika dashboard utama ada di index(),
        // tapi jika ini untuk landing page guest, oke.
        $latestProducts = Product::with('store', 'productCategory')->latest()->limit(4)->get();
        return view('welcome', compact('latestProducts'));
    }

    public function getProduct($id)
    {
        $product = Product::with(['store', 'productCategory'])->findOrFail($id);
        return view('member.product', compact('product'));
    }

    public function getStore()
    {
        // Ambil data toko milik user yang login
        $store = Store::where('user_id', Auth::id())->first();

        // View 'member.store' ini yang menangani logika IF (Form vs Menunggu vs Sukses)
        return view('member.store', compact('store'));
    }

    public function sellerDashboard()
    {
        $store = Store::where('user_id', Auth::id())->firstOrFail();
        if (!$store->is_verified) {
            return redirect()->route('member.store');
        }
        $currentBalance = StoreBalance::where('store_id', $store->id)->first();
        // dd($currentBalance);
        $pendingOrders = Transaction::where('store_id', $store->id)
            ->where('shipping', 'pesanan-diproses')
            ->count();
        $totalProducts = Product::where('store_id', $store->id)->count();
        $recentOrders = $store->transactions()
            ->with('transactionDetails.product')
            ->orderBy('shipping', 'asc')
            ->latest()
            ->limit(5)
            ->get();
        return view('member.mystore', compact('store', 'currentBalance', 'pendingOrders', 'totalProducts', 'recentOrders'));
    }
    public function sellerManage()
    {
        $store = Store::where('user_id', Auth::id())->firstOrFail();
        $products = Product::where('store_id', $store->id)
            ->with('store')
            ->latest()
            ->paginate(7);
        if (!$store->is_verified) {
            return redirect()->route('member.store');
        }
        $pendingOrders = Transaction::where('store_id', $store->id)
            ->where('shipping', 'pesanan-diproses')
            ->count();
        return view('member.mystore-m', compact('pendingOrders', 'store', 'products'));
    }
    public function sellerManageProduct()
    {
        $store = Store::where('user_id', Auth::id())->firstOrFail();
        $products = Product::where('store_id', $store->id)
            ->with('store')
            ->latest()
            ->paginate(7);
        if (!$store->is_verified) {
            return redirect()->route('member.store');
        }
        $pendingOrders = Transaction::where('store_id', $store->id)
            ->where('shipping', 'pesanan-diproses')
            ->count();
        return view('member.mystore-addproduct', compact('pendingOrders', 'store', 'products'));
    }
    public function sellerManageAdd(Request $request)
    {
        $store = Store::where('user_id', Auth::id())->firstOrFail();
        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'stock' => 'required|integer|min:1',
        ]);
        $slug = Str::slug($request->name);
        dd($slug);
        $file = $request->file('image');
        $imageName = $store->name.'-'.$slug.'.' .$file->getClientOriginalExtension();
        $file->move(public_path('ImageSource'), $imageName);
        Product::create([
            'store_id' => Auth::user()->store->id,
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'condition' => 'new',
            'price' => $request->price,
            'weight' => 1,
            'stock' => $request->stock,
        ]);


        return redirect()->route('member.mystore-m')
            ->with('success', 'Produk berhasil ditambahkan!');
    }
    public function sellerManageEdit(Request $request)
    {
        $request->validate([
            // 'store_id'=> $store->id,
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'condition' => 'new',
            'price' => 'required|numeric|min:1',
            'weight' => '1',
            'stock' => 'required|integer|min:1',
        ]);

    }
    public function sellerManageDelete($id)
    {
        $products = Product::findOrFail($id);
        $products->delete();
        return redirect()->route('member.mystore-m')
            ->with('success', 'Toko berhasil dihapus.');
    }

    public function sellerOrder()
    {
        $store = Store::where('user_id', Auth::id())->firstOrFail();

        if (!$store->is_verified) {
            return redirect()->route('member.store');
        }

        $pendingOrders = Transaction::where('store_id', $store->id)
            ->where('shipping', 'pesanan-diproses')
            ->count();

        $recentOrders = $store->transactions()
            ->with('transactionDetails.product')
            ->orderBy('shipping', 'asc')
            ->latest()
            ->paginate(5);

        $status = $store->transactions()
            ->with('transactionDetails.product')
            ->orderBy('shipping', 'asc')
            ->latest()
            ->paginate(10);

        return view('member.mystore-o', compact('status', 'pendingOrders', 'store', 'recentOrders'));
    }
    public function sellerWithdraw()
    {
        
        $store = Store::where('user_id', Auth::id())->firstOrFail();
        $incomeHistory = $store->transactions()
            ->with('transactionDetails.product')
            ->orderBy('shipping', 'asc')
            ->latest()
            ->paginate(10);
        $balance = StoreBalance::where('store_id', $store->id)->first();
        if (!$store->is_verified) {
            return redirect()->route('member.store');
        }
        $pendingOrders = Transaction::where('store_id', $store->id)
        ->where('shipping', 'pesanan-diproses')
        ->count();
        $withdrawal = WithDrawal::where('store_balance_id',$balance->id)->first();
        $withdrawalall = WithDrawal::where('store_balance_id',$balance->id)->sum('amount');
       
        return view('member.mystore-w', compact('pendingOrders', 'store', 'balance', 'incomeHistory','withdrawal','withdrawalall'));
    }
public function sellerWithdrawCreate(Request $request)
{
    $store = Store::where('user_id', Auth::id())->firstOrFail();

    if (!$store->is_verified) {
        return redirect()->route('member.store');
    }

    $balance = StoreBalance::where('store_id', $store->id)->firstOrFail();

    $request->validate([
        'amount' => 'required|numeric|min:10000',
        'bank_account_name' => 'required|string|max:50',
        'bank_account_number' => 'required|string|max:15',
        'bank_name' => 'required|string|max:20',
    ]);

    // konversi ke ribuan
    $amount = $request->amount / 1000;

    // cek saldo (juga dalam ribuan)
    if ($amount > $balance->balance*1000) {
        return back()->with('error', 'Saldo tidak mencukupi untuk penarikan.');
    }

    // kurangi saldo (ribuan)
    $balance->balance -= $amount;
    $balance->save();

    // simpan withdrawal (ribuan)
    WithDrawal::create([
        'store_balance_id' => $balance->id,
        'amount' => $amount,
        'bank_account_name' => $request->bank_account_name,
        'bank_account_number' => $request->bank_account_number,
        'bank_name' => $request->bank_name,
        'status' => 'pending',
    ]);

    return redirect()
        ->route('member.mystore-w')
        ->with('success', 'Penarikan dana berhasil diajukan.');
}


    public function getTopup()
    {
        // Menampilkan history topup user
        $transactions = Transaction::where('buyer_id', Auth::id())->get();
        return view('member.topup', compact('transactions'));
    }

    public function updateTopup(Request $request)
    {
        // PERHATIAN: Menggunakan tabel Transaction sebagai "Dompet" itu berisiko jika user punya banyak transaksi.
        // Asumsi: Anda mengambil row pertama sebagai "dompet utama".
        $transactions = Transaction::where('buyer_id', Auth::id())->first();

        if (!$transactions) {
            // Handle jika user belum punya row transaksi sama sekali (User baru)
            // Anda mungkin perlu membuat row baru di sini atau redirect dengan error.
            return back()->with('error', 'Akun saldo belum diinisialisasi.');
        }

        $request->validate([
            'grand_total' => 'required|numeric|min:1000',
        ]);

        // Logic konversi (dibagi 1000?) - sesuaikan dengan kebutuhan sistem payment gateway Anda
        $grandTotal = $request->grand_total / 1000;

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
            'user_id' => auth()->id(),
            'name' => $request->name,
            'about' => $request->about,
            'phone' => $request->phone,
            'city' => $request->city,
            'address' => $request->address,
            'logo' => $logoName,
            'postal_code' => $request->postal_code,
            'is_verified' => 0, // Default belum diverifikasi
        ]);
        

        return redirect()->route('member.store')->with('success', 'Toko berhasil didaftarkan!');
    }

    public function checkout(Request $request, $id)
    {
        // Mengambil saldo user (asumsi row pertama adalah saldo)
        $transaction = Transaction::where('buyer_id', Auth::id())->first();

        $inputQuantity = $request->query('quantity', 1); // Default quantity 1 jika kosong
        $product = Product::with(['store', 'productCategory'])->findOrFail($id);

        return view('member.checkout', compact('product', 'inputQuantity', 'transaction'));
    }

    public function checkoutProduct(Request $request, $id)
    {
        // 1. Ambil Saldo Pembeli
        $buyerSaldo = Transaction::where('buyer_id', Auth::id())->first();

        // Validasi jika saldo tidak ditemukan atau kurang
        if (!$buyerSaldo) {
            return back()->with('error', 'Saldo tidak ditemukan.');
        }

        $request->validate([
            'stock' => 'required|integer|min:1',
            'postal_code' => 'required|string|max:10',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
        ]);

        $product = Product::findOrFail($id);
        $quantity = $request->stock;

        // Cek stok produk cukup atau tidak
        if ($product->stock < $quantity) {
            return back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Hitung Total (+2 mungkin biaya admin/pajak?)
        $totalPrice = ($product->price * $quantity) + 2;

        // Cek Saldo Cukup
        if ($buyerSaldo->grand_total < $totalPrice) {
            return back()->with('error', 'Saldo Anda tidak mencukupi.');
        }

        // 2. Buat Transaksi Baru (Record Pembelian)
        $transaction = Transaction::create([
            'buyer_id' => Auth::id(),
            'store_id' => $product->store_id,
            'grand_total' => $totalPrice,
            'payment_status' => 'paid',
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'code' => 'TRX' . strtoupper(uniqid()),
            'total_amount' => 0, // Field ini sepertinya tidak dipakai?
            'address_id' => '-',
            'shipping' => 'pesanan-diproses',
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

        // 3. Kurangi Saldo Pembeli
        $buyerSaldo->update([
            'grand_total' => $buyerSaldo->grand_total - $totalPrice
        ]);

        $storeBalance = StoreBalance::firstOrNew(
            ['store_id' => $product->store_id]
        );

        if (!$storeBalance->exists) {
            $storeBalance->balance = 0;
            $storeBalance->save();
        }

        // 5. Kurangi Stok Produk
        $product->decrement('stock', $quantity);

        return redirect()->route('member.dashboard')
            ->with([
                'success' => 'Checkout berhasil!',
                'quantity' => $quantity
            ]);
    }

    public function showStore(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $categories = ProductCategory::whereHas('products', function ($query) use ($id) {
            $query->where('store_id', $id);
        })->withCount([
                    'products' => function ($query) use ($id) {
                        $query->where('store_id', $id);
                    }
                ])->get();

        $productsQuery = Product::where('store_id', $id);

        if ($request->has('category')) {
            $productsQuery->where('product_category_id', $request->query('category'));
        }

        if ($request->has('search')) {
            $productsQuery->where('name', 'like', '%' . $request->query('search') . '%');
        }

        $products = $productsQuery->get();
        $totalProducts = Product::where('store_id', $id)->count();

        return view('member.dstore', compact('store', 'categories', 'products', 'totalProducts'));
    }

}