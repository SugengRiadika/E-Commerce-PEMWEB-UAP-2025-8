<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {

            if (!$user->phone_number) {
                continue;
            }

            $transactionId = '8880' . preg_replace('/\D/', '', $user->phone_number);

            Transaction::create([
                'buyer_id' => $user->id,
                'store_id' => null,
                'code' => $transactionId,
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
        }
    }
}