<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSellingTypeIdToPropertyOwned extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_owned', function (Blueprint $table) {
            $table->bigInteger('selling_type_id')->nullable();

            $table->foreign('selling_type_id')
                  ->references('selling_type_id')->on('selling_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_owned', function (Blueprint $table) {
            //
        });
    }
}
