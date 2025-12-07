<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Models\Transaction;
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

        return back()->with('success', 'Toko berhasil diverifikasi!');
    }

    public function rejectStore($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

        return back()->with('success', 'Toko berhasil direject dan dihapus!');
    }

     public function manage()
    {
                $totalPendingStores = Store::where('is_verified', false)->count();

        $search = request('search'); // ambil query dari input search
        $users = User::with('store')
            ->where('role', '!=', 'admin')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(10);           
        return view('admin.users', compact( 'search','users' ,'totalPendingStores'));
    }
    public function verifikasi()
    {
        $pendingStores = Store::where('is_verified', false)->get();
        $totalPendingStores = Store::where('is_verified', false)->count();
        $search = request('search'); // ambil query dari input search
         $pendingStoresData = Store::with('user')
            ->where('is_verified', false)
            ->latest()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('city', 'LIKE', "%{$search}%");
                });
            })
        ->take(10) // tetap batasi 5 hasil
        ->get();           
        return view('admin.verifikasi', compact( 'search','pendingStores' ,'totalPendingStores', 'pendingStoresData'));
    }
    public function toko()
    {
        $totalPendingStores = Store::where('is_verified', false)->count();
        $search = request('search'); // ambil query dari input search
        $storeGets = Store::with('user')->where('is_verified', true)->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('city', 'LIKE', "%{$search}%");
                });
            })->paginate(10);           
        return view('admin.stores', compact('totalPendingStores', 'search', 'storeGets'));
    }
}
