<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'code' => rand(0, 1000),
            'name' => 'Electronics',
            'description' => 'Current electronics and store',
            'updated_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('departments')->insert([
            'code' => rand(0, 1000),
            'name' => 'Meats',
            'description' => 'Meats department',
            'updated_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('departments')->insert([
            'code' => rand(0, 1000),
            'name' => 'Garden',
            'description' => 'Garden and outside deparmtent', 
            'updated_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
