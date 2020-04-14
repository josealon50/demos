<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ContractsToStoreSeeder extends Seeder
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
            $stores = DB::table('stores')->get();
            foreach( $stores as $store ){
                DB::table('contracts_to_stores')->insert([
                    'contract_id' => $contract->id,
                    'store_id' => $store->id,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);
            }
        }

    }
}
