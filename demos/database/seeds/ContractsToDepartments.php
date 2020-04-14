<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ContractsToDepartments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = DB::table('departments')->get();
        foreach( $departments as $department ){
            $contracts = DB::table('contracts')->get();
            foreach( $contracts as $contract ){
                DB::table('contracts_to_departments')->insert([
                    'contract_id' => $contract->id,
                    'department_id' => $department->id,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);
            }
        }
    }
}
