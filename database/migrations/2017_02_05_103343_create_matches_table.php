<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table){
            $table->integer('first')->unsigned();
            $table->integer('second')->unsigned();
            $table->foreign('first')->references('id')->on('registrations');
            $table->foreign('second')->references('id')->on('registrations');
            $table->enum('status',['SUCCESS','REJECTED','WAITLIST']);
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
        Schema::dropIfExists('matches');
    }
}
