<?php

use App\Aircraft;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('approval')->default(0);
            $table->string('aircraft_id',10)->foreign()->references('id')->on('Aircraft');
            $table->string('aircraft_type_service_id')->foreign()->references('id')->on('aircraft_type_service');
            $table->unsignedBigInteger('userable_id')->foreign()->references('id')->on('users');
            $table->unsignedBigInteger('target_user_id')->foreign()->references('id')->on('users');
            $table->string('remark',500);
            $table->string('progress_id')->default('waiting')->foreign()->references('id')->on('progress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
