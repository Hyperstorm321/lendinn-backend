<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopPropertesByCityInAYearProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE PROCEDURE proc_top_properties_by_city_in_a_year
                @top INT,
                @city VARCHAR(100),
                @selling_type VARCHAR(20),
                @year INT
            AS
            BEGIN
                SELECT	  TOP(@top) prt.property_type
                        , pr.main_photo_src
                        , pr.name
                        , (	SELECT SUM(pro.quantity) 
                            FROM property_owned pro
                            INNER JOIN selling_types sety ON pro.selling_type_id = pro.selling_type_id
                            WHERE	pro.property_id = pr.property_id
                                AND sety.selling_type LIKE '%' + @selling_type + '%'
                        ) AS 'total_quantity'
            
                        , (	SELECT SUM(pro.total_price) 
                            FROM property_owned pro
                            INNER JOIN selling_types sety ON pro.selling_type_id = pro.selling_type_id
                            WHERE	pro.property_id = pr.property_id
                                AND sety.selling_type LIKE '%' + @selling_type + '%'
                        ) AS 'total_sale'
            
                FROM properties pr
                INNER JOIN property_types prt ON pr.property_type_id = prt.property_type_id
                INNER JOIN cities ci ON pr.city_id = ci.city_id
            
                WHERE	ci.city LIKE '%' + @city + '%'
                    AND YEAR(pr.date_added)  = @year
            
                ORDER BY total_sale DESC
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
        DB::unprepared('DROP PROCEDURE proc_top_properties_by_city_in_a_year');
    }
}
