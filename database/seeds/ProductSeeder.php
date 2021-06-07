<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(['name' => 'Lego 1', 'category' => 0, 'description' => 'Esto es la descripcion lego 1', 'price' => 10.02, 'image' => 'lego1.jpeg','rating'=>2, 'stock' => 1]);
        DB::table('products')->insert(['name' => 'Lego 2', 'category' => 1, 'description' => 'Esto es la descripcion lego 2', 'price' => 20.02, 'image' => 'lego2.jpeg','rating'=>1, 'stock' => 2]);
        DB::table('products')->insert(['name' => 'Lego 3', 'category' => 1, 'description' => 'Esto es la descripcion lego 3', 'price' => 10.02, 'image' => 'lego3.jpeg','rating'=>1, 'stock' => 3]);
        DB::table('products')->insert(['name' => 'Lego 4', 'category' => 2, 'description' => 'Esto es la descripcion lego 4', 'price' => 5.02, 'image' => 'lego4.jpeg','rating'=>4, 'stock' => 4]);
    }
}
