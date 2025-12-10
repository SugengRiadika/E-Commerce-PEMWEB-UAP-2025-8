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
            'phone_number' => '0812345678',
            'role'=> 'admin'
        ]);

        User::create([
            'name' => 'Sega Corp',
            'email' => 'sega@gmail.com',
            'password' => Hash::make('sega123'),
            'phone_number' => '0812345679',
            'role'=> 'member'
        ]
        );
        User::create([
            'name' => 'Galaxy Solusindo',
            'email' => 'gasol@gmail.com',
            'password' => Hash::make('gasol123'),
            'phone_number' => '0812345680',
            'role'=> 'member'
        ]
        );
        User::create([
            'name' => 'Sugeng Riyadi',
            'email' => 'sugeng@gmail.com',
            'password' => Hash::make('sugeng123'),
            'phone_number' => '0812345681',
            'role'=> 'member'

        ]
        );
        User::create([
            'name' => 'Sayyid Ilmi',
            'email' => 'sayyid@gmail.com',
            'password' => Hash::make('sayyid123'),
            'phone_number' => '0812345682',
            'role'=> 'admin'
        ]
        );
        User::create([
            'name' => 'Ilmi Tech Store',
            'email' => 'ilmi@gmail.com',
            'password' => Hash::make('ilmi123'),
            'phone_number' => '0812345683',
            'role'=> 'member'
        ]
        );
        User::create([
            'name' => 'Rasyan von Neumann',
            'email' => 'rasyan@gmail.com',
            'password' => Hash::make('rasyan123'),
            'phone_number' => '0812345684',
            'role'=> 'member'
        ]
        );
        User::create([
            'name' => 'Misxa Aiman Neumann',
            'email' => 'misxa@gmail.com',
            'password' => Hash::make('misxa123'),
            'phone_number' => '0812345685',
            'role'=> 'member'
        ]
        );
        User::create([
            'name' => 'Msxka Ngawi',
            'email' => 'msxka@gmail.com',
            'password' => Hash::make('msxka123'),
            'phone_number' => '0812345686',
            'role'=> 'member'
        ]
        );
        User::create([
            'name' => 'SuperImpact',
            'email' => 'superimpact@gmail.com',
            'password' => Hash::make('superimpact123'),
            'phone_number' => '0812345687',
            'role'=> 'member'
        ]
        );
        User::create([
            'name' => 'Keqing Wangy',
            'email' => 'keqing@gmail.com',
            'password' => Hash::make('keqing123'),
            'phone_number' => '0812345688',
            'role'=> 'member'
        ]
        );
        User::create([
            'name' => 'GandiStore',
            'email' => 'gandistore@gmail.com',
            'password' => Hash::make('gandistore123'),
            'phone_number' => '0812345689',
            'role'=> 'member'
        ]
        );
        User::create([
            'name' => 'Asade testing',
            'email' => 'asade@gmail.com',
            'password' => Hash::make('asade123'),
            'phone_number' => '0812345690',
            'role'=> 'member'
        ]
        );
    }
}