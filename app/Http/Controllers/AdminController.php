<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\StoreBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $pendingStores = Store::where('is_verified', false)->get();
        $totalPendingStores = Store::where('is_verified', false)->count();
        $totalUsers = User::count();
        $totalTransactions = Transaction::where('payment_status', 'paid')->count();
        $totalActiveStores = Store::where('is_verified', true)->count();

        $pendingStoresData = Store::with('user')
            ->where('is_verified', false)
            ->latest()
            ->get();
        $search = request('search'); // ambil query dari input search
        $users = User::with('store')
            ->where('role', '!=', 'admin')
            ->limit(5)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%");
                });
            })

            ->take(5) // tetap batasi 5 hasil
            ->get();
        return view('admin.dashboard', compact(
            'pendingStores',
            'totalPendingStores',
            'totalUsers',
            'pendingStoresData',
            'totalActiveStores',
            'users',
            'totalTransactions',
            'search'
        ));

    }
    public function verifyStore($id)
    {
        $store = Store::findOrFail($id);
        $store->update(['is_verified' => true]);
        StoreBalance::create([
            'store_id' => $store->id,
            'balance' => 0,
        ]);
        return back()->with('success', 'Toko berhasil diverifikasi!');
    }

    public function rejectStore($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

        return back()->with('success', 'Toko berhasil direject dan dihapus!');
    }

    public function edituser($id)
    {
        $user = User::findOrFail($id);
        $totalPendingStores = Store::where('is_verified', false)->count();

        return view('admin.edit', compact('user', 'totalPendingStores'));

    }
    public function updateuser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:member,seller,admin',
            'phone_number' => 'required|string|max:20',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('admin.users', $user->id)
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroyuser($id)
    {
        $user = User::findOrFail($id);

        if ($user->store) {
            $user->store->delete();
        }

        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'User berhasil dihapus.');
    }
    public function destroystore($id)
    {
        $store = Store::findOrFail($id);

        if ($store) {
            $store->delete();
        }

        $store->delete();
        return redirect()->route('admin.stores')
            ->with('success', 'Toko berhasil dihapus.');
    }

    public function manage()
    {
        $totalPendingStores = Store::where('is_verified', false)->count();

        $search = request('search'); 
        $users = User::with('store')
            ->where('role', '!=', 'admin')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(10);
        return view('admin.users', compact('search', 'users', 'totalPendingStores'));
    }
    public function verifikasi()
    {
        $pendingStores = Store::where('is_verified', false)->get();
        $totalPendingStores = Store::where('is_verified', false)->count();
        $search = request('search');
        $pendingStoresData = Store::with('user')
            ->where('is_verified', false)
            ->latest()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('city', 'LIKE', "%{$search}%");
                });
            })
            ->take(10)
            ->get();
        return view('admin.verifikasi', compact('search', 'pendingStores', 'totalPendingStores', 'pendingStoresData'));
    }
    public function toko()
    {
        $totalPendingStores = Store::where('is_verified', false)->count();
        $search = request('search');
        $storeGets = Store::with('user')->where('is_verified', true)->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('city', 'LIKE', "%{$search}%");
            });
        })->paginate(10);
        return view('admin.stores', compact('totalPendingStores', 'search', 'storeGets'));
    }
}
