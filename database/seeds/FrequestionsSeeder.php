<?php

use App\Frequestions;
use Illuminate\Database\Seeder;

class FrequestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Frequestions::class,100)->create();
    }
}
