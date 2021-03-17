<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [['prod one', 'منتج واحد'], ['prod two', 'منتج اتنين'], ['prod four', 'منتج تلاتة']];

        foreach ($products as $product) {

            Product::create([
                'category_id' => rand(1, 3),
                'en' => ['name' => $product[0], 'desc' => $product[0] . ' desc'],
                'ar' => ['name' => $product[1], 'desc' => $product[1] . ' وصف'],
                'purchase_price' => rand(80, 100),
                'sale_price' => rand(100, 150),
                'stock' => rand(150, 300),
            ]);
        }
    }
}
