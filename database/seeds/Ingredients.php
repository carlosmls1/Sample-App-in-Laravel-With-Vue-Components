<?php

use Illuminate\Database\Seeder;

class Ingredients extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredients')->insert([
            'name' =>'tomato',
            'qty' => 5,
        ]);
        DB::table('ingredients')->insert([
            'name' =>'cheese',
            'qty' => 5,
        ]);
        DB::table('ingredients')->insert([
            'name' =>'lemon',
            'qty' => 5,
        ]);
        DB::table('ingredients')->insert([
            'name' =>'onion',
            'qty' => 5,
        ]);
        DB::table('ingredients')->insert([
            'name' =>'potato',
            'qty' => 5,
        ]);
        DB::table('ingredients')->insert([
            'name' =>'rice',
            'qty' => 5,
        ]);
        DB::table('ingredients')->insert([
            'name' =>'lettuce',
            'qty' => 5,
        ]);
        DB::table('ingredients')->insert([
            'name' =>'ketchup',
            'qty' => 5,
        ]);
        DB::table('ingredients')->insert([
            'name' =>'chicken',
            'qty' => 5,
        ]);
        DB::table('ingredients')->insert([
            'name' =>'meat',
            'qty' => 5,
        ]);
    }
}
