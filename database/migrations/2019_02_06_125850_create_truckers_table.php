<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTruckersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truckers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->tinyInteger('age');
            $table->enum('sex',['F','M']);
            $table->tinyInteger('trucks_code');
            $table->enum('cnh',['A','B','C','D','E']);
            $table->enum('is_own',['Y','N']);
            $table->enum('is_loaded',['Y','N']);
            $table->string('number',100);
            $table->string('street',100);
            $table->string('neighborhood',100);
            $table->string('city',100);
            $table->char('state',2);
            $table->string('country',100);
            $table->decimal('lat',10, 8);
            $table->decimal('lng',11, 8);
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
        Schema::dropIfExists('truckers');
    }
}
