<?php

use App\Product;
use App\Promotion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class PromoProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $productsId = Promotion::pluck('products_id');
        $discount = Promotion::pluck('discount');

        $nvProductsId = $productsId->toArray();
        $nvdiscount = $discount->toArray();

        $totalProducts = Product::pluck('id');
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->select('users.*', 'model_has_roles.model_id', 'model_has_roles.role_id')
            ->where('model_has_roles.role_id', '=', 2)
            ->pluck('id');
        $vendedores = $users->toArray();
        

        for ($i=0; $i < count($nvProductsId); $i++) { 
            $price = Product::where('id',$nvProductsId[$i])->value('price');
            $discount =doubleval($nvdiscount[$i]);
            $newPrice = $price - ($price * ($discount/100));
            
            Product::where('id',$nvProductsId[$i])->update([
                'promotion_id' => $i+1,
                'new_price' => $newPrice
            ]);
        }

        for ($j=0; $j < count($totalProducts); $j++) { 
            Product::where('id',$totalProducts[$j])->update([
                'user_id' => $faker->randomElement($array = $vendedores)
            ]);
        }
    }
}
