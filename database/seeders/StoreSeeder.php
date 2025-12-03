<?php
namespace Database\Seeders;
use App\Models\Store;
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
    }
}