<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesSeeder::class);
         $this->call(UserSeeder::class);
      //   $this->call(SellerSeeder::class);
     //    $this->call(CategoriesSeeder::class);
     //    $this->call(ProductsTableSeeder::class);
     //    $this->call(PromotionSeeder::class);
     //    $this->call(PromoProductSeeder::class);
         $this->call(FrequestionsSeeder::class);
    //     $this->call(ImagesSeeder::class);
    //     $this->call(ProductsCategoriesSeeder::class);
    //     $this->call(TrackingSeeder::class);
    }
}
