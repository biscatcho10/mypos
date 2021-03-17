<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategroyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['Clothes' , 'ملابس'],
            ['food' , 'طعام'],
            ['Cars', 'سيارات']
        ];

        foreach ($categories as $cat) {
            Category::create([
                'en' => ['name' => $cat[0]],
                'ar' => ['name' => $cat[1]],
            ]);
        }
    }
}
