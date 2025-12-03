<?php
namespace Database\Seeders;
use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        ProductCategory::create([
        'image'=>'laptop.png',
        'name'=>'Gaming Notebooks',
        'slug'=>'gaming-notebooks',
        'tagline'=>'High Performance Laptops for Gaming',
        'description'=>'Top-notch gaming laptops with powerful graphics and processors.',
        ]);
        ProductCategory::create([
        'image'=>'ultrabook.png',
        'name'=>'Ultrabooks',
        'slug'=>'ultrabooks',
        'tagline'=>'Sleek and Portable Laptops',
        'description'=>'Lightweight ultrabooks for professionals on the go.',
        ]);
        ProductCategory::create([
        'image'=>'2in1.png',
        'name'=>'2-in-1 Laptops',
        'slug'=>'2-in-1-laptops',
        'tagline'=>'Versatile Laptops and Tablets',
        'description'=>'Convertible laptops that function as both laptops and tablets.',
        ]);
        ProductCategory::create([
        'image'=>'keyboard-mouse.png',
        'name'=>'Keyboard Mouse',
        'slug'=>'keyboard-mouse',
        'tagline'=>'Accurate and Responsive Input Devices',
        'description'=>'High-quality keyboards and mice for precise control and comfort.',
        ]);
        ProductCategory::create([
        'image'=>'vga-cards.png',
        'name'=>'VGA Cards',
        'slug'=>'vga-cards',
        'tagline'=>'High-Performance Graphics Cards',
        'description'=>'Top-quality VGA cards for enhanced gaming and graphics performance.',
        ]);

        
    }
}