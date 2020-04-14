<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $this->call('VendorsSeeder');
        $this->call('StoresSeeder');
        $this->call('ContractsSeeder');
        $this->call('ContractsToStoreSeeder');
        $this->call('ContractsToVendors');
        $this->call('DepartmentsSeeder');
        $this->call('ContractsToDepartments');
        $this->call('ItemsSeeder');
    }
}
