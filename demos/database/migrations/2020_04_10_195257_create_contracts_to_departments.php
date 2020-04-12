<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsToDepartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts_to_departments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id');
            $table->foreignId('department_id');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();

            //Set foreign keys
            $table->foreign('contract_id')->references('id')->on('contracts');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts_to_departments');
    }
}
