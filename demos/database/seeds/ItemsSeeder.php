<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'item_code' => rand(0, 1000),
            'name' => 'Foreman Grill',
            'description' => 'Charcoal grill',
            'updated_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('items')->insert([
            'item_code' => rand(0, 1000),
            'name' => 'Arrachera',
            'description' => 'Meat',
            'updated_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('items')->insert([
            'item_code' => rand(0, 1000),
            'name' => 'Soccer ball',
            'description' => 'Soccer ball',
            'updated_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
