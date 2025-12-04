<?php
namespace Database\Seeders;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        ProductImage::create([
        'product_id'=>1,
        'image_path'=>'gaming-laptop-loq.png',
        ]);
        ProductImage::create([
        'product_id'=>2,
        'image_path'=>'gaming-laptop-asus-rog.png',
        ]);
        ProductImage::create([
        'product_id'=>3,
        'image_path'=>'zenbook-x200.png',
        ]);
        ProductImage::create([
        'product_id'=>4,
        'image_path'=>'zenbook-y200.png',
        ]);
        ProductImage::create([
        'product_id'=>5,
        'image_path'=>'vivobook-flip-14.png',
        ]);
        ProductImage::create([
        'product_id'=>6,
        'image_path'=>'travelmate-2-in-1-laptop-pro.png',
        ]);
        ProductImage::create([
        'product_id'=>7,
        'image_path'=>'mechanical-keyboard-mk100.png',
        ]);
        ProductImage::create([
        'product_id'=>8,
        'image_path'=>'mouse-razer-deathadder.png',
        ]);
        ProductImage::create([
        'product_id'=>9,
        'image_path'=>'vga-card-rtx-3080.png',
        ]);
        ProductImage::create([
        'product_id'=>10,
        'image_path'=>'vga-card-rtx-5080.png',
        ]);
    }
}