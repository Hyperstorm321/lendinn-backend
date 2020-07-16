<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListOfPropertiesOwnedProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE PROCEDURE proc_list_of_properties_owned
                @user_id INT
            AS
            BEGIN
                SELECT	  prt.property_type
                        , pr.main_photo_src
                        , pr.name, pro.quantity
                        , sety.selling_type
                        , pro.total_price
                        , ci.city
                        , pr.detailed_address
                        , pro.date_acquired
            
                FROM property_owned pro
                INNER JOIN properties pr				ON pro.property_id = pr.property_id
                INNER JOIN property_types prt			ON pr.property_type_id = prt.property_type_id
                INNER JOIN property_selling_types prst	ON pro.property_selling_type_id = prst.property_selling_type_id
                INNER JOIN selling_types sety			ON prst.selling_type_id = sety.selling_type_id
                INNER JOIN cities ci					ON pr.city_id = ci.city_id
            
                WHERE	pro.user_id = @user_id
            
                ORDER BY pro.date_acquired DESC,
                        ci.city ASC,
                        pr.name ASC
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE proc_list_of_properties_owned');
    }
}
