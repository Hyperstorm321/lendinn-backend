<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListOfPropertiesOwnedLandlordProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE PROCEDURE proc_list_of_properties_owned_landlord
                @landlord_id INT
            AS
            BEGIN
                SELECT
                    pr.main_photo_src	
                    , pr.name
                    , prt.property_type
                    , quantities =	STUFF((	
                                        SELECT	', '
                                                , CHAR(13)
                                                , sety.selling_type
                                                , ': '
                                                , prst.available_quantity
                                                , '/'
                                                , prst.max_quantity
                                        FROM property_selling_types prst
                                        INNER JOIN selling_types sety ON prst.selling_type_id = sety.selling_type_id
                                        WHERE prst.property_id = pr.property_id
                                        ORDER BY sety.selling_type ASC
                                    
                                        FOR XML PATH(''), TYPE).value('.', 'VARCHAR(MAX)'), 1, 1, '')
                    , ci.city
                    , pr.detailed_address
            
                FROM properties pr
                INNER JOIN property_types prt			ON pr.property_type_id = prt.property_type_id
                INNER JOIN cities ci					ON pr.city_id = ci.city_id
            
                WHERE pr.landlord_id = @landlord_id
            
                ORDER BY prt.property_type ASC,
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
        DB::unprepared('DROP PROCEDURE proc_list_of_properties_owned_landlord');
    }
}
