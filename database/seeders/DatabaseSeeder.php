<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Admin::factory(5)->create();
        // Category::factory(5)->create();
        // Banner::factory(5)->create();
        // Product::factory(25)->create();
        // ProductImage::factory(100)->create();
        // ProductAttribute::factory(100)->create();
        // Contact::factory(50)->create();
        Coupon::factory(3)->create();
    }
}
