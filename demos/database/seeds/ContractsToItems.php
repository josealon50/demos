<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ContractsToItems extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contracts = DB::table('contracts')->get();
        foreach( $contracts as $contract ){
            $items = DB::table('items')->get();
            foreach( $items as $item ){
                DB::table('contracts_to_items')->insert([
                    'contract_id' => $contract->id,
                    'item_id' => $item->id,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);
            }
        }
    }
}
