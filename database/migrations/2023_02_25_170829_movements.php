<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Movements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {

            $table->bigIncrements('id_movement');
            $table->unsignedBigInteger('id_vehicle');
            $table->datetime('date_in');
            $table->datetime('date_out')->nullable();
            $table->boolean('status')->default(0);
            $table->string('description',100)->nullable();
            $table->timestamps();

            $table->foreign('id_vehicle')->references('id_vehicle')->on('vehicle');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movements');
    }
}
