<?php
namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
        'store_id'=>1,
        'product_category_id'=>1,
        'name'=>'Gaming Laptop LOQ',
        'slug'=>'gasol-gaming-laptop-loq',
        'description'=>'A powerful gaming laptop with high-end graphics and performance.',
        'condition'=>'new',  
        'price'=>1500,
        'weight'=>2.5,
        'stock'=>10,
          ]);
        Product::create([
        'store_id'=>1,
        'product_category_id'=>1,
        'name'=>'Gaming Laptop Asus ROG',
        'slug'=>'gasol-gaming-laptop-asus-rog',
        'description'=>'A powerful gaming laptop with high-end graphics and performance.',
        'condition'=>'new',  
        'price'=>2500,
        'weight'=>2.8,
        'stock'=>5,
          ]);
        Product::create([
        'store_id'=>1,
        'product_category_id'=>2,
        'name'=>'ZenBook X200',
        'slug'=>'gasol-zenbook-x200',
        'description'=>'A sleek and lightweight ultrabook for professionals on the go.',
        'condition'=>'new',
        'price'=>1200,
        'weight'=>1.2,
        'stock'=>15,
          ]);

        Product::create([
        'store_id'=>1,
        'product_category_id'=>2,
        'name'=>'ZenBook Y200',
        'slug'=>'gasol-zenbook-y200',
        'description'=>'A sleek and lightweight ultrabook for professionals on the go.',
        'condition'=>'new',
        'price'=>1200,
        'weight'=>1.2,
        'stock'=>15,
          ]);

          Product::create([  
        'store_id'=>1,
        'product_category_id'=>3,
        'name'=>'VivoBook Flip 14',
        'slug'=>'gasol-vivobook-flip-14',
        'description'=>'A versatile 2-in-1 laptop that can be used as a tablet or laptop.',
        'condition'=>'new',
        'price'=>1300,
        'weight'=>1.5,
        'stock'=>8,
          ]);
        Product::create([  
        'store_id'=>1,
        'product_category_id'=>3,
        'name'=>'TravelMate 2-in-1 Laptop Pro',
        'slug'=>'gasol-travelmate-2-in-1-laptop-pro',
        'description'=>'A versatile 2-in-1 laptop that can be used as a tablet or laptop.',
        'condition'=>'new',
        'price'=>1300,
        'weight'=>1.5,
        'stock'=>8,
          ]);

            Product::create([
        'store_id'=>1,
        'product_category_id'=>4,
        'name'=>'Mechanical Keyboard MK100',
        'slug'=>'gasol-mechanical-keyboard-mk100',
        'description'=>'A high-quality mechanical keyboard for gaming and typing.',
        'condition'=>'new',
        'price'=>150,
        'weight'=>0.8,
        'stock'=>25,
          ]);

          Product::create([
        'store_id'=>1,
        'product_category_id'=>4,
        'name'=>'Mouse Razer DeathAdder',
        'slug'=>'gasol-mouse-razer-deathadder',
        'description'=>'A high-quality mouse Tech for gaming and typing.',
        'condition'=>'new',
        'price'=>150,
        'weight'=>0.8,
        'stock'=>25,
          ]);
            Product::create([  
        'store_id'=>1,
        'product_category_id'=>5,
        'name'=>'VGA Card RTX 3080',
        'slug'=>'gasol-vga-card-rtx-3080',
        'description'=>'A top-of-the-line VGA card for enhanced gaming performance.',
        'condition'=>'new',
        'price'=>700,
        'weight'=>1.0,
        'stock'=>5,
          ]);

           Product::create([  
        'store_id'=>1,
        'product_category_id'=>5,
        'name'=>'VGA Card RTX 5080',
        'slug'=>'gasol-vga-card-rtx-5080',
        'description'=>'A top-of-the-line VGA card for enhanced gaming performance.',
        'condition'=>'new',
        'price'=>700,
        'weight'=>1.0,
        'stock'=>5,
          ]);

        
    }
}