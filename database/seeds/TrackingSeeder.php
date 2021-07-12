<?php

use App\Tracking;
use Illuminate\Database\Seeder;

class TrackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tracking::create([
            'tracking_id'=>'123456',
            'order_id'=>'1',
            'user_id'=>'7', 
            'address_id'=>'7', 
            'status'=>'Preparando',
            ]); 

            Tracking::create([
                'tracking_id'=>'654321',
                'order_id'=>'2',
                'user_id'=>'7', 
                'address_id'=>'7', 
                'status'=>'En camino',
                ]); 

                Tracking::create([
                    'tracking_id'=>'246810',
                    'order_id'=>'3',
                    'user_id'=>'7', 
                    'address_id'=>'7', 
                    'status'=>'Entregado',
                    ]); 
    }
}
