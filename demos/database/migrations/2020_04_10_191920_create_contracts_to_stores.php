<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsToStores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts_to_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id');
            $table->foreignId('store_id');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();

            //Set foreign keys
            $table->foreign('contract_id')->references('id')->on('contracts');
            $table->foreign('store_id')->references('id')->on('stores');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts_to_stores');
    }
}
