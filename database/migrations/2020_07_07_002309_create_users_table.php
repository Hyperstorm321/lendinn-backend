<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('username', 20)->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->string('fname', 50);
            $table->string('mname', 50)->nullable();
            $table->string('lname', 50);
            $table->string('ename', 10)->nullable();
            $table->string('detailed_address')->nullable();
            $table->bigInteger('region_id')->unsigned()->nullable();
            $table->bigInteger('province_id')->unsigned()->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->bigInteger('barangay_id')->unsigned()->nullable();
            $table->bigInteger('postal_code_id')->unsigned()->nullable();
            $table->string('photo_src')->nullable();
            $table->boolean('is_landlord')->default(false);
            $table->boolean('is_deleted')->default(false);


            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned();
            $table->timestamps();

            $table->foreign('region_id')->references('region_id')->on('regions');
            $table->foreign('province_id')->references('province_id')->on('provinces');
            $table->foreign('city_id')->references('city_id')->on('cities');
            $table->foreign('barangay_id')->references('barangay_id')->on('barangays');
            $table->foreign('postal_code_id')->references('postal_code_id')->on('postal_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
