<?php

use App\Address;
use App\Profile;
use App\ProfileHasAddresses;
use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {


        User::create([
            'name'=>'FranciscoY',
            'email'=>'Francisco@gmail.com',
            'password'=>bcrypt('12341234'),
            'active'=>'1'
            ])->assignRole('admin')->profile()->create([
                'name_profile' => 'Francisco',
                'primary_phone' => '7442134212',
                'secondary_phone' => '',
                'gender' => 'M',
            ])->Addresses()->create([
                'street_name' => 'Holis',
                'number_home' => '24',
                'postal_code' => '39407',
                'state' => 'Holis',
                'city' => 'Holis',
                'suburb' => 'Holis',
                'references' => 'Holis',
            ]);

        User::create([
            'name'=>'JavierX',
            'email'=>'Javier@gmail.com',
            'password'=>bcrypt('12341234'),
            'active'=>'1'
            ])->assignRole('admin')->profile()->create([
                'name_profile' => 'Javier',
                'primary_phone' => '7442134214',
                'secondary_phone' => '',
                'gender' => 'M',
            ])->Addresses()->create([
                'street_name' => 'Holis',
                'number_home' => '24',
                'postal_code' => '39407',
                'state' => 'Holis',
                'city' => 'Holis',
                'suburb' => 'Holis',
                'references' => 'Holis',
            ]);

        User::create([
            'name'=>'Gabriel',
            'email'=>'gabo@gmail.com',
            'password'=>bcrypt('12341234'),
            'active'=>'1'
            ])->assignRole('seller')->profile()->create([
                'name_profile' => 'Gabriel Noveron',
                'primary_phone' => '7442134211',
                'secondary_phone' => '',
                'gender' => 'M',
            ])->Addresses()->create([
                'street_name' => 'Holis',
                'number_home' => '24',
                'postal_code' => '39407',
                'state' => 'Holis',
                'city' => 'Holis',
                'suburb' => 'Holis',
                'references' => 'Holis',
            ]);

        User::create([
            'name'=>'Po',
            'email'=>'po@gmail.com',
            'password'=>bcrypt('12341234'),
            'active'=>'1'
            ])->assignRole('buyer')->profile()->create([
                'name_profile' => 'Fernando Torreblanca',
                'primary_phone' => '7442134219',
                'secondary_phone' => '',
                'gender' => 'M',
            ])->Addresses()->create([
                'street_name' => 'Holis',
                'number_home' => '24',
                'postal_code' => '39407',
                'state' => 'Holis',
                'city' => 'Holis',
                'suburb' => 'Holis',
                'references' => 'Holis',
            ]);

        User::create([
            'name'=>'LobatoZ',
            'email'=>'lobato@gmail.com',
            'password'=>bcrypt('12341234'),
            'active'=>'1'
            ])->assignRole('admin')->profile()->create([
                'name_profile' => 'Cuahutémoc Lobato',
                'primary_phone' => '7442134215',
                'secondary_phone' => '',
                'gender' => 'M',
            ])->Addresses()->create([
                'street_name' => 'Holis',
                'number_home' => '24',
                'postal_code' => '39407',
                'state' => 'Holis',
                'city' => 'Holis',
                'suburb' => 'Holis',
                'references' => 'Holis',
            ]);

        User::create([
            'name'=>'Gabo',
            'email'=>'gabo2@gmail.com',
            'password'=>bcrypt('12341234'),
            'active'=>'1'
            ])->assignRole('seller')->profile()->create([
                'name_profile' => 'Gabito69',
                'primary_phone' => '7442134213',
                'secondary_phone' => '',
                'gender' => 'M',
            ])->Addresses()->create([
                'street_name' => 'Holis',
                'number_home' => '24',
                'postal_code' => '39407',
                'state' => 'Holis',
                'city' => 'Holis',
                'suburb' => 'Holis',
                'references' => 'Holis',
            ]);
    }
}
