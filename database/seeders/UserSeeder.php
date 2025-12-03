<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role'=> 'admin'
        ]);

        User::create([
            'name' => 'Sega Corp',
            'email' => 'sega@gmail.com',
            'password' => Hash::make('sega123'),
            'role'=> 'member'
        ]
        );
        User::create([
            'name' => 'Galaxy Solusindo',
            'email' => 'gasol@gmail.com',
            'password' => Hash::make('gasol123'),
            'role'=> 'seller'
        ]
        );
    }
}