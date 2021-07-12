<?php

use App\Address;
use App\Profile;
use App\ProfileHasAddresses;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) { 
            $address = Address::all();
            $profile = Profile::all();
            if(count($address) != null){
                $lastIdAddress = count($address);
            }else{$lastIdAddress = 0;}
            if(count($profile) != null){
                $lastIdProfile = count($profile);
            }else{$lastIdProfile = 0;}


            $fname = $faker->name;
            User::create([
                'name'=> $fname,
                'email'=> $faker->freeEmail,
                'password'=>bcrypt('12341234'),
                'active'=>'1'
            ])->assignRole('seller')->profile()->create([
                'name_profile' => $fname,
                'primary_phone' => $faker->numberBetween($min = 7442000000, $max = 7444399999),
                'secondary_phone' => '',
                'gender' => $faker->randomElement($array = array ('Hombre','Mujer')),
            ]);
            Address::create([
                'street_name' => $faker->streetName,
                'number_home' => $faker->buildingNumber,
                'postal_code' => $faker->numberBetween($min = 37000, $max = 39999),
                'state' => $faker->state,
                'city' => $faker->city,
                'suburb' => $faker->streetSuffix,
                'references' => $faker->streetAddress
            ]);

            ProfileHasAddresses::create([
                'address_id' => ($lastIdAddress + 1),
                'profile_id' => ($lastIdProfile + 1)
            ]);
        }
        
    }
}
