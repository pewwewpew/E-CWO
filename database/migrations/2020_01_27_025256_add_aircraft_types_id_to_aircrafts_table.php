<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAircraftTypesIdToAircraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aircrafts', function (Blueprint $table) {
            //
            $table->string('aircraft_types_id',255)->foreign()->reference('id')->on('aircraft_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aircrafts', function (Blueprint $table) {
            //
            $table->dropColumn('aircraft_types_id');
        });
    }
}
