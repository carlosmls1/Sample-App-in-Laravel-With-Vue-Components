<?php

use Illuminate\Database\Seeder;

class Clients extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'name' =>'Carlos'
        ]);
        DB::table('clients')->insert([
            'name' =>'Juan'
        ]);
        DB::table('clients')->insert([
            'name' =>'Marta'
        ]);
        DB::table('clients')->insert([
            'name' =>'Abril'
        ]);
        DB::table('clients')->insert([
            'name' =>'Diana'
        ]);
    }
}
