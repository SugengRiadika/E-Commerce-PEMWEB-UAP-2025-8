<?php
namespace Database\Seeders;
use App\Models\Store;
use App\Models\StoreBalance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class StoreSeeder extends Seeder
{
    public function run(): void
    {
        Store::create([
            'logo'=>'galaxy-solusindo.png',
            'user_id' => 3,
            'name' => 'Galaxy Solusindo Store',
            'about'=> 'We provide the best electronic products.',
            'phone'=> '081234567890',
            'address_id'=> 1,
            'city'=> 'Malang',
            'address'=> 'Jl. Gajayana No.123',
            'postal_code'=> '65111',
            'is_verified'=> true,
        ]);
        Store::create([
            'logo'=>'Ilmi-Tech-Store.png',
            'user_id' => 6,
            'name' => 'Ilmi Tech Store',
            'about'=> 'We provide the best electronic products.',
            'phone'=> '081234567811',
            'address_id'=> 2,
            'city'=> 'Malang',
            'address'=> 'Jl. Veteran No.123',
            'postal_code'=> '65121',
            'is_verified'=> false,
        ]);
        Store::create([
            'logo'=>'GandiStore.png',
            'user_id' => 12,
            'name' => 'Gandi Store',
            'about'=> 'We provide the best electronic products.',
            'phone'=> '0812444567890',
            'address_id'=> 3,
            'city'=> 'Malang',
            'address'=> 'Jl. SukaBumi No.123',
            'postal_code'=> '65211',
            'is_verified'=> false,
        ]);
        StoreBalance::create([
                'store_id' => 1,
                'balance' => 0, // user belum punya store → wajib NULL
            ]);
            StoreBalance::create([
                'store_id' =>2,
                'balance' => 0, // user belum punya store → wajib NULL
            ]);
            StoreBalance::create([
                'store_id' => 3,
                'balance' => 0, // user belum punya store → wajib NULL
            ]);
    }
}