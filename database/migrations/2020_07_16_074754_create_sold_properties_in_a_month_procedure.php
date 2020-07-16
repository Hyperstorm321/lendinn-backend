<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldPropertiesInAMonthProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE PROCEDURE proc_sold_properties_in_a_month
                @landlord_id INT,
                @selling_type VARCHAR(20),
                @year INT,
                @month INT
            AS
            BEGIN
                SELECT	  pro.date_acquired
                        , prt.property_type
                        , pr.main_photo_src
                        , pr.name
                        , ci.city
                        , us.last_name AS buyer
                        , sety.selling_type
                        , pro.quantity
                        , pro.total_price
            
                FROM properties pr
                INNER JOIN property_owned pro			ON pr.property_id = pro.property_id
                INNER JOIN property_types prt			ON pr.property_type_id = prt.property_type_id
                INNER JOIN property_selling_types prst	ON pro.property_selling_type_id = prst.property_selling_type_id
                INNER JOIN selling_types sety			ON prst.selling_type_id = sety.selling_type_id
                INNER JOIN users us						ON pro.user_id = us.user_id
                INNER JOIN cities ci					ON pr.city_id = ci.city_id
            
                WHERE		pr.landlord_id = @landlord_id
                        AND sety.selling_type LIKE '%' + @selling_type +'%'
                        AND YEAR(pro.date_acquired) = @year 
                        AND MONTH(pro.date_acquired) = @month
            
                ORDER BY	pro.date_acquired DESC,
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
        DB::unprepared('DROP PROCEDURE proc_sold_properties_in_a_month');
    }
}
