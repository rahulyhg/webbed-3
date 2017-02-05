<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table){
            $table->increments('id');
            $table->integer('fromId')->unsigned();
            $table->integer('toId')->unsigned();
            $table->foreign('fromId')->references('id')->on('registrations');
            $table->foreign('toId')->references('id')->on('registrations');
            $table->text('message');
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
        Schema::dropIfExists('chats');
    }
}
