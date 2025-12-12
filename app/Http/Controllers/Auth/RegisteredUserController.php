<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone_number' => 'required|max:12|min:10|unique:users',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'member',
            'password' => Hash::make($request->password),
            'profile_picture' => $request->profile_picture ?? null,
            'phone_number' => $request->phone_number ?? null,
        ]);

        $paymentId = '8880' . $request->phone_number . rand(1000, 9999);

        $transaction = Transaction::create([
            'buyer_id' => $user->id,
            'code' => $paymentId,
            'store_id' => null,
            'total_amount' => 0,
            'payment_status' => 'unpaid',
            'address' => '-',
            'address_id' => '-',
            'city' => '-',
            'postal_code' => '-',
            'shipping' => '-',
            'shipping_type' => '-',
            'shipping_cost' => 0,
            'tracking_number' => null,
            'tax' => 0,
            'grand_total' => 0,
        ]);
        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat.');
    }
}
