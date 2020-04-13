<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ContractsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendor = DB::table('vendors')->where('name', '=', 'P&G')->value('id');
        DB::table('contracts')->insert([
            'contract_num' => rand(0, 100),
            'vendor_id' => $vendor,
            'description' => Str::random(10),
            'budget' => rand(0, 50000),
            'num_demos' => rand(0, 100),
            'num_endcaps' => rand(0,100),
            'start_at' => Carbon::now()->toDateString(),
            'end_at' => Carbon::now()->addMonths(6),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('contracts')->insert([
            'contract_num' => rand(0, 100),
            'vendor_id' => $vendor,
            'description' => Str::random(10),
            'budget' => rand(0, 50000),
            'num_demos' => rand(0, 100),
            'num_endcaps' => rand(0,100),
            'start_at' => Carbon::now()->toDateString(),
            'end_at' => Carbon::now()->addMonths(6),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        $vendor = DB::table('vendors')->where('name', '=', 'Kellogs')->value('id');
        DB::table('contracts')->insert([
            'contract_num' => rand(0, 100),
            'vendor_id' => $vendor,
            'description' => Str::random(10),
            'budget' => rand(0, 50000),
            'num_demos' => rand(0, 100),
            'num_endcaps' => rand(0,100),
            'start_at' => Carbon::now()->toDateString(),
            'end_at' => Carbon::now()->addMonths(6),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('contracts')->insert([
            'contract_num' => rand(0, 100),
            'vendor_id' => $vendor,
            'description' => Str::random(10),
            'budget' => rand(0, 50000),
            'num_demos' => rand(0, 100),
            'num_endcaps' => rand(0,100),
            'start_at' => Carbon::now()->toDateString(),
            'end_at' => Carbon::now()->addMonths(6),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        $vendor = DB::table('vendors')->where('name', '=', 'Kirkland')->value('id');
        DB::table('contracts')->insert([
            'contract_num' => rand(0, 100),
            'vendor_id' => $vendor,
            'description' => Str::random(10),
            'budget' => rand(0, 50000),
            'num_demos' => rand(0, 100),
            'num_endcaps' => rand(0,100),
            'start_at' => Carbon::now()->toDateString(),
            'end_at' => Carbon::now()->addMonths(6),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('contracts')->insert([
            'contract_num' => rand(0, 100),
            'vendor_id' => $vendor,
            'description' => Str::random(10),
            'budget' => rand(0, 50000),
            'num_demos' => rand(0, 100),
            'num_endcaps' => rand(0,100),
            'start_at' => Carbon::now()->toDateString(),
            'end_at' => Carbon::now()->addMonths(6),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
