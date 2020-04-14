<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class VendorsToItems extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendor = DB::table('vendors')->where('id', '=', 1)->value('id');
        $item = DB::table('items')->where('id', '=', 1)->value('id');

        DB::table('items_to_vendors')->insert([
            'vendor_id' => $vendor,
            'item_id' => $item,
            'updated_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        $vendor = DB::table('vendors')->where('id', '=', 2)->value('id');
        $item = DB::table('items')->where('id', '=', 2)->value('id');

        DB::table('items_to_vendors')->insert([
            'vendor_id' => $vendor,
            'item_id' => $item,
            'updated_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        $vendor = DB::table('vendors')->where('id', '=', 3)->value('id');
        $item = DB::table('items')->where('id', '=', 3)->value('id');

        DB::table('items_to_vendors')->insert([
            'vendor_id' => $vendor,
            'item_id' => $item,
            'updated_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
