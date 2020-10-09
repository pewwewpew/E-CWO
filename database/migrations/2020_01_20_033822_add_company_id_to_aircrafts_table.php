<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdToAircraftsTable extends Migration
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
            $table->string('company_id',25)->foreign()->reference('id')->on('companies')->change();
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
            $table->dropColumn('company_id');
        });
    }
}
